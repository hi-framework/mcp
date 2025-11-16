<?php

declare(strict_types=1);

namespace Hi\MCP\Analyzer;

/**
 * PHPDoc 注释解析器
 */
final class DocBlockParser
{
    /**
     * 解析 DocBlock 注释
     *
     * @return array{description: string, tags: array<string, array>}
     */
    public function parse(?string $docComment): array
    {
        if (null === $docComment || '' === $docComment) {
            return ['description' => '', 'tags' => []];
        }

        $lines = \explode("\n", $docComment);
        $description = [];
        $tags = [];
        $currentTag = null;
        $currentTagContent = [];

        foreach ($lines as $line) {
            $line = \trim($line);
            // 移除注释标记
            $line = \preg_replace('/^\/\*\*|\*\/|\*/', '', $line);
            $line = \trim($line);

            if ('' === $line) {
                if (null === $currentTag && ! empty($description)) {
                    $description[] = '';
                }
                continue;
            }

            // 检查是否是标签行
            if (\str_starts_with($line, '@')) {
                // 保存之前的标签
                if (null !== $currentTag) {
                    $tags[$currentTag][] = \implode(' ', $currentTagContent);
                }

                // 解析新标签
                $parts = \preg_split('/\s+/', $line, 2);
                $currentTag = \mb_substr($parts[0], 1); // 移除 @
                $currentTagContent = isset($parts[1]) ? [$parts[1]] : [];
            } elseif (null !== $currentTag) {
                // 继续当前标签内容
                $currentTagContent[] = $line;
            } else {
                // 描述部分
                $description[] = $line;
            }
        }

        // 保存最后一个标签
        if (null !== $currentTag) {
            $tags[$currentTag][] = \implode(' ', $currentTagContent);
        }

        return [
            'description' => \trim(\implode("\n", $description)),
            'tags' => $tags,
        ];
    }

    /**
     * 解析 @param 标签
     *
     * @return array{type: string, name: string, description: string}|null
     */
    public function parseParamTag(string $tag): ?array
    {
        // 格式: type $name description
        if (\preg_match('/^(\S+)\s+\$(\w+)(?:\s+(.*))?$/', $tag, $matches)) {
            return [
                'type' => $matches[1],
                'name' => $matches[2],
                'description' => $matches[3] ?? '',
            ];
        }

        return null;
    }

    /**
     * 解析 @return 标签
     *
     * @return array{type: string, description: string}|null
     */
    public function parseReturnTag(string $tag): ?array
    {
        $parts = \preg_split('/\s+/', $tag, 2);
        if (! empty($parts[0])) {
            return [
                'type' => $parts[0],
                'description' => $parts[1] ?? '',
            ];
        }

        return null;
    }

    /**
     * 解析 @throws 标签
     *
     * @return array{type: string, description: string}|null
     */
    public function parseThrowsTag(string $tag): ?array
    {
        $parts = \preg_split('/\s+/', $tag, 2);
        if (! empty($parts[0])) {
            return [
                'type' => $parts[0],
                'description' => $parts[1] ?? '',
            ];
        }

        return null;
    }
}
