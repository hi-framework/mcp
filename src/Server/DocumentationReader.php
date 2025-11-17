<?php

declare(strict_types=1);

namespace Hi\MCP\Server;

/**
 * 文档读取器
 *
 * 从 .mcp 目录读取预生成的文档
 */
final class DocumentationReader
{
    private array $manifest;
    private string $mcpPath;

    public function __construct(string $mcpPath)
    {
        $this->mcpPath = rtrim($mcpPath, '/');
        $this->loadManifest();
    }

    /**
     * 加载主清单文件
     */
    private function loadManifest(): void
    {
        $manifestPath = $this->mcpPath . '/manifest.json';
        if (! file_exists($manifestPath)) {
            throw new \RuntimeException("Manifest file not found: {$manifestPath}");
        }

        $content = file_get_contents($manifestPath);
        if (false === $content) {
            throw new \RuntimeException("Failed to read manifest file");
        }

        $this->manifest = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * 获取框架信息
     */
    public function getFrameworkInfo(): array
    {
        return [
            'name' => $this->manifest['framework'] ?? 'Unknown',
            'version' => $this->manifest['framework_version'] ?? '0.0.0',
            'generated_at' => $this->manifest['generated_at'] ?? '',
        ];
    }

    /**
     * 获取统计信息
     */
    public function getStatistics(): array
    {
        return $this->manifest['statistics'] ?? [];
    }

    /**
     * 获取所有模块
     */
    public function getModules(): array
    {
        return array_keys($this->manifest['modules'] ?? []);
    }

    /**
     * 获取模块信息
     */
    public function getModuleInfo(string $moduleName): ?array
    {
        return $this->manifest['modules'][$moduleName] ?? null;
    }

    /**
     * 获取模块文档内容
     */
    public function getModuleDocument(string $moduleName): ?string
    {
        $path = $this->mcpPath . '/modules/' . $moduleName . '.md';
        if (! file_exists($path)) {
            return null;
        }

        return file_get_contents($path) ?: null;
    }

    /**
     * 获取类文档
     */
    public function getClassDocument(string $fqcn): ?string
    {
        $map = $this->manifest['search_index']['fqcn_map'] ?? [];
        if (! isset($map[$fqcn])) {
            return null;
        }

        $path = $this->mcpPath . '/' . $map[$fqcn];
        if (! file_exists($path)) {
            return null;
        }

        return file_get_contents($path) ?: null;
    }

    /**
     * 获取指南文档
     */
    public function getGuideDocument(string $guidePath): ?string
    {
        $path = $this->mcpPath . '/guides/' . ltrim($guidePath, '/');
        if (! file_exists($path)) {
            return null;
        }

        return file_get_contents($path) ?: null;
    }

    /**
     * 列出所有类
     */
    public function listClasses(?string $namespace = null): array
    {
        $classes = [];

        foreach ($this->manifest['modules'] ?? [] as $module) {
            foreach ($module['classes'] ?? [] as $class) {
                if (null === $namespace || str_starts_with($class['fqcn'], $namespace)) {
                    $classes[] = $class;
                }
            }
        }

        return $classes;
    }

    /**
     * 列出所有接口
     */
    public function listInterfaces(?string $namespace = null): array
    {
        $interfaces = [];

        foreach ($this->manifest['modules'] ?? [] as $module) {
            foreach ($module['interfaces'] ?? [] as $interface) {
                if (null === $namespace || str_starts_with($interface['fqcn'], $namespace)) {
                    $interfaces[] = $interface;
                }
            }
        }

        return $interfaces;
    }

    /**
     * 列出所有 Attributes
     */
    public function listAttributes(?string $namespace = null): array
    {
        $attributes = [];

        foreach ($this->manifest['modules'] ?? [] as $module) {
            foreach ($module['attributes'] ?? [] as $attribute) {
                if (null === $namespace || str_starts_with($attribute['fqcn'], $namespace)) {
                    $attributes[] = $attribute;
                }
            }
        }

        return $attributes;
    }

    /**
     * 搜索 API
     */
    public function search(string $query): array
    {
        $query = strtolower($query);
        $results = [];
        $seen = [];

        // 搜索关键词索引
        foreach ($this->manifest['search_index']['keywords'] ?? [] as $keyword => $data) {
            // 跳过非字符串键
            if (! is_string($keyword)) {
                continue;
            }
            if (str_contains($keyword, $query)) {
                foreach ($data['classes'] ?? [] as $fqcn) {
                    if (isset($seen[$fqcn])) {
                        continue;
                    }
                    $seen[$fqcn] = true;

                    $classInfo = $this->findClassInfo($fqcn);
                    if ($classInfo) {
                        $results[] = [
                            'type' => 'class',
                            'fqcn' => $fqcn,
                            'name' => $classInfo['name'],
                            'summary' => $classInfo['summary'],
                            'score' => $keyword === $query ? 10 : 5,
                        ];
                    }
                }

                foreach ($data['guides'] ?? [] as $guidePath) {
                    if (isset($seen[$guidePath])) {
                        continue;
                    }
                    $seen[$guidePath] = true;

                    $results[] = [
                        'type' => 'guide',
                        'path' => $guidePath,
                        'score' => $keyword === $query ? 8 : 4,
                    ];
                }
            }
        }

        // 直接搜索类名
        foreach ($this->manifest['modules'] ?? [] as $module) {
            foreach (['classes', 'interfaces', 'traits', 'enums', 'attributes'] as $type) {
                foreach ($module[$type] ?? [] as $item) {
                    if (isset($seen[$item['fqcn']])) {
                        continue;
                    }

                    $score = 0;
                    if (str_contains(strtolower($item['name']), $query)) {
                        $score = 10;
                    } elseif (str_contains(strtolower($item['summary'] ?? ''), $query)) {
                        $score = 3;
                    }

                    if ($score > 0) {
                        $seen[$item['fqcn']] = true;
                        $results[] = [
                            'type' => $type,
                            'fqcn' => $item['fqcn'],
                            'name' => $item['name'],
                            'summary' => $item['summary'] ?? '',
                            'score' => $score,
                        ];
                    }
                }
            }
        }

        // 按分数排序
        usort($results, fn ($a, $b) => $b['score'] <=> $a['score']);

        return array_slice($results, 0, 20);
    }

    /**
     * 查找类信息
     */
    private function findClassInfo(string $fqcn): ?array
    {
        foreach ($this->manifest['modules'] ?? [] as $module) {
            foreach (['classes', 'interfaces', 'traits', 'enums', 'attributes'] as $type) {
                foreach ($module[$type] ?? [] as $item) {
                    if ($item['fqcn'] === $fqcn) {
                        return $item;
                    }
                }
            }
        }

        return null;
    }

    /**
     * 列出模块的指南
     */
    public function listModuleGuides(string $moduleName): array
    {
        $module = $this->manifest['modules'][$moduleName] ?? null;
        if (null === $module) {
            return [];
        }

        return $module['guides'] ?? [];
    }

    /**
     * 获取完整的 manifest
     */
    public function getManifest(): array
    {
        return $this->manifest;
    }
}
