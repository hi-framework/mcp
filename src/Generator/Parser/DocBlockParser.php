<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Parser;

/**
 * PHPDoc 文档块解析器
 *
 * 提取描述、标签、参数说明等信息
 */
final class DocBlockParser
{
    /**
     * 解析文档块
     */
    public function parse(?string $docComment): array
    {
        if (null === $docComment || '' === $docComment) {
            return [
                'summary' => '',
                'description' => '',
                'tags' => [],
            ];
        }

        // 移除 /** 和 */
        $content = preg_replace('/^\s*\/\*\*|\*\/\s*$/s', '', $docComment);
        if (null === $content) {
            $content = $docComment;
        }

        // 按行处理
        $lines = explode("\n", $content);
        $cleanLines = [];

        foreach ($lines as $line) {
            // 移除行首的 * 和空格
            $line = preg_replace('/^\s*\*\s?/', '', $line);
            $cleanLines[] = $line ?? '';
        }

        // 分离描述和标签
        $description = [];
        $tags = [];
        $inTags = false;

        foreach ($cleanLines as $line) {
            $trimmed = trim($line);

            if (str_starts_with($trimmed, '@')) {
                $inTags = true;
                $parsed = $this->parseTag($trimmed);
                if ($parsed) {
                    $tagName = $parsed['name'];
                    if (! isset($tags[$tagName])) {
                        $tags[$tagName] = [];
                    }
                    $tags[$tagName][] = $parsed['value'];
                }
            } elseif (! $inTags) {
                $description[] = $line;
            }
        }

        // 提取摘要（第一行非空内容）
        $descText = implode("\n", $description);
        $descText = trim($descText);

        $summary = '';
        $fullDesc = '';

        if ('' !== $descText) {
            $parts = preg_split('/\n\s*\n/', $descText, 2);
            if (false !== $parts && count($parts) > 0) {
                $summary = trim($parts[0]);
                $fullDesc = isset($parts[1]) ? trim($parts[1]) : '';
            }
        }

        return [
            'summary' => $this->cleanText($summary),
            'description' => $this->cleanText($fullDesc),
            'tags' => $tags,
        ];
    }

    /**
     * 解析单个标签
     */
    private function parseTag(string $line): ?array
    {
        if (! preg_match('/^@(\w+)(?:\s+(.*))?$/', $line, $matches)) {
            return null;
        }

        $name = $matches[1];
        $value = $matches[2] ?? '';

        return [
            'name' => $name,
            'value' => trim($value),
        ];
    }

    /**
     * 解析 @param 标签
     */
    public function parseParamTag(string $value): ?array
    {
        // @param Type $name Description
        if (! preg_match('/^(\S+)\s+\$(\w+)(?:\s+(.*))?$/', $value, $matches)) {
            return null;
        }

        return [
            'type' => $matches[1],
            'name' => $matches[2],
            'description' => $matches[3] ?? '',
        ];
    }

    /**
     * 解析 @return 标签
     */
    public function parseReturnTag(string $value): array
    {
        // @return Type Description
        $parts = preg_split('/\s+/', $value, 2);
        if (false === $parts) {
            $parts = [$value];
        }

        return [
            'type' => $parts[0] ?? '',
            'description' => $parts[1] ?? '',
        ];
    }

    /**
     * 解析 @throws 标签
     */
    public function parseThrowsTag(string $value): array
    {
        $parts = preg_split('/\s+/', $value, 2);
        if (false === $parts) {
            $parts = [$value];
        }

        return [
            'type' => $parts[0] ?? '',
            'description' => $parts[1] ?? '',
        ];
    }

    /**
     * 清理文本，移除多余空白
     */
    private function cleanText(string $text): string
    {
        // 将多个换行替换为两个换行
        $text = preg_replace('/\n{3,}/', "\n\n", $text);

        return trim($text ?? '');
    }
}
