<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Config;

/**
 * 文档生成器配置
 */
final class GeneratorConfig
{
    public function __construct(
        public readonly string $sourcePath,
        public readonly string $docsPath,
        public readonly string $outputPath,
        public readonly string $frameworkName = 'Hi Framework',
        public readonly string $frameworkVersion = '2.0.0',
        public readonly string $rootNamespace = 'Hi',
    ) {
    }

    /**
     * 获取 API 文档输出路径
     */
    public function getApiPath(): string
    {
        return $this->outputPath . '/api';
    }

    /**
     * 获取模块文档输出路径
     */
    public function getModulesPath(): string
    {
        return $this->outputPath . '/modules';
    }

    /**
     * 获取指南文档输出路径
     */
    public function getGuidesPath(): string
    {
        return $this->outputPath . '/guides';
    }

    /**
     * 获取 manifest 文件路径
     */
    public function getManifestPath(): string
    {
        return $this->outputPath . '/manifest.json';
    }
}
