<?php

declare(strict_types=1);

namespace Hi\MCP\Protocol;

/**
 * JSON-RPC 2.0 请求对象
 */
final class Request
{
    public function __construct(
        public readonly string|int $id,
        public readonly string $method,
        public readonly ?array $params = null,
    ) {
    }

    /**
     * 从 JSON 字符串解析请求
     *
     * @throws \JsonException
     */
    public static function fromJson(string $json): self
    {
        $data = \json_decode($json, true, 512, \JSON_THROW_ON_ERROR);

        if (! isset($data['jsonrpc']) || '2.0' !== $data['jsonrpc']) {
            throw new \InvalidArgumentException('Invalid JSON-RPC version');
        }

        if (! isset($data['id'])) {
            throw new \InvalidArgumentException('Missing request id');
        }

        if (! isset($data['method']) || ! \is_string($data['method'])) {
            throw new \InvalidArgumentException('Missing or invalid method');
        }

        return new self(
            id: $data['id'],
            method: $data['method'],
            params: $data['params'] ?? null,
        );
    }

    /**
     * 检查是否为通知（无 id）
     */
    public static function isNotification(array $data): bool
    {
        return ! isset($data['id']);
    }

    /**
     * 获取参数值
     */
    public function getParam(string $key, mixed $default = null): mixed
    {
        return $this->params[$key] ?? $default;
    }
}
