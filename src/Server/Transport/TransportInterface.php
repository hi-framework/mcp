<?php

declare(strict_types=1);

namespace Hi\MCP\Server\Transport;

/**
 * MCP 传输层接口
 */
interface TransportInterface
{
    /**
     * 读取消息
     *
     * @return string|null 返回 JSON 消息，EOF 时返回 null
     */
    public function read(): ?string;

    /**
     * 写入消息
     */
    public function write(string $message): void;

    /**
     * 关闭传输
     */
    public function close(): void;
}
