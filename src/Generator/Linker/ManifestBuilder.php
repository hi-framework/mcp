<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Linker;

use Hi\MCP\Generator\Config\GeneratorConfig;

/**
 * Manifest 构建器
 *
 * 构建主索引文件，包含所有类、模块、指南的索引信息
 */
final class ManifestBuilder
{
    private array $classes = [];
    private array $interfaces = [];
    private array $traits = [];
    private array $enums = [];
    private array $attributes = [];
    private array $modules = [];
    private array $searchIndex = [];

    public function __construct(
        private readonly GeneratorConfig $config,
        private readonly GuideLinker $guideLinker,
    ) {
    }

    /**
     * 添加类信息
     */
    public function addClass(array $classInfo): void
    {
        $fqcn = $classInfo['fqcn'];
        $module = $this->extractModule($classInfo['namespace']);

        $entry = [
            'fqcn' => $fqcn,
            'name' => $classInfo['name'],
            'summary' => $classInfo['summary'] ?? '',
            'module' => $module,
            'file' => $this->getDocPath('classes', $fqcn),
        ];

        match ($classInfo['type']) {
            'interface' => $this->interfaces[$fqcn] = $entry,
            'trait' => $this->traits[$fqcn] = $entry,
            'enum' => $this->enums[$fqcn] = $entry,
            default => $this->classes[$fqcn] = $entry,
        };

        // 检查是否是 Attribute
        if ($classInfo['isAttribute'] ?? false) {
            $entry['file'] = $this->getDocPath('attributes', $fqcn);
            $this->attributes[$fqcn] = $entry;
        }

        // 添加到模块
        $this->addToModule($module, $fqcn, $classInfo);

        // 构建搜索索引
        $this->buildSearchIndex($classInfo);
    }

    /**
     * 添加到模块
     */
    private function addToModule(string $moduleName, string $fqcn, array $classInfo): void
    {
        if (! isset($this->modules[$moduleName])) {
            $this->modules[$moduleName] = [
                'name' => $moduleName,
                'description' => $this->getModuleDescription($moduleName),
                'namespaces' => [],
                'classes' => [],
                'interfaces' => [],
                'traits' => [],
                'enums' => [],
                'attributes' => [],
                'guides' => [],
                'concepts' => [],
            ];
        }

        $module = &$this->modules[$moduleName];

        // 添加命名空间
        $namespace = $classInfo['namespace'];
        if (! in_array($namespace, $module['namespaces'], true)) {
            $module['namespaces'][] = $namespace;
        }

        // 添加类
        $entry = [
            'fqcn' => $fqcn,
            'name' => $classInfo['name'],
            'summary' => $classInfo['summary'] ?? '',
        ];

        match ($classInfo['type']) {
            'interface' => $module['interfaces'][] = $entry,
            'trait' => $module['traits'][] = $entry,
            'enum' => $module['enums'][] = $entry,
            default => $module['classes'][] = $entry,
        };

        if ($classInfo['isAttribute'] ?? false) {
            $module['attributes'][] = $entry;
        }
    }

    /**
     * 完成构建，关联指南
     */
    public function finalize(): void
    {
        // 关联指南到模块
        foreach ($this->modules as $moduleName => &$module) {
            $guides = $this->guideLinker->getGuidesForModule($moduleName);
            foreach ($guides as $guide) {
                $module['guides'][] = [
                    'title' => $guide['title'],
                    'path' => 'guides/' . $guide['path'],
                ];
            }

            // 添加概念文档
            $concepts = $this->guideLinker->getConceptGuides();
            foreach ($concepts as $concept) {
                $module['concepts'][] = [
                    'title' => $concept['title'],
                    'path' => 'guides/' . $concept['path'],
                ];
            }

            // 排序命名空间
            sort($module['namespaces']);
        }
    }

    /**
     * 构建 manifest 数据
     */
    public function build(): array
    {
        $this->finalize();

        return [
            'version' => '2.0.0',
            'framework' => $this->config->frameworkName,
            'framework_version' => $this->config->frameworkVersion,
            'generated_at' => (new \DateTimeImmutable)->format('c'),
            'source_path' => $this->config->sourcePath,
            'docs_path' => $this->config->docsPath,

            'statistics' => [
                'modules' => count($this->modules),
                'classes' => count($this->classes),
                'interfaces' => count($this->interfaces),
                'traits' => count($this->traits),
                'enums' => count($this->enums),
                'attributes' => count($this->attributes),
                'guide_pages' => count($this->guideLinker->getAllGuides()),
            ],

            'modules' => $this->modules,

            'search_index' => [
                'keywords' => $this->searchIndex,
                'fqcn_map' => $this->buildFqcnMap(),
            ],
        ];
    }

    /**
     * 构建搜索索引
     */
    private function buildSearchIndex(array $classInfo): void
    {
        $fqcn = $classInfo['fqcn'];

        // 类名关键词
        $className = strtolower($classInfo['name']);
        $this->addToSearchIndex($className, $fqcn);

        // 分词类名（驼峰分割）
        $words = $this->splitCamelCase($classInfo['name']);
        foreach ($words as $word) {
            if (strlen($word) > 2) {
                $this->addToSearchIndex(strtolower($word), $fqcn);
            }
        }

        // 从描述提取关键词
        $description = $classInfo['summary'] . ' ' . ($classInfo['description'] ?? '');
        $keywords = $this->extractKeywordsFromText($description);
        foreach ($keywords as $keyword) {
            $this->addToSearchIndex($keyword, $fqcn);
        }

        // 方法名
        foreach ($classInfo['methods'] ?? [] as $method) {
            if ('public' === $method['visibility']) {
                $methodWords = $this->splitCamelCase($method['name']);
                foreach ($methodWords as $word) {
                    if (strlen($word) > 2) {
                        $this->addToSearchIndex(strtolower($word), $fqcn);
                    }
                }
            }
        }
    }

    /**
     * 添加到搜索索引
     */
    private function addToSearchIndex(string $keyword, string $fqcn): void
    {
        if (! isset($this->searchIndex[$keyword])) {
            $this->searchIndex[$keyword] = [
                'classes' => [],
                'guides' => [],
            ];
        }

        if (! in_array($fqcn, $this->searchIndex[$keyword]['classes'], true)) {
            $this->searchIndex[$keyword]['classes'][] = $fqcn;
        }

        // 关联指南
        $guides = $this->guideLinker->searchGuides($keyword);
        foreach (array_slice($guides, 0, 3) as $guide) {
            $guidePath = 'guides/' . $guide['path'];
            if (! in_array($guidePath, $this->searchIndex[$keyword]['guides'], true)) {
                $this->searchIndex[$keyword]['guides'][] = $guidePath;
            }
        }
    }

    /**
     * 构建 FQCN 映射
     */
    private function buildFqcnMap(): array
    {
        $map = [];

        foreach ($this->classes as $fqcn => $info) {
            $map[$fqcn] = $info['file'];
        }

        foreach ($this->interfaces as $fqcn => $info) {
            $map[$fqcn] = $this->getDocPath('interfaces', $fqcn);
        }

        foreach ($this->traits as $fqcn => $info) {
            $map[$fqcn] = $this->getDocPath('traits', $fqcn);
        }

        foreach ($this->enums as $fqcn => $info) {
            $map[$fqcn] = $this->getDocPath('enums', $fqcn);
        }

        foreach ($this->attributes as $fqcn => $info) {
            $map[$fqcn] = $this->getDocPath('attributes', $fqcn);
        }

        return $map;
    }

    /**
     * 获取文档路径
     */
    private function getDocPath(string $type, string $fqcn): string
    {
        $filename = str_replace('\\', '.', $fqcn) . '.md';

        return "api/{$type}/{$filename}";
    }

    /**
     * 提取模块名
     */
    private function extractModule(string $namespace): string
    {
        $parts = explode('\\', $namespace);
        if (count($parts) >= 2 && $this->config->rootNamespace === $parts[0]) {
            return $parts[1];
        }

        return $parts[0] ?? 'Unknown';
    }

    /**
     * 获取模块描述
     */
    private function getModuleDescription(string $moduleName): string
    {
        $descriptions = [
            'Http' => 'HTTP 请求/响应处理、路由系统、中间件管理',
            'Database' => '数据库连接、查询构建、事务管理',
            'Cache' => '多后端缓存系统',
            'Redis' => 'Redis 客户端和连接池',
            'Kafka' => 'Kafka 消息队列集成',
            'Elasticsearch' => 'Elasticsearch 搜索引擎客户端',
            'Kernel' => '框架内核、容器、服务管理',
            'Runtime' => '运行时环境抽象',
            'Server' => 'HTTP 服务器实现',
            'Attributes' => 'PHP 8+ Attributes 集合',
            'Exception' => '异常处理和错误报告',
            'Event' => '事件系统',
            'ConnectionPool' => '通用连接池管理',
            'Metric' => '监控指标收集',
            'Telemetry' => '遥测数据收集',
            'Testing' => '测试工具和辅助类',
            'Sidecar' => '边车服务支持',
            'MCP' => 'Model Context Protocol 实现',
        ];

        return $descriptions[$moduleName] ?? '';
    }

    /**
     * 驼峰分割
     */
    private function splitCamelCase(string $text): array
    {
        $result = preg_split('/(?=[A-Z])/', $text, -1, PREG_SPLIT_NO_EMPTY);

        return false !== $result ? $result : [$text];
    }

    /**
     * 从文本提取关键词
     */
    private function extractKeywordsFromText(string $text): array
    {
        // 移除特殊字符，分词
        $text = preg_replace('/[^\w\s]/', ' ', strtolower($text));
        $words = preg_split('/\s+/', $text ?? '');

        if (false === $words) {
            return [];
        }

        // 过滤停用词
        $stopWords = ['the', 'a', 'an', 'is', 'are', 'was', 'were', 'be', 'been', 'being', 'have', 'has', 'had', 'do', 'does', 'did', 'will', 'would', 'could', 'should', 'may', 'might', 'must', 'shall', 'can', 'need', 'dare', 'ought', 'used', 'to', 'of', 'in', 'for', 'on', 'with', 'at', 'by', 'from', 'as', 'into', 'through', 'during', 'before', 'after', 'above', 'below', 'between', 'under', 'and', 'or', 'but', 'if', 'then', 'else', 'when', 'up', 'down', 'out', 'off', 'over', 'under', 'again', 'further', 'once'];

        $keywords = [];
        foreach ($words as $word) {
            $word = trim($word);
            if (strlen($word) > 2 && ! in_array($word, $stopWords, true)) {
                $keywords[] = $word;
            }
        }

        return array_unique($keywords);
    }

    /**
     * 获取模块信息
     */
    public function getModules(): array
    {
        return $this->modules;
    }
}
