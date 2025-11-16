<?php

declare(strict_types=1);

namespace Hi\MCP\Analyzer;

/**
 * API 使用示例生成器
 *
 * 为类、接口、方法等生成使用示例代码
 */
final class UsageExampleGenerator
{
    /**
     * 为类生成使用示例
     */
    public function generateClassUsage(array $classInfo): array
    {
        $examples = [];

        // 实例化示例
        if (! $classInfo['isAbstract'] && 'interface' !== $classInfo['type']) {
            $examples['instantiation'] = $this->generateInstantiationExample($classInfo);
        }

        // 接口实现示例
        if ('interface' === $classInfo['type']) {
            $examples['implementation'] = $this->generateInterfaceImplementationExample($classInfo);
        }

        // 常用方法调用示例
        $publicMethods = \array_filter(
            $classInfo['methods'],
            static fn ($m) => 'public' === $m['visibility'] && ! \str_starts_with($m['name'], '__'),
        );

        if (! empty($publicMethods)) {
            $examples['method_calls'] = $this->generateMethodCallExamples($classInfo, \array_slice($publicMethods, 0, 3));
        }

        // 依赖注入示例（如果有接口）
        if (! empty($classInfo['interfaces'])) {
            $examples['dependency_injection'] = $this->generateDependencyInjectionExample($classInfo);
        }

        return $examples;
    }

    /**
     * 为方法生成使用示例
     */
    public function generateMethodUsage(array $methodInfo, string $className): string
    {
        $isStatic = $methodInfo['isStatic'];
        $methodName = $methodInfo['name'];
        $params = $methodInfo['parameters'];

        // 生成参数示例
        $paramExamples = [];
        foreach ($params as $param) {
            $paramExamples[] = $this->generateParameterValue($param);
        }

        $paramString = \implode(', ', $paramExamples);

        // 根据返回类型生成示例
        $returnType = $methodInfo['returnType'] ?? 'mixed';
        $hasReturn = 'void' !== $returnType;

        if ($isStatic) {
            $call = "{$className}::{$methodName}({$paramString})";
        } else {
            $shortName = \mb_substr($className, \mb_strrpos($className, '\\') + 1);
            $varName = \lcfirst($shortName);
            $call = "\${$varName}->{$methodName}({$paramString})";
        }

        if ($hasReturn) {
            $resultVar = $this->getResultVariableName($returnType);

            return "\${$resultVar} = {$call};";
        }

        return "{$call};";
    }

    /**
     * 为 Attribute 生成使用示例
     */
    public function generateAttributeUsage(array $attributeInfo, array $parameters, array $targets): string
    {
        $shortName = $attributeInfo['name'];

        // 构建参数示例
        $paramExamples = [];
        foreach ($parameters as $param) {
            $example = $this->generateAttributeParameterExample($param);
            if (null !== $example) {
                $paramExamples[] = $param['name'] . ': ' . $example;
            }
        }

        $paramString = \implode(', ', $paramExamples);
        $attributeUsage = empty($paramString) ? "#[{$shortName}]" : "#[{$shortName}({$paramString})]";

        // 根据目标生成完整上下文
        return $this->generateAttributeContext($attributeUsage, $targets, $shortName);
    }

    /**
     * 生成实例化示例
     */
    private function generateInstantiationExample(array $classInfo): string
    {
        $className = $classInfo['name'];
        $constructorParams = [];

        foreach ($classInfo['methods'] as $method) {
            if ('__construct' === $method['name']) {
                $constructorParams = $method['parameters'];

                break;
            }
        }

        if (empty($constructorParams)) {
            return "\$instance = new {$className}();";
        }

        $paramExamples = [];
        foreach ($constructorParams as $param) {
            $value = $this->generateParameterValue($param);
            if ($param['isOptional']) {
                $paramExamples[] = "    {$param['name']}: {$value}, // optional";
            } else {
                $paramExamples[] = "    {$param['name']}: {$value},";
            }
        }

        $paramString = \implode("\n", $paramExamples);

        return <<<PHP
\$instance = new {$className}(
{$paramString}
);
PHP;
    }

    /**
     * 生成接口实现示例
     */
    private function generateInterfaceImplementationExample(array $interfaceInfo): string
    {
        $interfaceName = $interfaceInfo['name'];
        $methods = $interfaceInfo['methods'];

        $methodImplementations = [];
        foreach ($methods as $method) {
            $methodImplementations[] = $this->generateMethodSignature($method);
        }

        $methodsCode = \implode("\n\n", $methodImplementations);

        return <<<PHP
class My{$interfaceName} implements {$interfaceName}
{
{$methodsCode}
}
PHP;
    }

    /**
     * 生成方法调用示例
     */
    private function generateMethodCallExamples(array $classInfo, array $methods): string
    {
        $className = $classInfo['name'];
        $varName = \lcfirst($className);

        $examples = [];

        // 首先添加实例化（如果不是静态方法）
        $hasNonStatic = false;
        foreach ($methods as $method) {
            if (! $method['isStatic']) {
                $hasNonStatic = true;

                break;
            }
        }

        if ($hasNonStatic) {
            $examples[] = '// Create instance';
            $examples[] = "\${$varName} = construct({$className}::class);";
            $examples[] = '';
        }

        foreach ($methods as $method) {
            $examples[] = "// {$method['description']}";
            $examples[] = $this->generateMethodUsage($method, $className);
            $examples[] = '';
        }

        return \implode("\n", $examples);
    }

    /**
     * 生成依赖注入示例
     */
    private function generateDependencyInjectionExample(array $classInfo): string
    {
        $className = $classInfo['name'];
        $interface = $classInfo['interfaces'][0] ?? $className;

        return <<<PHP
// Bind in container
\$container->bind({$interface}::class, {$className}::class);

// Resolve from container
\$instance = construct({$interface}::class);
PHP;
    }

    /**
     * 生成方法签名
     */
    private function generateMethodSignature(array $method): string
    {
        $visibility = $method['visibility'];
        $static = $method['isStatic'] ? 'static ' : '';
        $name = $method['name'];
        $returnType = $method['returnType'] ?? 'mixed';

        $params = [];
        foreach ($method['parameters'] as $param) {
            $paramStr = '';
            if ($param['type']) {
                $paramStr .= $param['type'] . ' ';
            }
            $paramStr .= '$' . $param['name'];
            if ($param['hasDefault']) {
                $paramStr .= ' = ' . $this->formatDefaultValue($param['default']);
            }
            $params[] = $paramStr;
        }

        $paramString = \implode(', ', $params);

        return <<<PHP
    {$visibility} {$static}function {$name}({$paramString}): {$returnType}
    {
        // TODO: Implement {$name}
    }
PHP;
    }

    /**
     * 生成参数值示例
     */
    private function generateParameterValue(array $param): string
    {
        $type = $param['type'] ?? 'mixed';
        $name = $param['name'];

        // 根据参数名生成有意义的值
        $namedValue = $this->generateNamedParameterValue($name);
        if (null !== $namedValue) {
            return $namedValue;
        }

        // 根据类型生成值
        return $this->generateTypedValue($type);
    }

    /**
     * 根据参数名生成值
     */
    private function generateNamedParameterValue(string $name): ?string
    {
        return match (true) {
            \str_contains($name, 'id') || \str_contains($name, 'Id') => '1',
            \str_contains($name, 'name') || \str_contains($name, 'Name') => "'example'",
            \str_contains($name, 'email') || \str_contains($name, 'Email') => "'user@example.com'",
            \str_contains($name, 'url') || \str_contains($name, 'Url') => "'https://example.com'",
            \str_contains($name, 'path') || \str_contains($name, 'Path') => "'/path/to/file'",
            \str_contains($name, 'config') => '[]',
            \str_contains($name, 'options') => '[]',
            \str_contains($name, 'data') => '[]',
            \str_contains($name, 'timeout') => '30',
            \str_contains($name, 'limit') => '100',
            \str_contains($name, 'offset') => '0',
            \str_contains($name, 'count') => '10',
            \str_contains($name, 'size') => '1024',
            \str_contains($name, 'key') => "'key'",
            \str_contains($name, 'value') => "'value'",
            \str_contains($name, 'ttl') => '3600',
            default => null,
        };
    }

    /**
     * 根据类型生成值
     */
    private function generateTypedValue(string $type): string
    {
        // 处理可空类型
        if (\str_starts_with($type, '?')) {
            $type = \mb_substr($type, 1);
        }

        // 处理联合类型
        if (\str_contains($type, '|')) {
            $types = \explode('|', $type);
            $type = $types[0]; // 使用第一个类型
        }

        return match ($type) {
            'string' => "'example'",
            'int', 'integer' => '0',
            'float', 'double' => '0.0',
            'bool', 'boolean' => 'false',
            'array' => '[]',
            'callable' => 'fn() => null',
            'object' => 'new \\stdClass()',
            'mixed' => 'null',
            'null' => 'null',
            'void' => '',
            default => $this->generateObjectValue($type),
        };
    }

    /**
     * 生成对象类型的值
     */
    private function generateObjectValue(string $type): string
    {
        // 如果是接口，使用 construct()
        if (\str_ends_with($type, 'Interface')) {
            return "construct({$type}::class)";
        }

        // 如果是具体类
        if (\class_exists($type)) {
            return "new {$type}()";
        }

        // 使用 construct 函数（框架依赖注入）
        return "construct({$type}::class)";
    }

    /**
     * 获取结果变量名
     */
    private function getResultVariableName(string $returnType): string
    {
        if (\str_starts_with($returnType, '?')) {
            $returnType = \mb_substr($returnType, 1);
        }

        return match ($returnType) {
            'string' => 'result',
            'int', 'integer' => 'count',
            'float', 'double' => 'value',
            'bool', 'boolean' => 'success',
            'array' => 'items',
            'void' => 'void',
            default => 'result',
        };
    }

    /**
     * 格式化默认值
     */
    private function formatDefaultValue(mixed $value): string
    {
        if (null === $value) {
            return 'null';
        }
        if (\is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if (\is_string($value)) {
            return "'{$value}'";
        }
        if (\is_array($value)) {
            return '[]';
        }

        return (string) $value;
    }

    /**
     * 生成 Attribute 参数示例
     */
    private function generateAttributeParameterExample(array $param): ?string
    {
        // 跳过可选参数，除非是核心参数
        $coreParams = ['pattern', 'desc', 'name', 'ttl', 'prefix', 'connection'];
        if ($param['isOptional'] && ! \in_array($param['name'], $coreParams, true)) {
            return null;
        }

        return match ($param['name']) {
            'pattern' => "'/users/{id}'",
            'desc' => "'Get user by ID'",
            'name' => "'example'",
            'ttl' => '3600',
            'prefix' => "'/api'",
            'middlewares' => '[]',
            'auth' => 'true',
            'cors' => "''",
            'owner' => "''",
            'priority' => '0',
            'connection' => "'default'",
            'shortcut' => "'-n'",
            'default' => 'null',
            'required' => 'false',
            default => $this->generateTypedValue($param['type'] ?? 'mixed'),
        };
    }

    /**
     * 生成 Attribute 使用上下文
     */
    private function generateAttributeContext(string $attributeUsage, array $targets, string $shortName): string
    {
        unset($shortName); // 标记为有意未使用，保留参数以便未来扩展

        if (\in_array('CLASS', $targets, true)) {
            return <<<PHP
{$attributeUsage}
class ExampleController
{
    // Controller methods here
}
PHP;
        }

        if (\in_array('METHOD', $targets, true)) {
            return <<<PHP
class ExampleController
{
    {$attributeUsage}
    public function exampleAction(Context \$context): array
    {
        return ['status' => 'ok'];
    }
}
PHP;
        }

        if (\in_array('PARAMETER', $targets, true)) {
            return <<<PHP
class ExampleController
{
    public function create(
        {$attributeUsage}
        CreateRequest \$request
    ): Response {
        // Handle request
    }
}
PHP;
        }

        if (\in_array('PROPERTY', $targets, true)) {
            return <<<PHP
class Example
{
    {$attributeUsage}
    private string \$value;
}
PHP;
        }

        return $attributeUsage;
    }
}
