<?php

declare(strict_types=1);

namespace Hi\MCP\Protocol;

/**
 * JSON-RPC 2.0 标准错误码
 *
 * @see https://www.jsonrpc.org/specification#error_object
 */
final class ErrorCode
{
    // JSON-RPC 2.0 标准错误码
    public const PARSE_ERROR = -32700;
    public const INVALID_REQUEST = -32600;
    public const METHOD_NOT_FOUND = -32601;
    public const INVALID_PARAMS = -32602;
    public const INTERNAL_ERROR = -32603;

    // MCP 协议特定错误码 (-32000 to -32099 reserved for implementation-defined server-errors)
    public const RESOURCE_NOT_FOUND = -32002;
    public const TOOL_NOT_FOUND = -32003;
    public const PROMPT_NOT_FOUND = -32004;

    /**
     * 获取错误码对应的默认消息
     */
    public static function getMessage(int $code): string
    {
        return match ($code) {
            self::PARSE_ERROR => 'Parse error',
            self::INVALID_REQUEST => 'Invalid Request',
            self::METHOD_NOT_FOUND => 'Method not found',
            self::INVALID_PARAMS => 'Invalid params',
            self::INTERNAL_ERROR => 'Internal error',
            self::RESOURCE_NOT_FOUND => 'Resource not found',
            self::TOOL_NOT_FOUND => 'Tool not found',
            self::PROMPT_NOT_FOUND => 'Prompt not found',
            default => 'Unknown error',
        };
    }
}
