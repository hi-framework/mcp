<?php

declare(strict_types=1);

namespace Hi\MCP\Analyzer\Cache;

/**
 * 分析结果缓存
 */
final class AnalysisCache
{
    private string $cacheFile;

    public function __construct(
        private readonly string $cacheDir,
        private readonly int $ttl = 3600, // 默认缓存 1 小时
    ) {
        if (! \is_dir($cacheDir)) {
            \mkdir($cacheDir, 0o755, true);
        }
        $this->cacheFile = $cacheDir . '/mcp_analysis.cache';
    }

    /**
     * 检查缓存是否有效
     */
    public function isValid(string $srcPath): bool
    {
        if (! \file_exists($this->cacheFile)) {
            return false;
        }

        $cacheTime = \filemtime($this->cacheFile);
        $now = \time();

        // 检查 TTL
        if (($now - $cacheTime) > $this->ttl) {
            return false;
        }

        // 检查源码是否有更新
        $latestModification = $this->getLatestModificationTime($srcPath);
        if ($latestModification > $cacheTime) {
            return false;
        }

        return true;
    }

    /**
     * 加载缓存
     */
    public function load(string $srcPath): ?array
    {
        if (! $this->isValid($srcPath)) {
            return null;
        }

        $content = \file_get_contents($this->cacheFile);
        if (false === $content) {
            return null;
        }

        $data = \unserialize($content);
        if (! \is_array($data)) {
            return null;
        }

        return $data;
    }

    /**
     * 保存缓存
     */
    public function save(string $srcPath, array $data): void
    {
        $serialized = \serialize($data);
        \file_put_contents($this->cacheFile, $serialized);
    }

    /**
     * 清除缓存
     */
    public function clear(): void
    {
        if (\file_exists($this->cacheFile)) {
            \unlink($this->cacheFile);
        }
    }

    /**
     * 获取目录中最新的文件修改时间
     */
    private function getLatestModificationTime(string $directory): int
    {
        $latest = 0;
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($directory, \RecursiveDirectoryIterator::SKIP_DOTS),
        );

        foreach ($iterator as $file) {
            if ($file->isFile() && 'php' === $file->getExtension()) {
                $mtime = $file->getMTime();
                if ($mtime > $latest) {
                    $latest = $mtime;
                }
            }
        }

        return $latest;
    }
}
