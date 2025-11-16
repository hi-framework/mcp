<?php

declare(strict_types=1);

namespace Hi\MCP\Analyzer;

use Hi\MCP\Analyzer\Cache\AnalysisCache;

/**
 * 项目结构分析器
 *
 * 扫描并分析整个项目的代码结构
 */
final class ProjectAnalyzer
{
    private array $classes = [];
    private array $interfaces = [];
    private array $traits = [];
    private array $attributes = [];
    private array $modules = [];
    private bool $analyzed = false;

    public function __construct(
        private readonly string $srcPath,
        private readonly ClassAnalyzer $classAnalyzer = new ClassAnalyzer,
        private readonly ?AnalysisCache $cache = null,
    ) {
    }

    /**
     * 执行项目分析
     */
    public function analyze(): void
    {
        if ($this->analyzed) {
            return;
        }

        // 尝试从缓存加载
        if ($this->cache && $this->cache->isValid($this->srcPath)) {
            $cached = $this->cache->load($this->srcPath);
            if ($cached) {
                $this->classes = $cached['classes'];
                $this->interfaces = $cached['interfaces'];
                $this->traits = $cached['traits'];
                $this->attributes = $cached['attributes'];
                $this->modules = $cached['modules'];
                $this->analyzed = true;

                return;
            }
        }

        // 扫描所有 PHP 文件
        $files = $this->scanPhpFiles($this->srcPath);

        foreach ($files as $file) {
            $this->analyzeFile($file);
        }

        // 分析模块结构
        $this->analyzeModules();

        $this->analyzed = true;

        // 保存到缓存
        if ($this->cache) {
            $this->cache->save($this->srcPath, [
                'classes' => $this->classes,
                'interfaces' => $this->interfaces,
                'traits' => $this->traits,
                'attributes' => $this->attributes,
                'modules' => $this->modules,
            ]);
        }
    }

    /**
     * 扫描 PHP 文件
     *
     * @return \Generator<string>
     */
    private function scanPhpFiles(string $directory): \Generator
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && 'php' === $file->getExtension()) {
                yield $file->getPathname();
            }
        }
    }

    /**
     * 分析单个文件
     */
    private function analyzeFile(string $filePath): void
    {
        $className = $this->extractClassName($filePath);
        if (null === $className) {
            return;
        }

        // 确保文件已加载
        if (! \class_exists($className, false) && ! \interface_exists($className, false) && ! \trait_exists($className, false)) {
            try {
                require_once $filePath;
            } catch (\Throwable) {
                return; // 跳过无法加载的文件
            }
        }

        if (! \class_exists($className) && ! \interface_exists($className) && ! \trait_exists($className)) {
            return;
        }

        try {
            $analysis = $this->classAnalyzer->analyze($className);

            match ($analysis['type']) {
                'interface' => $this->interfaces[$className] = $analysis,
                'trait' => $this->traits[$className] = $analysis,
                default => $this->classes[$className] = $analysis,
            };

            // 检查是否是 Attribute
            if ($this->isAttribute($className)) {
                $this->attributes[$className] = $analysis;
            }
        } catch (\Throwable) {
            // 跳过分析失败的类
        }
    }

    /**
     * 从文件路径提取类名
     */
    private function extractClassName(string $filePath): ?string
    {
        $content = \file_get_contents($filePath);
        if (false === $content) {
            return null;
        }

        // 提取命名空间
        $namespace = '';
        if (\preg_match('/namespace\s+([^;]+);/', $content, $matches)) {
            $namespace = \trim($matches[1]);
        }

        // 提取类名
        if (\preg_match('/(?:class|interface|trait|enum)\s+(\w+)/', $content, $matches)) {
            $className = $matches[1];

            return '' !== $namespace ? $namespace . '\\' . $className : $className;
        }

        return null;
    }

    /**
     * 检查类是否为 Attribute
     */
    private function isAttribute(string $className): bool
    {
        if (! \class_exists($className)) {
            return false;
        }

        $reflection = new \ReflectionClass($className);
        $attributes = $reflection->getAttributes(\Attribute::class);

        return ! empty($attributes);
    }

    /**
     * 分析模块结构
     */
    private function analyzeModules(): void
    {
        $allClasses = \array_merge($this->classes, $this->interfaces, $this->traits);

        foreach ($allClasses as $className => $info) {
            $namespace = $info['namespace'];
            if (\str_starts_with($namespace, 'Hi\\')) {
                $parts = \explode('\\', $namespace);
                if (\count($parts) >= 2) {
                    $moduleName = $parts[1];
                    if (! isset($this->modules[$moduleName])) {
                        $this->modules[$moduleName] = [
                            'name' => $moduleName,
                            'classes' => [],
                            'interfaces' => [],
                            'traits' => [],
                        ];
                    }

                    match ($info['type']) {
                        'interface' => $this->modules[$moduleName]['interfaces'][] = $className,
                        'trait' => $this->modules[$moduleName]['traits'][] = $className,
                        default => $this->modules[$moduleName]['classes'][] = $className,
                    };
                }
            }
        }
    }

    /**
     * 获取所有类
     */
    public function getClasses(): array
    {
        $this->analyze();

        return $this->classes;
    }

    /**
     * 获取所有接口
     */
    public function getInterfaces(): array
    {
        $this->analyze();

        return $this->interfaces;
    }

    /**
     * 获取所有 Traits
     */
    public function getTraits(): array
    {
        $this->analyze();

        return $this->traits;
    }

    /**
     * 获取所有 Attributes
     */
    public function getAttributes(): array
    {
        $this->analyze();

        return $this->attributes;
    }

    /**
     * 获取所有模块
     */
    public function getModules(): array
    {
        $this->analyze();

        return $this->modules;
    }

    /**
     * 获取指定类的信息
     */
    public function getClassInfo(string $className): ?array
    {
        $this->analyze();

        return $this->classes[$className] ?? $this->interfaces[$className] ?? $this->traits[$className] ?? null;
    }

    /**
     * 搜索 API
     */
    public function searchApi(string $query): array
    {
        $this->analyze();
        $results = [];
        $query = \mb_strtolower($query);

        $allItems = \array_merge($this->classes, $this->interfaces, $this->traits);

        foreach ($allItems as $className => $info) {
            $score = 0;

            // 搜索类名
            if (\str_contains(\mb_strtolower($info['name']), $query)) {
                $score += 10;
            }

            // 搜索描述
            if (\str_contains(\mb_strtolower($info['description']), $query)) {
                $score += 5;
            }

            // 搜索方法名
            foreach ($info['methods'] as $method) {
                if (\str_contains(\mb_strtolower($method['name']), $query)) {
                    $score += 3;
                }
                if (\str_contains(\mb_strtolower($method['description']), $query)) {
                    $score += 2;
                }
            }

            if ($score > 0) {
                $results[] = [
                    'class' => $className,
                    'type' => $info['type'],
                    'description' => $info['description'],
                    'score' => $score,
                ];
            }
        }

        // 按分数排序
        \usort($results, static fn ($a, $b) => $b['score'] <=> $a['score']);

        return \array_slice($results, 0, 20); // 返回前 20 个结果
    }

    /**
     * 获取项目结构概览
     */
    public function getStructure(): array
    {
        $this->analyze();

        return [
            'totalClasses' => \count($this->classes),
            'totalInterfaces' => \count($this->interfaces),
            'totalTraits' => \count($this->traits),
            'totalAttributes' => \count($this->attributes),
            'modules' => \array_map(static fn ($m) => [
                'name' => $m['name'],
                'classCount' => \count($m['classes']),
                'interfaceCount' => \count($m['interfaces']),
                'traitCount' => \count($m['traits']),
            ], $this->modules),
        ];
    }

    /**
     * 按命名空间过滤类
     */
    public function filterByNamespace(string $namespace): array
    {
        $this->analyze();
        $result = [];

        $allItems = \array_merge($this->classes, $this->interfaces, $this->traits);

        foreach ($allItems as $className => $info) {
            if (\str_starts_with($info['namespace'], $namespace)) {
                $result[$className] = $info;
            }
        }

        return $result;
    }
}
