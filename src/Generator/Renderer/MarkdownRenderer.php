<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Renderer;

/**
 * Markdown 渲染基类
 *
 * 提供通用的 Markdown 生成方法
 */
abstract class MarkdownRenderer
{
    /**
     * 渲染类信息为 Markdown
     */
    abstract public function render(array $classInfo): string;

    /**
     * 渲染前置元数据（YAML Front Matter）
     */
    protected function renderFrontMatter(array $data): string
    {
        $lines = ['---'];

        foreach ($data as $key => $value) {
            $lines[] = $key . ': ' . $this->formatYamlValue($value);
        }

        $lines[] = '---';
        $lines[] = '';

        return implode("\n", $lines);
    }

    /**
     * 格式化 YAML 值
     */
    protected function formatYamlValue(mixed $value): string
    {
        if (is_array($value)) {
            if (empty($value)) {
                return '[]';
            }

            return '[' . implode(', ', array_map(fn ($v) => is_string($v) ? $v : (string) $v, $value)) . ']';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_null($value)) {
            return 'null';
        }

        return (string) $value;
    }

    /**
     * 渲染标题
     */
    protected function renderHeading(string $text, int $level = 1): string
    {
        return str_repeat('#', $level) . ' ' . $text . "\n\n";
    }

    /**
     * 渲染段落
     */
    protected function renderParagraph(string $text): string
    {
        if ('' === trim($text)) {
            return '';
        }

        return $text . "\n\n";
    }

    /**
     * 渲染代码块
     */
    protected function renderCodeBlock(string $code, string $language = 'php'): string
    {
        return "```{$language}\n{$code}\n```\n\n";
    }

    /**
     * 渲染表格
     */
    protected function renderTable(array $headers, array $rows): string
    {
        if (empty($rows)) {
            return '';
        }

        $lines = [];

        // 表头
        $lines[] = '| ' . implode(' | ', $headers) . ' |';
        $lines[] = '| ' . implode(' | ', array_fill(0, count($headers), '---')) . ' |';

        // 表体
        foreach ($rows as $row) {
            $cells = array_map(fn ($cell) => $this->escapeTableCell($cell), $row);
            $lines[] = '| ' . implode(' | ', $cells) . ' |';
        }

        $lines[] = '';

        return implode("\n", $lines) . "\n";
    }

    /**
     * 转义表格单元格内容
     */
    protected function escapeTableCell(string $content): string
    {
        // 替换竖线和换行
        $content = str_replace('|', '\\|', $content);
        $content = str_replace("\n", ' ', $content);

        return $content;
    }

    /**
     * 渲染列表
     */
    protected function renderList(array $items, bool $ordered = false): string
    {
        if (empty($items)) {
            return '';
        }

        $lines = [];
        $index = 1;

        foreach ($items as $item) {
            $prefix = $ordered ? "{$index}. " : '- ';
            $lines[] = $prefix . $item;
            ++$index;
        }

        $lines[] = '';

        return implode("\n", $lines) . "\n";
    }

    /**
     * 渲染链接
     */
    protected function renderLink(string $text, string $url): string
    {
        return "[{$text}]({$url})";
    }

    /**
     * 渲染内联代码
     */
    protected function renderInlineCode(string $code): string
    {
        return '`' . $code . '`';
    }

    /**
     * 渲染粗体
     */
    protected function renderBold(string $text): string
    {
        return '**' . $text . '**';
    }

    /**
     * 格式化类型为 Markdown 友好格式
     */
    protected function formatType(?string $type): string
    {
        if (null === $type || '' === $type) {
            return 'mixed';
        }

        return $this->renderInlineCode($type);
    }

    /**
     * 格式化默认值显示
     */
    protected function formatDefaultValue(mixed $value): string
    {
        if (null === $value) {
            return 'null';
        }

        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_string($value)) {
            return "'{$value}'";
        }

        if (is_array($value)) {
            return '[]';
        }

        return (string) $value;
    }

    /**
     * 生成 FQCN 对应的文件名
     */
    protected function fqcnToFilename(string $fqcn): string
    {
        return str_replace('\\', '.', $fqcn) . '.md';
    }
}
