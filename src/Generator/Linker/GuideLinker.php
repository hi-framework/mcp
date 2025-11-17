<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Linker;

/**
 * 使用指南关联器
 *
 * 将现有文档与模块和类关联起来
 */
final class GuideLinker
{
    private array $guides = [];
    private array $moduleGuides = [];
    private array $conceptGuides = [];

    /**
     * 扫描文档目录
     */
    public function scan(string $docsPath): void
    {
        if (! is_dir($docsPath)) {
            return;
        }

        $this->scanDirectory($docsPath, $docsPath);
    }

    /**
     * 递归扫描目录
     */
    private function scanDirectory(string $directory, string $basePath): void
    {
        $iterator = new \DirectoryIterator($directory);

        foreach ($iterator as $item) {
            if ($item->isDot()) {
                continue;
            }

            if ($item->isDir()) {
                // 跳过特殊目录
                $skipDirs = ['node_modules', '.vitepress', 'public', 'images', '.git'];
                if (in_array($item->getFilename(), $skipDirs, true)) {
                    continue;
                }

                $this->scanDirectory($item->getPathname(), $basePath);
            } elseif ($item->isFile() && 'md' === $item->getExtension()) {
                $this->processGuideFile($item->getPathname(), $basePath);
            }
        }
    }

    /**
     * 处理单个指南文件
     */
    private function processGuideFile(string $filePath, string $basePath): void
    {
        $relativePath = $this->getRelativePath($filePath, $basePath);
        $content = file_get_contents($filePath);
        if (false === $content) {
            return;
        }

        $title = $this->extractTitle($content);
        $keywords = $this->extractKeywords($content);
        $category = $this->determineCategory($relativePath);

        $guide = [
            'path' => $relativePath,
            'title' => $title,
            'keywords' => $keywords,
            'category' => $category,
            'module' => $this->inferModule($relativePath),
        ];

        $this->guides[$relativePath] = $guide;

        // 分类
        if ('concept' === $category) {
            $this->conceptGuides[] = $guide;
        } else {
            $module = $guide['module'];
            if ($module) {
                if (! isset($this->moduleGuides[$module])) {
                    $this->moduleGuides[$module] = [];
                }
                $this->moduleGuides[$module][] = $guide;
            }
        }
    }

    /**
     * 提取文档标题
     */
    private function extractTitle(string $content): string
    {
        // 尝试从 front matter 提取
        if (preg_match('/^---\s*\n.*?title:\s*["\']?([^"\'\n]+)["\']?\s*\n.*?---/s', $content, $matches)) {
            return trim($matches[1]);
        }

        // 尝试从第一个 # 标题提取
        if (preg_match('/^#\s+(.+)$/m', $content, $matches)) {
            return trim($matches[1]);
        }

        return 'Untitled';
    }

    /**
     * 提取关键词
     */
    private function extractKeywords(string $content): array
    {
        $keywords = [];

        // 从标题提取
        if (preg_match_all('/^#+\s+(.+)$/m', $content, $matches)) {
            foreach ($matches[1] as $heading) {
                $words = preg_split('/\s+/', strtolower($heading));
                if (false !== $words) {
                    $keywords = array_merge($keywords, $words);
                }
            }
        }

        // 从代码块提取类名
        if (preg_match_all('/`([A-Z][a-zA-Z0-9_\\\\]+)`/', $content, $matches)) {
            $keywords = array_merge($keywords, array_map('strtolower', $matches[1]));
        }

        // 清理和去重
        $keywords = array_filter($keywords, fn ($k) => strlen($k) > 2);
        $keywords = array_unique($keywords);

        return array_values($keywords);
    }

    /**
     * 确定文档类别
     */
    private function determineCategory(string $path): string
    {
        if (str_contains($path, 'concepts/')) {
            return 'concept';
        }

        if (str_contains($path, 'examples/')) {
            return 'example';
        }

        return 'guide';
    }

    /**
     * 推断关联的模块
     */
    private function inferModule(string $path): ?string
    {
        // 从路径推断模块
        $moduleMap = [
            'http/' => 'Http',
            'database/' => 'Database',
            'cache/' => 'Cache',
            'redis/' => 'Redis',
            'kafka/' => 'Kafka',
            'elasticsearch/' => 'Elasticsearch',
            'kernel/' => 'Kernel',
            'exception/' => 'Exception',
            'deploy/' => 'Runtime',
            'connection-pool/' => 'ConnectionPool',
            'sidecar/' => 'Sidecar',
        ];

        foreach ($moduleMap as $prefix => $module) {
            if (str_contains($path, $prefix)) {
                return $module;
            }
        }

        // 从组件文档推断
        if (str_contains($path, 'components/')) {
            if (preg_match('/components\/([^.]+)\.md$/', $path, $matches)) {
                return ucfirst($matches[1]);
            }
        }

        return null;
    }

    /**
     * 获取相对路径
     */
    private function getRelativePath(string $path, string $basePath): string
    {
        $basePath = rtrim($basePath, '/') . '/';
        if (str_starts_with($path, $basePath)) {
            return substr($path, strlen($basePath));
        }

        return $path;
    }

    /**
     * 获取模块的指南文档
     */
    public function getGuidesForModule(string $moduleName): array
    {
        return $this->moduleGuides[$moduleName] ?? [];
    }

    /**
     * 获取概念文档
     */
    public function getConceptGuides(): array
    {
        return $this->conceptGuides;
    }

    /**
     * 获取所有指南
     */
    public function getAllGuides(): array
    {
        return $this->guides;
    }

    /**
     * 根据关键词搜索指南
     */
    public function searchGuides(string $keyword): array
    {
        $keyword = strtolower($keyword);
        $results = [];

        foreach ($this->guides as $guide) {
            $score = 0;

            // 标题匹配
            if (str_contains(strtolower($guide['title']), $keyword)) {
                $score += 10;
            }

            // 关键词匹配
            foreach ($guide['keywords'] as $k) {
                if (str_contains($k, $keyword)) {
                    $score += 5;
                }
            }

            // 路径匹配
            if (str_contains(strtolower($guide['path']), $keyword)) {
                $score += 3;
            }

            if ($score > 0) {
                $results[] = [
                    'guide' => $guide,
                    'score' => $score,
                ];
            }
        }

        // 按分数排序
        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return array_map(fn ($r) => $r['guide'], $results);
    }
}
