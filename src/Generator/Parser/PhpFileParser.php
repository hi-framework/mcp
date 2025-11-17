<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Parser;

use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\Parser;
use PhpParser\ParserFactory;

/**
 * PHP 文件解析器
 *
 * 使用 PHP-Parser 提取文件中的类、接口、Trait、枚举信息
 */
final class PhpFileParser
{
    private Parser $parser;

    public function __construct()
    {
        $this->parser = (new ParserFactory)->createForNewestSupportedVersion();
    }

    /**
     * 解析 PHP 文件
     *
     * @return array<string, array> 键为 FQCN，值为类信息
     */
    public function parseFile(string $filePath): array
    {
        $code = file_get_contents($filePath);
        if (false === $code) {
            return [];
        }

        try {
            $ast = $this->parser->parse($code);
            if (null === $ast) {
                return [];
            }

            $visitor = new ClassVisitor($filePath);
            $traverser = new NodeTraverser;
            $traverser->addVisitor($visitor);
            $traverser->traverse($ast);

            return $visitor->getClasses();
        } catch (\Throwable) {
            return [];
        }
    }
}

/**
 * AST 访问器，提取类信息
 */
final class ClassVisitor extends NodeVisitorAbstract
{
    private string $filePath;
    private string $namespace = '';
    private array $uses = [];
    private array $classes = [];

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function enterNode(Node $node): ?int
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            $this->namespace = $node->name ? $node->name->toString() : '';
        }

        if ($node instanceof Node\Stmt\Use_) {
            foreach ($node->uses as $use) {
                $alias = $use->alias ? $use->alias->toString() : $use->name->getLast();
                $this->uses[$alias] = $use->name->toString();
            }
        }

        if ($node instanceof Node\Stmt\Class_
            || $node instanceof Node\Stmt\Interface_
            || $node instanceof Node\Stmt\Trait_
            || $node instanceof Node\Stmt\Enum_) {
            $this->extractClassInfo($node);
        }

        return null;
    }

    private function extractClassInfo(Node\Stmt\ClassLike $node): void
    {
        if (null === $node->name) {
            return; // 匿名类
        }

        $className = $node->name->toString();
        $fqcn = '' !== $this->namespace ? $this->namespace . '\\' . $className : $className;

        $info = [
            'name' => $className,
            'fqcn' => $fqcn,
            'namespace' => $this->namespace,
            'type' => $this->getClassType($node),
            'file' => $this->filePath,
            'startLine' => $node->getStartLine(),
            'endLine' => $node->getEndLine(),
            'docComment' => $node->getDocComment()?->getText() ?? '',
            'attributes' => $this->extractAttributes($node->attrGroups),
            'isAbstract' => $node instanceof Node\Stmt\Class_ && $node->isAbstract(),
            'isFinal' => $node instanceof Node\Stmt\Class_ && $node->isFinal(),
            'isReadonly' => $node instanceof Node\Stmt\Class_ && $node->isReadonly(),
            'extends' => $this->extractExtends($node),
            'implements' => $this->extractImplements($node),
            'traits' => $this->extractTraits($node),
            'constants' => $this->extractConstants($node),
            'properties' => $this->extractProperties($node),
            'methods' => $this->extractMethods($node),
        ];

        $this->classes[$fqcn] = $info;
    }

    private function getClassType(Node\Stmt\ClassLike $node): string
    {
        return match (true) {
            $node instanceof Node\Stmt\Interface_ => 'interface',
            $node instanceof Node\Stmt\Trait_ => 'trait',
            $node instanceof Node\Stmt\Enum_ => 'enum',
            default => 'class',
        };
    }

    private function extractAttributes(array $attrGroups): array
    {
        $attributes = [];
        foreach ($attrGroups as $group) {
            foreach ($group->attrs as $attr) {
                $arguments = [];

                foreach ($attr->args as $arg) {
                    $argName = $arg->name?->toString();
                    $argValue = $this->extractValue($arg->value);

                    if (null !== $argName) {
                        $arguments[$argName] = $argValue;
                    } else {
                        $arguments[] = $argValue;
                    }
                }

                // 检查是否是完全限定名（以 \ 开头）
                $name = $attr->name instanceof Node\Name\FullyQualified
                    ? $attr->name->toString()
                    : $this->resolveClassName($attr->name->toString());

                $attributes[] = [
                    'name' => $name,
                    'arguments' => $arguments,
                ];
            }
        }

        return $attributes;
    }

    private function extractValue(Node\Expr $expr): mixed
    {
        return match (true) {
            $expr instanceof Node\Scalar\String_ => $expr->value,
            $expr instanceof Node\Scalar\Int_ => $expr->value,
            $expr instanceof Node\Scalar\Float_ => $expr->value,
            $expr instanceof Node\Expr\ConstFetch => $expr->name->toString(),
            $expr instanceof Node\Expr\ClassConstFetch => $this->extractClassConstValue($expr),
            $expr instanceof Node\Expr\Array_ => $this->extractArrayValue($expr),
            $expr instanceof Node\Expr\BinaryOp\BitwiseOr => $this->extractBitwiseOrValue($expr),
            default => '...',
        };
    }

    private function extractClassConstValue(Node\Expr\ClassConstFetch $expr): mixed
    {
        $className = $expr->class instanceof Node\Name\FullyQualified
            ? $expr->class->toString()
            : $this->resolveClassName($expr->class->toString());

        $constName = $expr->name->toString();

        // 尝试获取实际值（如果是内置类）
        if ('Attribute' === $className && defined("Attribute::{$constName}")) {
            return constant("Attribute::{$constName}");
        }

        return "{$className}::{$constName}";
    }

    private function extractBitwiseOrValue(Node\Expr\BinaryOp\BitwiseOr $expr): mixed
    {
        $left = $this->extractValue($expr->left);
        $right = $this->extractValue($expr->right);

        // 如果两边都是整数，执行位运算
        if (is_int($left) && is_int($right)) {
            return $left | $right;
        }

        return "{$left}|{$right}";
    }

    private function extractArrayValue(Node\Expr\Array_ $array): array
    {
        $result = [];
        foreach ($array->items as $item) {
            if (null === $item) {
                continue;
            }

            $value = $this->extractValue($item->value);
            if (null !== $item->key) {
                $key = $this->extractValue($item->key);
                $result[$key] = $value;
            } else {
                $result[] = $value;
            }
        }

        return $result;
    }

    private function extractExtends(Node\Stmt\ClassLike $node): ?string
    {
        if ($node instanceof Node\Stmt\Class_ && $node->extends) {
            return $this->resolveClassName($node->extends->toString());
        }

        if ($node instanceof Node\Stmt\Interface_ && ! empty($node->extends)) {
            // 接口可以多继承，但这里只返回第一个
            return $this->resolveClassName($node->extends[0]->toString());
        }

        return null;
    }

    private function extractImplements(Node\Stmt\ClassLike $node): array
    {
        $implements = [];

        if ($node instanceof Node\Stmt\Class_) {
            foreach ($node->implements as $interface) {
                $implements[] = $this->resolveClassName($interface->toString());
            }
        }

        if ($node instanceof Node\Stmt\Enum_) {
            foreach ($node->implements as $interface) {
                $implements[] = $this->resolveClassName($interface->toString());
            }
        }

        return $implements;
    }

    private function extractTraits(Node\Stmt\ClassLike $node): array
    {
        $traits = [];

        foreach ($node->stmts as $stmt) {
            if ($stmt instanceof Node\Stmt\TraitUse) {
                foreach ($stmt->traits as $trait) {
                    $traits[] = $this->resolveClassName($trait->toString());
                }
            }
        }

        return $traits;
    }

    private function extractConstants(Node\Stmt\ClassLike $node): array
    {
        $constants = [];

        foreach ($node->stmts as $stmt) {
            if ($stmt instanceof Node\Stmt\ClassConst) {
                foreach ($stmt->consts as $const) {
                    $constants[] = [
                        'name' => $const->name->toString(),
                        'value' => $this->extractValue($const->value),
                        'visibility' => $this->getVisibility($stmt),
                        'isFinal' => $stmt->isFinal(),
                        'docComment' => $stmt->getDocComment()?->getText() ?? '',
                        'attributes' => $this->extractAttributes($stmt->attrGroups),
                    ];
                }
            }
        }

        return $constants;
    }

    private function extractProperties(Node\Stmt\ClassLike $node): array
    {
        $properties = [];

        foreach ($node->stmts as $stmt) {
            if ($stmt instanceof Node\Stmt\Property) {
                foreach ($stmt->props as $prop) {
                    $properties[] = [
                        'name' => $prop->name->toString(),
                        'type' => $stmt->type ? $this->formatType($stmt->type) : null,
                        'visibility' => $this->getPropertyVisibility($stmt),
                        'isStatic' => $stmt->isStatic(),
                        'isReadonly' => $stmt->isReadonly(),
                        'hasDefault' => null !== $prop->default,
                        'default' => $prop->default ? $this->extractValue($prop->default) : null,
                        'docComment' => $stmt->getDocComment()?->getText() ?? '',
                        'attributes' => $this->extractAttributes($stmt->attrGroups),
                    ];
                }
            }
        }

        // 提取构造函数提升属性
        foreach ($node->stmts as $stmt) {
            if ($stmt instanceof Node\Stmt\ClassMethod && '__construct' === $stmt->name->toString()) {
                foreach ($stmt->params as $param) {
                    if (0 !== $param->flags) {
                        $properties[] = [
                            'name' => $param->var->name,
                            'type' => $param->type ? $this->formatType($param->type) : null,
                            'visibility' => $this->getParamVisibility($param),
                            'isStatic' => false,
                            'isReadonly' => (bool) ($param->flags & Node\Stmt\Class_::MODIFIER_READONLY),
                            'hasDefault' => null !== $param->default,
                            'default' => $param->default ? $this->extractValue($param->default) : null,
                            'docComment' => '',
                            'attributes' => $this->extractAttributes($param->attrGroups),
                            'promoted' => true,
                        ];
                    }
                }
            }
        }

        return $properties;
    }

    private function extractMethods(Node\Stmt\ClassLike $node): array
    {
        $methods = [];

        foreach ($node->stmts as $stmt) {
            if ($stmt instanceof Node\Stmt\ClassMethod) {
                $methods[] = [
                    'name' => $stmt->name->toString(),
                    'visibility' => $this->getMethodVisibility($stmt),
                    'isStatic' => $stmt->isStatic(),
                    'isAbstract' => $stmt->isAbstract(),
                    'isFinal' => $stmt->isFinal(),
                    'returnType' => $stmt->returnType ? $this->formatType($stmt->returnType) : null,
                    'parameters' => $this->extractParameters($stmt),
                    'docComment' => $stmt->getDocComment()?->getText() ?? '',
                    'attributes' => $this->extractAttributes($stmt->attrGroups),
                    'startLine' => $stmt->getStartLine(),
                    'endLine' => $stmt->getEndLine(),
                ];
            }
        }

        return $methods;
    }

    private function extractParameters(Node\Stmt\ClassMethod $method): array
    {
        $parameters = [];

        foreach ($method->params as $param) {
            $parameters[] = [
                'name' => $param->var->name,
                'type' => $param->type ? $this->formatType($param->type) : null,
                'isVariadic' => $param->variadic,
                'isReference' => $param->byRef,
                'hasDefault' => null !== $param->default,
                'default' => $param->default ? $this->extractValue($param->default) : null,
                'attributes' => $this->extractAttributes($param->attrGroups),
            ];
        }

        return $parameters;
    }

    private function formatType(Node $type): string
    {
        return match (true) {
            $type instanceof Node\NullableType => '?' . $this->formatType($type->type),
            $type instanceof Node\UnionType => implode('|', array_map(fn ($t) => $this->formatType($t), $type->types)),
            $type instanceof Node\IntersectionType => implode('&', array_map(fn ($t) => $this->formatType($t), $type->types)),
            $type instanceof Node\Identifier => $type->toString(),
            $type instanceof Node\Name => $this->resolveClassName($type->toString()),
            default => (string) $type,
        };
    }

    private function resolveClassName(string $name): string
    {
        // 已经是完全限定名
        if (str_starts_with($name, '\\')) {
            return ltrim($name, '\\');
        }

        // 检查 use 语句
        $parts = explode('\\', $name);
        $first = $parts[0];

        if (isset($this->uses[$first])) {
            $parts[0] = $this->uses[$first];

            return implode('\\', $parts);
        }

        // 内置类型
        $builtinTypes = ['string', 'int', 'float', 'bool', 'array', 'object', 'mixed', 'void', 'never', 'null', 'true', 'false', 'self', 'static', 'parent', 'callable', 'iterable'];
        if (in_array(strtolower($name), $builtinTypes, true)) {
            return $name;
        }

        // 相对于当前命名空间
        if ('' !== $this->namespace) {
            return $this->namespace . '\\' . $name;
        }

        return $name;
    }

    private function getVisibility(Node\Stmt\ClassConst $const): string
    {
        if ($const->isPublic()) {
            return 'public';
        }
        if ($const->isProtected()) {
            return 'protected';
        }

        return 'private';
    }

    private function getPropertyVisibility(Node\Stmt\Property $prop): string
    {
        if ($prop->isPublic()) {
            return 'public';
        }
        if ($prop->isProtected()) {
            return 'protected';
        }

        return 'private';
    }

    private function getParamVisibility(Node\Param $param): string
    {
        if ($param->flags & Node\Stmt\Class_::MODIFIER_PUBLIC) {
            return 'public';
        }
        if ($param->flags & Node\Stmt\Class_::MODIFIER_PROTECTED) {
            return 'protected';
        }

        return 'private';
    }

    private function getMethodVisibility(Node\Stmt\ClassMethod $method): string
    {
        if ($method->isPublic()) {
            return 'public';
        }
        if ($method->isProtected()) {
            return 'protected';
        }

        return 'private';
    }

    public function getClasses(): array
    {
        return $this->classes;
    }
}
