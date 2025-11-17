<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Renderer;

/**
 * 类/接口/Trait Markdown 渲染器
 */
final class ClassMarkdownRenderer extends MarkdownRenderer
{
    public function render(array $classInfo): string
    {
        $md = '';

        // Front Matter
        $md .= $this->renderFrontMatter([
            'fqcn' => $classInfo['fqcn'],
            'type' => $classInfo['type'],
            'namespace' => $classInfo['namespace'],
            'module' => $this->extractModule($classInfo['namespace']),
            'file' => $this->relativePath($classInfo['file']),
            'line' => $classInfo['startLine'],
        ]);

        // 标题
        $md .= $this->renderHeading($classInfo['name']);

        // 基本信息
        $md .= $this->renderParagraph(
            $this->renderBold('命名空间') . ': ' . $this->renderInlineCode($classInfo['namespace'])
        );
        $md .= $this->renderParagraph(
            $this->renderBold('类型') . ': ' . ucfirst($classInfo['type'])
        );
        $md .= $this->renderParagraph(
            $this->renderBold('文件') . ': ' . $this->renderInlineCode($this->relativePath($classInfo['file']) . ':' . $classInfo['startLine'])
        );

        // 修饰符
        $modifiers = [];
        if ($classInfo['isFinal'] ?? false) {
            $modifiers[] = 'final';
        }
        if ($classInfo['isAbstract'] ?? false) {
            $modifiers[] = 'abstract';
        }
        if ($classInfo['isReadonly'] ?? false) {
            $modifiers[] = 'readonly';
        }
        if (! empty($modifiers)) {
            $md .= $this->renderParagraph(
                $this->renderBold('修饰符') . ': ' . implode(', ', $modifiers)
            );
        }

        // 描述
        if (! empty($classInfo['summary'])) {
            $md .= $this->renderParagraph($classInfo['summary']);
        }
        if (! empty($classInfo['description'])) {
            $md .= $this->renderParagraph($classInfo['description']);
        }

        // 继承关系
        $md .= $this->renderInheritance($classInfo);

        // 常量
        $md .= $this->renderConstants($classInfo['constants'] ?? []);

        // 属性
        $md .= $this->renderProperties($classInfo['properties'] ?? []);

        // 方法
        $md .= $this->renderMethods($classInfo['methods'] ?? []);

        // 使用示例（如果是 Attribute）
        if ($classInfo['isAttribute'] ?? false) {
            $md .= $this->renderAttributeUsage($classInfo);
        }

        return $md;
    }

    private function extractModule(string $namespace): string
    {
        $parts = explode('\\', $namespace);
        if (count($parts) >= 2 && 'Hi' === $parts[0]) {
            return $parts[1];
        }

        return $parts[0] ?? 'Unknown';
    }

    private function relativePath(string $path): string
    {
        // 提取 src/ 之后的部分
        if (preg_match('/\/src\/(.+)$/', $path, $matches)) {
            return 'src/' . $matches[1];
        }

        return basename($path);
    }

    private function renderInheritance(array $classInfo): string
    {
        $md = '';

        $hasInheritance = ! empty($classInfo['extends'])
            || ! empty($classInfo['implements'])
            || ! empty($classInfo['traits']);

        if (! $hasInheritance) {
            return $md;
        }

        $md .= $this->renderHeading('继承关系', 2);

        if (! empty($classInfo['extends'])) {
            $md .= $this->renderParagraph(
                $this->renderBold('继承') . ': ' . $this->renderInlineCode($classInfo['extends'])
            );
        }

        if (! empty($classInfo['implements'])) {
            $md .= $this->renderParagraph(
                $this->renderBold('实现') . ': ' . implode(', ', array_map(
                    fn ($i) => $this->renderInlineCode($i),
                    $classInfo['implements']
                ))
            );
        }

        if (! empty($classInfo['traits'])) {
            $md .= $this->renderParagraph(
                $this->renderBold('使用 Traits') . ': ' . implode(', ', array_map(
                    fn ($t) => $this->renderInlineCode($t),
                    $classInfo['traits']
                ))
            );
        }

        return $md;
    }

    private function renderConstants(array $constants): string
    {
        if (empty($constants)) {
            return '';
        }

        $md = $this->renderHeading('常量', 2);

        $rows = [];
        foreach ($constants as $const) {
            $rows[] = [
                $this->renderInlineCode($const['name']),
                $this->formatDefaultValue($const['value']),
                $const['visibility'],
                $const['summary'] ?? '',
            ];
        }

        $md .= $this->renderTable(['名称', '值', '可见性', '描述'], $rows);

        return $md;
    }

    private function renderProperties(array $properties): string
    {
        if (empty($properties)) {
            return '';
        }

        $md = $this->renderHeading('属性', 2);

        $rows = [];
        foreach ($properties as $prop) {
            $modifiers = [];
            if ($prop['isStatic']) {
                $modifiers[] = 'static';
            }
            if ($prop['isReadonly']) {
                $modifiers[] = 'readonly';
            }

            $type = $prop['type'] ?? $prop['typeFromDoc'] ?? 'mixed';

            $rows[] = [
                $this->renderInlineCode('$' . $prop['name']),
                $this->formatType($type),
                $prop['visibility'] . (empty($modifiers) ? '' : ' ' . implode(' ', $modifiers)),
                $prop['hasDefault'] ? $this->formatDefaultValue($prop['default']) : '-',
                $prop['summary'] ?? '',
            ];
        }

        $md .= $this->renderTable(['属性', '类型', '可见性', '默认值', '描述'], $rows);

        return $md;
    }

    private function renderMethods(array $methods): string
    {
        if (empty($methods)) {
            return '';
        }

        $md = $this->renderHeading('方法', 2);

        // 按可见性分组
        $publicMethods = [];
        $protectedMethods = [];
        $privateMethods = [];

        foreach ($methods as $method) {
            match ($method['visibility']) {
                'public' => $publicMethods[] = $method,
                'protected' => $protectedMethods[] = $method,
                default => $privateMethods[] = $method,
            };
        }

        // 渲染公共方法
        if (! empty($publicMethods)) {
            $md .= $this->renderHeading('Public 方法', 3);
            foreach ($publicMethods as $method) {
                $md .= $this->renderMethod($method);
            }
        }

        // 渲染保护方法
        if (! empty($protectedMethods)) {
            $md .= $this->renderHeading('Protected 方法', 3);
            foreach ($protectedMethods as $method) {
                $md .= $this->renderMethod($method);
            }
        }

        return $md;
    }

    private function renderMethod(array $method): string
    {
        $md = '';

        // 方法签名
        $signature = $this->buildMethodSignature($method);
        $md .= $this->renderHeading($this->renderInlineCode($method['name']), 4);

        // 标记
        $badges = [];
        if ($method['isStatic']) {
            $badges[] = 'static';
        }
        if ($method['isAbstract']) {
            $badges[] = 'abstract';
        }
        if ($method['isFinal']) {
            $badges[] = 'final';
        }
        if ($method['deprecated'] ?? false) {
            $badges[] = 'deprecated';
        }

        if (! empty($badges)) {
            $md .= $this->renderParagraph('**标记**: ' . implode(', ', $badges));
        }

        // 签名代码
        $md .= $this->renderCodeBlock($signature);

        // 描述
        if (! empty($method['summary'])) {
            $md .= $this->renderParagraph($method['summary']);
        }

        // 参数
        if (! empty($method['parameters'])) {
            $md .= $this->renderParagraph('**参数**:');

            $rows = [];
            foreach ($method['parameters'] as $param) {
                $type = $param['type'] ?? $param['typeFromDoc'] ?? 'mixed';
                $name = '$' . $param['name'];
                if ($param['isVariadic']) {
                    $name = '...' . $name;
                }

                $rows[] = [
                    $this->renderInlineCode($name),
                    $this->formatType($type),
                    $param['hasDefault'] ? $this->formatDefaultValue($param['default']) : '-',
                    $param['description'] ?? '',
                ];
            }

            $md .= $this->renderTable(['参数', '类型', '默认值', '描述'], $rows);
        }

        // 返回值
        $returnType = $method['returnType'] ?? $method['returnTypeFromDoc'] ?? 'void';
        $md .= $this->renderParagraph(
            '**返回**: ' . $this->formatType($returnType) .
            (! empty($method['returnDescription']) ? ' - ' . $method['returnDescription'] : '')
        );

        // 异常
        if (! empty($method['throws'])) {
            $md .= $this->renderParagraph('**抛出异常**:');
            $items = [];
            foreach ($method['throws'] as $throw) {
                $items[] = $this->renderInlineCode($throw['type']) .
                    (! empty($throw['description']) ? ' - ' . $throw['description'] : '');
            }
            $md .= $this->renderList($items);
        }

        return $md;
    }

    private function buildMethodSignature(array $method): string
    {
        $parts = [];

        // 修饰符
        if ($method['isFinal']) {
            $parts[] = 'final';
        }
        if ($method['isAbstract']) {
            $parts[] = 'abstract';
        }
        $parts[] = $method['visibility'];
        if ($method['isStatic']) {
            $parts[] = 'static';
        }

        $parts[] = 'function';
        $parts[] = $method['name'];

        // 参数
        $params = [];
        foreach ($method['parameters'] as $param) {
            $paramStr = '';

            if (! empty($param['type'])) {
                $paramStr .= $param['type'] . ' ';
            }

            if ($param['isReference'] ?? false) {
                $paramStr .= '&';
            }

            if ($param['isVariadic']) {
                $paramStr .= '...';
            }

            $paramStr .= '$' . $param['name'];

            if ($param['hasDefault']) {
                $paramStr .= ' = ' . $this->formatDefaultValue($param['default']);
            }

            $params[] = $paramStr;
        }

        $signature = implode(' ', $parts) . '(' . implode(', ', $params) . ')';

        // 返回类型
        if (! empty($method['returnType'])) {
            $signature .= ': ' . $method['returnType'];
        }

        return $signature;
    }

    private function renderAttributeUsage(array $classInfo): string
    {
        $md = $this->renderHeading('Attribute 信息', 2);

        $targets = $classInfo['attributeTargets'] ?? ['ALL'];
        $repeatable = $classInfo['isRepeatable'] ?? false;

        $md .= $this->renderParagraph(
            $this->renderBold('目标') . ': ' . implode(', ', $targets)
        );
        $md .= $this->renderParagraph(
            $this->renderBold('可重复') . ': ' . ($repeatable ? '是' : '否')
        );

        // 生成使用示例
        $md .= $this->renderHeading('使用示例', 3);

        $example = $this->generateAttributeExample($classInfo);
        $md .= $this->renderCodeBlock($example);

        return $md;
    }

    private function generateAttributeExample(array $classInfo): string
    {
        $name = $classInfo['name'];
        $constructor = null;

        // 找到构造函数
        foreach ($classInfo['methods'] as $method) {
            if ('__construct' === $method['name']) {
                $constructor = $method;

                break;
            }
        }

        if (null === $constructor || empty($constructor['parameters'])) {
            return "#[{$name}]\nclass MyClass {}";
        }

        // 构建参数示例
        $args = [];
        foreach ($constructor['parameters'] as $param) {
            if ($param['hasDefault']) {
                continue; // 跳过有默认值的参数
            }

            $value = $this->generateExampleValue($param);
            $args[] = $param['name'] . ': ' . $value;
        }

        $argStr = empty($args) ? '' : '(' . implode(', ', $args) . ')';

        return "#[{$name}{$argStr}]\nclass MyClass {}";
    }

    private function generateExampleValue(array $param): string
    {
        $type = $param['type'] ?? 'mixed';

        return match (true) {
            str_contains($type, 'string') => "'/example'",
            str_contains($type, 'int') => '1',
            str_contains($type, 'float') => '1.0',
            str_contains($type, 'bool') => 'true',
            str_contains($type, 'array') => '[]',
            default => 'null',
        };
    }
}
