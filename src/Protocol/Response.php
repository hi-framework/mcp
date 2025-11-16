<?php

declare(strict_types=1);

namespace Hi\MCP\Protocol;

/**
 * JSON-RPC 2.0 响应对象
 */
final class Response
{
    private function __construct(
        public readonly string|int $id,
        public readonly ?array $result = null,
        public readonly ?array $error = null,
    ) {
    }

    /**
     * 创建成功响应
     */
    public static function success(string|int $id, array $result): self
    {
        return new self(id: $id, result: $result);
    }

    /**
     * 创建错误响应
     */
    public static function error(string|int $id, int $code, string $message, mixed $data = null): self
    {
        $error = [
            'code' => $code,
            'message' => $message,
        ];

        if (null !== $data) {
            $error['data'] = $data;
        }

        return new self(id: $id, error: $error);
    }

    /**
     * 使用标准错误码创建错误响应
     */
    public static function errorFromCode(string|int $id, int $code, ?string $message = null, mixed $data = null): self
    {
        return self::error(
            id: $id,
            code: $code,
            message: $message ?? ErrorCode::getMessage($code),
            data: $data,
        );
    }

    /**
     * 转换为 JSON 字符串
     */
    public function toJson(): string
    {
        $response = [
            'jsonrpc' => '2.0',
            'id' => $this->id,
        ];

        if (null !== $this->error) {
            $response['error'] = $this->error;
        } else {
            $response['result'] = $this->result ?? new \stdClass;
        }

        $json = \json_encode($response, \JSON_UNESCAPED_UNICODE | \JSON_UNESCAPED_SLASHES);

        return false === $json ? '{}' : $json;
    }

    /**
     * 转换为数组
     */
    public function toArray(): array
    {
        $response = [
            'jsonrpc' => '2.0',
            'id' => $this->id,
        ];

        if (null !== $this->error) {
            $response['error'] = $this->error;
        } else {
            $response['result'] = $this->result ?? new \stdClass;
        }

        return $response;
    }
}
