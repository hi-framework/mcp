<?php

declare(strict_types=1);

namespace Hi\MCP\Server\Transport;

/**
 * stdio 传输层
 *
 * 通过标准输入输出进行 MCP 通信
 */
final class StdioTransport implements TransportInterface
{
    /**
     * @var resource
     */
    private $stdin;

    /**
     * @var resource
     */
    private $stdout;

    /**
     * @var resource
     */
    private $stderr;

    /**
     * 读取超时时间（微秒）
     */
    private int $readTimeoutUsec = 100000; // 100ms

    public function __construct()
    {
        $this->stdin = \STDIN;
        $this->stdout = \STDOUT;
        $this->stderr = \STDERR;

        // 设置非阻塞模式以支持信号处理
        \stream_set_blocking($this->stdin, false);
    }

    /**
     * 读取一行 JSON 消息
     *
     * 使用 stream_select 实现带超时的读取，允许信号被处理
     */
    #[\Override]
    public function read(): ?string
    {
        // 处理待处理的信号
        if (\function_exists('pcntl_signal_dispatch')) {
            \pcntl_signal_dispatch();
        }

        $read = [$this->stdin];
        $write = null;
        $except = null;

        // 使用 stream_select 等待输入，带超时
        $result = @\stream_select($read, $write, $except, 0, $this->readTimeoutUsec);

        if (false === $result) {
            // stream_select 被信号中断或发生错误
            if (\function_exists('pcntl_signal_dispatch')) {
                \pcntl_signal_dispatch();
            }

            return '';
        }

        if (0 === $result) {
            // 超时，没有数据可读
            return '';
        }

        // 有数据可读
        $line = \fgets($this->stdin);

        if (false === $line) {
            // EOF 或错误
            return null;
        }

        if ('' === $line) {
            return '';
        }

        return \trim($line);
    }

    /**
     * 写入 JSON 消息（自动添加换行符）
     */
    #[\Override]
    public function write(string $message): void
    {
        \fwrite($this->stdout, $message . "\n");
        \fflush($this->stdout);
    }

    /**
     * 写入日志到 stderr
     */
    public function log(string $message): void
    {
        \fwrite($this->stderr, '[MCP] ' . $message . "\n");
        \fflush($this->stderr);
    }

    /**
     * 关闭传输
     */
    #[\Override]
    public function close(): void
    {
        // stdio 通常不需要显式关闭
    }
}
