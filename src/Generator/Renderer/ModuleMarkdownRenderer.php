<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Renderer;

/**
 * 模块文档 Markdown 渲染器
 *
 * 生成模块概览文档，整合 API 和使用指南
 */
final class ModuleMarkdownRenderer extends MarkdownRenderer
{
    public function render(array $moduleInfo): string
    {
        $md = '';

        // Front Matter
        $md .= $this->renderFrontMatter([
            'module' => $moduleInfo['name'],
            'namespaces' => $moduleInfo['namespaces'] ?? [],
            'class_count' => count($moduleInfo['classes'] ?? []),
            'interface_count' => count($moduleInfo['interfaces'] ?? []),
            'trait_count' => count($moduleInfo['traits'] ?? []),
            'enum_count' => count($moduleInfo['enums'] ?? []),
            'attribute_count' => count($moduleInfo['attributes'] ?? []),
        ]);

        // 标题
        $md .= $this->renderHeading($moduleInfo['name'] . ' 模块');

        // 描述
        if (! empty($moduleInfo['description'])) {
            $md .= $this->renderParagraph($moduleInfo['description']);
        }

        // 统计信息
        $md .= $this->renderHeading('概览', 2);
        $stats = [
            '类: ' . count($moduleInfo['classes'] ?? []),
            '接口: ' . count($moduleInfo['interfaces'] ?? []),
            'Traits: ' . count($moduleInfo['traits'] ?? []),
            '枚举: ' . count($moduleInfo['enums'] ?? []),
            'Attributes: ' . count($moduleInfo['attributes'] ?? []),
        ];
        $md .= $this->renderList($stats);

        // 使用指南
        if (! empty($moduleInfo['guides'])) {
            $md .= $this->renderHeading('使用指南', 2);

            $guideLinks = [];
            foreach ($moduleInfo['guides'] as $guide) {
                $title = $guide['title'] ?? basename($guide['path'], '.md');
                $guideLinks[] = $this->renderLink($title, $guide['path']);
            }

            $md .= $this->renderList($guideLinks);
        }

        // 核心概念
        if (! empty($moduleInfo['concepts'])) {
            $md .= $this->renderHeading('核心概念', 2);

            $conceptLinks = [];
            foreach ($moduleInfo['concepts'] as $concept) {
                $title = $concept['title'] ?? basename($concept['path'], '.md');
                $conceptLinks[] = $this->renderLink($title, $concept['path']);
            }

            $md .= $this->renderList($conceptLinks);
        }

        // API 参考
        $md .= $this->renderHeading('API 参考', 2);

        // Attributes
        if (! empty($moduleInfo['attributes'])) {
            $md .= $this->renderHeading('Attributes', 3);
            $md .= $this->renderClassTable($moduleInfo['attributes'], 'attributes');
        }

        // 接口
        if (! empty($moduleInfo['interfaces'])) {
            $md .= $this->renderHeading('接口', 3);
            $md .= $this->renderClassTable($moduleInfo['interfaces'], 'interfaces');
        }

        // 类
        if (! empty($moduleInfo['classes'])) {
            $md .= $this->renderHeading('类', 3);
            $md .= $this->renderClassTable($moduleInfo['classes'], 'classes');
        }

        // Traits
        if (! empty($moduleInfo['traits'])) {
            $md .= $this->renderHeading('Traits', 3);
            $md .= $this->renderClassTable($moduleInfo['traits'], 'traits');
        }

        // 枚举
        if (! empty($moduleInfo['enums'])) {
            $md .= $this->renderHeading('枚举', 3);
            $md .= $this->renderClassTable($moduleInfo['enums'], 'enums');
        }

        // 快速示例
        if (! empty($moduleInfo['quickExample'])) {
            $md .= $this->renderHeading('快速示例', 2);
            $md .= $this->renderCodeBlock($moduleInfo['quickExample']);
        }

        return $md;
    }

    /**
     * 渲染类/接口表格
     */
    private function renderClassTable(array $items, string $type): string
    {
        $rows = [];

        foreach ($items as $item) {
            $fqcn = is_array($item) ? $item['fqcn'] : $item;
            $name = is_array($item) ? $item['name'] : $this->extractClassName($fqcn);
            $summary = is_array($item) ? ($item['summary'] ?? '') : '';

            $docPath = '../api/' . $type . '/' . $this->fqcnToFilename($fqcn);
            $link = $this->renderLink($this->renderInlineCode($name), $docPath);

            $rows[] = [$link, $summary];
        }

        return $this->renderTable(['名称', '描述'], $rows);
    }

    /**
     * 从 FQCN 提取类名
     */
    private function extractClassName(string $fqcn): string
    {
        $parts = explode('\\', $fqcn);

        return end($parts) ?: $fqcn;
    }
}
