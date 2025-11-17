<?php

declare(strict_types=1);

namespace Hi\MCP\Generator;

use Hi\MCP\Generator\Config\GeneratorConfig;
use Hi\MCP\Generator\Linker\GuideLinker;
use Hi\MCP\Generator\Linker\ManifestBuilder;
use Hi\MCP\Generator\Parser\ClassInfoExtractor;
use Hi\MCP\Generator\Parser\PhpFileParser;
use Hi\MCP\Generator\Renderer\ClassMarkdownRenderer;
use Hi\MCP\Generator\Renderer\ModuleMarkdownRenderer;

/**
 * 文档生成器主协调器
 *
 * 协调扫描、解析、渲染、索引构建的完整流程
 */
final class DocumentationGenerator
{
    private PhpFileParser $parser;
    private ClassInfoExtractor $extractor;
    private ClassMarkdownRenderer $classRenderer;
    private ModuleMarkdownRenderer $moduleRenderer;
    private GuideLinker $guideLinker;
    private ManifestBuilder $manifestBuilder;

    private int $processedFiles = 0;
    private int $processedClasses = 0;
    private array $errors = [];

    public function __construct(
        private readonly GeneratorConfig $config,
    ) {
        $this->parser = new PhpFileParser;
        $this->extractor = new ClassInfoExtractor;
        $this->classRenderer = new ClassMarkdownRenderer;
        $this->moduleRenderer = new ModuleMarkdownRenderer;
        $this->guideLinker = new GuideLinker;
        $this->manifestBuilder = new ManifestBuilder($config, $this->guideLinker);
    }

    /**
     * 执行文档生成
     */
    public function generate(): array
    {
        $startTime = microtime(true);

        // 1. 准备输出目录
        $this->prepareOutputDirectories();

        // 2. 扫描现有文档
        $this->log('扫描现有文档...');
        $this->guideLinker->scan($this->config->docsPath);
        $guideCount = count($this->guideLinker->getAllGuides());
        $this->log("找到 {$guideCount} 个指南文档");

        // 3. 复制指南文档
        $this->log('复制指南文档...');
        $this->copyGuides();

        // 4. 扫描源代码
        $this->log('扫描源代码...');
        $phpFiles = $this->scanSourceFiles();
        $this->log('找到 ' . count($phpFiles) . ' 个 PHP 文件');

        // 5. 解析并生成文档
        $this->log('解析并生成 API 文档...');
        foreach ($phpFiles as $file) {
            $this->processFile($file);
        }

        // 6. 生成模块文档
        $this->log('生成模块文档...');
        $this->generateModuleDocuments();

        // 7. 生成 manifest
        $this->log('生成索引文件...');
        $manifest = $this->manifestBuilder->build();
        $this->writeManifest($manifest);

        $endTime = microtime(true);
        $duration = round($endTime - $startTime, 2);

        $result = [
            'success' => true,
            'duration' => $duration,
            'statistics' => $manifest['statistics'],
            'errors' => $this->errors,
            'output_path' => $this->config->outputPath,
        ];

        $this->log("完成！耗时 {$duration} 秒");
        $this->log('统计: ' . json_encode($manifest['statistics'], JSON_UNESCAPED_UNICODE));

        return $result;
    }

    /**
     * 准备输出目录
     */
    private function prepareOutputDirectories(): void
    {
        $dirs = [
            $this->config->outputPath,
            $this->config->getApiPath(),
            $this->config->getApiPath() . '/classes',
            $this->config->getApiPath() . '/interfaces',
            $this->config->getApiPath() . '/traits',
            $this->config->getApiPath() . '/enums',
            $this->config->getApiPath() . '/attributes',
            $this->config->getModulesPath(),
            $this->config->getGuidesPath(),
        ];

        foreach ($dirs as $dir) {
            if (! is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }

    /**
     * 复制指南文档
     */
    private function copyGuides(): void
    {
        if (! is_dir($this->config->docsPath)) {
            return;
        }

        $this->copyDirectory($this->config->docsPath, $this->config->getGuidesPath());
    }

    /**
     * 递归复制目录
     */
    private function copyDirectory(string $source, string $dest): void
    {
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($iterator as $item) {
            $relativePath = $iterator->getSubPathname();

            // 跳过特殊目录
            if (str_starts_with($relativePath, 'node_modules')
                || str_starts_with($relativePath, '.vitepress')
                || str_starts_with($relativePath, '.git')
                || str_starts_with($relativePath, 'public')) {
                continue;
            }

            $destPath = $dest . '/' . $relativePath;

            if ($item->isDir()) {
                if (! is_dir($destPath)) {
                    mkdir($destPath, 0755, true);
                }
            } elseif ($item->isFile() && 'md' === $item->getExtension()) {
                copy($item->getPathname(), $destPath);
            }
        }
    }

    /**
     * 扫描源代码文件
     */
    private function scanSourceFiles(): array
    {
        $files = [];

        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->config->sourcePath, \RecursiveDirectoryIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && 'php' === $file->getExtension()) {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }

    /**
     * 处理单个文件
     */
    private function processFile(string $filePath): void
    {
        try {
            $classes = $this->parser->parseFile($filePath);

            foreach ($classes as $classInfo) {
                $this->processClass($classInfo);
            }

            ++$this->processedFiles;
        } catch (\Throwable $e) {
            $this->errors[] = [
                'file' => $filePath,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * 处理单个类
     */
    private function processClass(array $classInfo): void
    {
        try {
            // 增强类信息
            $enhanced = $this->extractor->enhance($classInfo);

            // 生成 Markdown
            $markdown = $this->classRenderer->render($enhanced);

            // 确定输出目录
            $outputDir = $this->getClassOutputDir($enhanced);

            // 写入文件
            $filename = str_replace('\\', '.', $enhanced['fqcn']) . '.md';
            $outputPath = $outputDir . '/' . $filename;
            file_put_contents($outputPath, $markdown);

            // 添加到 manifest
            $this->manifestBuilder->addClass($enhanced);

            ++$this->processedClasses;
        } catch (\Throwable $e) {
            $this->errors[] = [
                'class' => $classInfo['fqcn'] ?? 'unknown',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * 获取类的输出目录
     */
    private function getClassOutputDir(array $classInfo): string
    {
        // Attribute 优先放到 attributes 目录
        if ($classInfo['isAttribute'] ?? false) {
            return $this->config->getApiPath() . '/attributes';
        }

        return match ($classInfo['type']) {
            'interface' => $this->config->getApiPath() . '/interfaces',
            'trait' => $this->config->getApiPath() . '/traits',
            'enum' => $this->config->getApiPath() . '/enums',
            default => $this->config->getApiPath() . '/classes',
        };
    }

    /**
     * 生成模块文档
     */
    private function generateModuleDocuments(): void
    {
        $modules = $this->manifestBuilder->getModules();

        foreach ($modules as $moduleName => $moduleInfo) {
            // 添加指南信息
            $guides = $this->guideLinker->getGuidesForModule($moduleName);
            $moduleInfo['guides'] = array_map(fn ($g) => [
                'title' => $g['title'],
                'path' => '../guides/' . $g['path'],
            ], $guides);

            // 添加概念文档
            $concepts = $this->guideLinker->getConceptGuides();
            $moduleInfo['concepts'] = array_map(fn ($c) => [
                'title' => $c['title'],
                'path' => '../guides/' . $c['path'],
            ], $concepts);

            // 渲染模块文档
            $markdown = $this->moduleRenderer->render($moduleInfo);

            // 写入文件
            $outputPath = $this->config->getModulesPath() . '/' . $moduleName . '.md';
            file_put_contents($outputPath, $markdown);
        }
    }

    /**
     * 写入 manifest 文件
     */
    private function writeManifest(array $manifest): void
    {
        $json = json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        file_put_contents($this->config->getManifestPath(), $json);
    }

    /**
     * 日志输出
     */
    private function log(string $message): void
    {
        echo '[' . date('H:i:s') . '] ' . $message . "\n";
    }
}
