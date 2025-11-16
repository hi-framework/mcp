<?php

declare(strict_types=1);

namespace Hi\MCP\Analyzer;

/**
 * PHP 类/接口分析器
 *
 * 分析 PHP 类和接口的结构，提取文档信息
 */
final class ClassAnalyzer
{
    public function __construct(
        private readonly DocBlockParser $docParser = new DocBlockParser,
    ) {
    }

    /**
     * 分析类或接口
     */
    public function analyze(string $className): array
    {
        if (! \class_exists($className) && ! \interface_exists($className) && ! \trait_exists($className)) {
            throw new \InvalidArgumentException("Class/Interface/Trait not found: {$className}");
        }

        $reflection = new \ReflectionClass($className);
        $docBlock = $this->docParser->parse($reflection->getDocComment() ?: null);

        return [
            'name' => $reflection->getShortName(),
            'namespace' => $reflection->getNamespaceName(),
            'fqcn' => $reflection->getName(),
            'type' => $this->getClassType($reflection),
            'description' => $docBlock['description'],
            'file' => $reflection->getFileName(),
            'startLine' => $reflection->getStartLine(),
            'endLine' => $reflection->getEndLine(),
            'isAbstract' => $reflection->isAbstract(),
            'isFinal' => $reflection->isFinal(),
            'parent' => $reflection->getParentClass() ? $reflection->getParentClass()->getName() : null,
            'interfaces' => $reflection->getInterfaceNames(),
            'traits' => $reflection->getTraitNames(),
            'attributes' => $this->analyzeAttributes($reflection->getAttributes()),
            'constants' => $this->analyzeConstants($reflection),
            'properties' => $this->analyzeProperties($reflection),
            'methods' => $this->analyzeMethods($reflection),
        ];
    }

    /**
     * 获取类类型
     */
    private function getClassType(\ReflectionClass $reflection): string
    {
        if ($reflection->isInterface()) {
            return 'interface';
        }
        if ($reflection->isTrait()) {
            return 'trait';
        }
        if ($reflection->isEnum()) {
            return 'enum';
        }

        return 'class';
    }

    /**
     * 分析类属性
     */
    private function analyzeAttributes(array $attributes): array
    {
        $result = [];
        foreach ($attributes as $attribute) {
            /** @var \ReflectionAttribute $attribute */
            $result[] = [
                'name' => $attribute->getName(),
                'arguments' => $attribute->getArguments(),
            ];
        }

        return $result;
    }

    /**
     * 分析类常量
     */
    private function analyzeConstants(\ReflectionClass $reflection): array
    {
        $result = [];
        foreach ($reflection->getReflectionConstants() as $constant) {
            if ($constant->getDeclaringClass()->getName() !== $reflection->getName()) {
                continue; // 跳过继承的常量
            }

            $docBlock = $this->docParser->parse($constant->getDocComment() ?: null);
            $result[] = [
                'name' => $constant->getName(),
                'value' => $constant->getValue(),
                'visibility' => $this->getVisibility($constant),
                'description' => $docBlock['description'],
            ];
        }

        return $result;
    }

    /**
     * 分析类属性
     */
    private function analyzeProperties(\ReflectionClass $reflection): array
    {
        $result = [];
        foreach ($reflection->getProperties() as $property) {
            if ($property->getDeclaringClass()->getName() !== $reflection->getName()) {
                continue; // 跳过继承的属性
            }

            $docBlock = $this->docParser->parse($property->getDocComment() ?: null);
            $result[] = [
                'name' => $property->getName(),
                'type' => $this->getPropertyType($property),
                'visibility' => $this->getPropertyVisibility($property),
                'isStatic' => $property->isStatic(),
                'isReadonly' => $property->isReadOnly(),
                'hasDefault' => $property->hasDefaultValue(),
                'default' => $property->hasDefaultValue() ? $this->formatDefaultValue($property->getDefaultValue()) : null,
                'description' => $docBlock['description'],
                'attributes' => $this->analyzeAttributes($property->getAttributes()),
            ];
        }

        return $result;
    }

    /**
     * 分析类方法
     */
    private function analyzeMethods(\ReflectionClass $reflection): array
    {
        $result = [];
        foreach ($reflection->getMethods() as $method) {
            if ($method->getDeclaringClass()->getName() !== $reflection->getName()) {
                continue; // 跳过继承的方法
            }

            $result[] = $this->analyzeMethod($method);
        }

        return $result;
    }

    /**
     * 分析单个方法
     */
    public function analyzeMethod(\ReflectionMethod $method): array
    {
        $docBlock = $this->docParser->parse($method->getDocComment() ?: null);

        // 解析 @param 标签
        $paramDocs = [];
        if (isset($docBlock['tags']['param'])) {
            foreach ($docBlock['tags']['param'] as $paramTag) {
                $parsed = $this->docParser->parseParamTag($paramTag);
                if ($parsed) {
                    $paramDocs[$parsed['name']] = $parsed;
                }
            }
        }

        // 解析 @return 标签
        $returnDoc = null;
        if (isset($docBlock['tags']['return'][0])) {
            $returnDoc = $this->docParser->parseReturnTag($docBlock['tags']['return'][0]);
        }

        // 解析 @throws 标签
        $throws = [];
        if (isset($docBlock['tags']['throws'])) {
            foreach ($docBlock['tags']['throws'] as $throwsTag) {
                $parsed = $this->docParser->parseThrowsTag($throwsTag);
                if ($parsed) {
                    $throws[] = $parsed;
                }
            }
        }

        return [
            'name' => $method->getName(),
            'visibility' => $this->getMethodVisibility($method),
            'isStatic' => $method->isStatic(),
            'isAbstract' => $method->isAbstract(),
            'isFinal' => $method->isFinal(),
            'description' => $docBlock['description'],
            'parameters' => $this->analyzeParameters($method, $paramDocs),
            'returnType' => $this->getReturnType($method),
            'returnDescription' => $returnDoc['description'] ?? '',
            'throws' => $throws,
            'attributes' => $this->analyzeAttributes($method->getAttributes()),
        ];
    }

    /**
     * 分析方法参数
     */
    private function analyzeParameters(\ReflectionMethod $method, array $paramDocs): array
    {
        $result = [];
        foreach ($method->getParameters() as $param) {
            $paramDoc = $paramDocs[$param->getName()] ?? [];
            $result[] = [
                'name' => $param->getName(),
                'type' => $this->getParameterType($param),
                'typeFromDoc' => $paramDoc['type'] ?? null,
                'description' => $paramDoc['description'] ?? '',
                'isOptional' => $param->isOptional(),
                'isVariadic' => $param->isVariadic(),
                'hasDefault' => $param->isDefaultValueAvailable(),
                'default' => $param->isDefaultValueAvailable() ? $this->formatDefaultValue($param->getDefaultValue()) : null,
                'isNullable' => $param->allowsNull(),
            ];
        }

        return $result;
    }

    /**
     * 获取参数类型
     */
    private function getParameterType(\ReflectionParameter $param): ?string
    {
        $type = $param->getType();
        if (null === $type) {
            return null;
        }

        return $this->formatType($type);
    }

    /**
     * 获取属性类型
     */
    private function getPropertyType(\ReflectionProperty $property): ?string
    {
        $type = $property->getType();
        if (null === $type) {
            return null;
        }

        return $this->formatType($type);
    }

    /**
     * 获取返回类型
     */
    private function getReturnType(\ReflectionMethod $method): ?string
    {
        $type = $method->getReturnType();
        if (null === $type) {
            return null;
        }

        return $this->formatType($type);
    }

    /**
     * 格式化类型
     */
    private function formatType(\ReflectionType $type): string
    {
        if ($type instanceof \ReflectionUnionType) {
            $types = \array_map(fn ($t) => $this->formatType($t), $type->getTypes());

            return \implode('|', $types);
        }

        if ($type instanceof \ReflectionNamedType) {
            $name = $type->getName();
            if ($type->allowsNull() && 'null' !== $name && 'mixed' !== $name) {
                return '?' . $name;
            }

            return $name;
        }

        return (string) $type;
    }

    /**
     * 格式化默认值
     */
    private function formatDefaultValue(mixed $value): mixed
    {
        if (\is_array($value)) {
            return '[]'; // 简化数组显示
        }

        return $value;
    }

    /**
     * 获取可见性
     */
    private function getVisibility(\ReflectionClassConstant $constant): string
    {
        if ($constant->isPublic()) {
            return 'public';
        }
        if ($constant->isProtected()) {
            return 'protected';
        }

        return 'private';
    }

    /**
     * 获取属性可见性
     */
    private function getPropertyVisibility(\ReflectionProperty $property): string
    {
        if ($property->isPublic()) {
            return 'public';
        }
        if ($property->isProtected()) {
            return 'protected';
        }

        return 'private';
    }

    /**
     * 获取方法可见性
     */
    private function getMethodVisibility(\ReflectionMethod $method): string
    {
        if ($method->isPublic()) {
            return 'public';
        }
        if ($method->isProtected()) {
            return 'protected';
        }

        return 'private';
    }
}
