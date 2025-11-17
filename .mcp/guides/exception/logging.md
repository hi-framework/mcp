# 日志记录

## 概述

日志记录是异常处理系统中不可或缺的组成部分，它提供了异常信息的持久化存储和查询能力。Typing PHP Framework 支持多种日志记录策略，帮助开发者追踪、分析和解决应用程序中的问题。

## 日志记录策略

### 1. 结构化日志

结构化日志使用统一的格式记录异常信息，便于后续分析和处理：

```php
class StructuredLogReporter implements ExceptionReporterInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        $logData = [
            'timestamp' => date('c'),
            'level' => 'ERROR',
            'exception' => [
                'class' => $th::class,
                'message' => $th->getMessage(),
                'code' => $th->getCode(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $this->formatStackTrace($th->getTrace()),
            ],
            'context' => $this->extractContext($context),
            'environment' => $this->getEnvironmentInfo(),
        ];

        $this->logger->error('Exception occurred', $logData);
    }
}
```

### 2. 分级日志

根据异常的严重程度，使用不同的日志级别：

```php
class LeveledLogReporter implements ExceptionReporterInterface
{
    public function report(\Throwable $th, mixed $context = null): void
    {
        $level = $this->determineLogLevel($th);
        $message = $this->formatLogMessage($th);
        $context = $this->prepareLogContext($th, $context);

        $this->logger->log($level, $message, $context);
    }

    private function determineLogLevel(\Throwable $th): string
    {
        if ($th instanceof FatalErrorException) {
            return 'CRITICAL';
        }

        if ($th instanceof DatabaseConnectionException) {
            return 'ERROR';
        }

        if ($th instanceof ValidationException) {
            return 'WARNING';
        }

        return 'ERROR';
    }
}
```

## 日志存储

### 文件日志

将异常日志保存到文件系统：

```php
class FileLogReporter implements ExceptionReporterInterface
{
    public function __construct(
        private string $logPath,
        private string $logLevel = 'ERROR'
    ) {
        $this->ensureLogDirectory();
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        $logEntry = $this->formatLogEntry($th, $context);
        $filename = $this->getLogFilename();

        file_put_contents($filename, $logEntry . PHP_EOL, FILE_APPEND | LOCK_EX);
    }

    private function formatLogEntry(\Throwable $th, mixed $context): string
    {
        $entry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'level' => 'ERROR',
            'exception' => $th::class,
            'message' => $th->getMessage(),
            'file' => $th->getFile() . ':' . $th->getLine(),
            'trace' => $th->getTraceAsString(),
        ];

        if ($context) {
            $entry['context'] = json_encode($context);
        }

        return json_encode($entry, JSON_UNESCAPED_UNICODE);
    }
}
```

### 数据库日志

将异常日志存储到数据库，便于查询和分析：

```php
class DatabaseLogReporter implements ExceptionReporterInterface
{
    public function __construct(private DatabaseManager $db)
    {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        try {
            $this->db->table('exception_logs')->insert([
                'exception_class' => $th::class,
                'message' => $th->getMessage(),
                'code' => $th->getCode(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'stack_trace' => $th->getTraceAsString(),
                'context' => json_encode($context),
                'created_at' => date('Y-m-d H:i:s'),
                'severity' => $this->calculateSeverity($th),
            ]);
        } catch (\Throwable $e) {
            error_log("Failed to log exception to database: " . $e->getMessage());
        }
    }
}
```

## 日志轮转

### 自动轮转

实现日志文件的自动轮转，避免单个文件过大：

```php
class RotatingFileLogReporter implements ExceptionReporterInterface
{
    public function __construct(
        private string $logPath,
        private int $maxFileSize = 10 * 1024 * 1024, // 10MB
        private int $maxFiles = 5
    ) {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        $filename = $this->getCurrentLogFile();
        
        if (file_exists($filename) && filesize($filename) > $this->maxFileSize) {
            $this->rotateLogFiles();
        }

        $logEntry = $this->formatLogEntry($th, $context);
        file_put_contents($filename, $logEntry . PHP_EOL, FILE_APPEND | LOCK_EX);
    }
}
```

### 批量日志记录

批量处理日志记录，减少 I/O 操作：

```php
class BatchLogReporter implements ExceptionReporterInterface
{
    private array $pendingLogs = [];
    private int $batchSize = 100;
    private float $flushInterval = 5.0;

    public function report(\Throwable $th, mixed $context = null): void
    {
        $this->pendingLogs[] = [
            'exception' => $th,
            'context' => $context,
            'timestamp' => microtime(true),
        ];

        if (count($this->pendingLogs) >= $this->batchSize ||
            (microtime(true) - $this->lastFlush) >= $this->flushInterval) {
            $this->flushLogs();
        }
    }
}
```

## 监控和告警

### 异常频率监控

监控异常发生的频率，超过阈值时发送告警：

```php
class ExceptionFrequencyMonitor
{
    private array $exceptionCounts = [];
    private array $thresholds = [];

    public function addThreshold(string $exceptionClass, int $threshold, callable $alertHandler): void
    {
        $this->thresholds[$exceptionClass] = $threshold;
        $this->alertHandlers[$exceptionClass] = $alertHandler;
    }

    public function recordException(\Throwable $th): void
    {
        $class = $th::class;
        
        if (!isset($this->exceptionCounts[$class])) {
            $this->exceptionCounts[$class] = 0;
        }

        $this->exceptionCounts[$class]++;

        if (isset($this->thresholds[$class]) && 
            $this->exceptionCounts[$class] >= $this->thresholds[$class]) {
            $this->triggerAlert($class, $th);
        }
    }
}
```

## 最佳实践

### 1. 日志内容

- 记录足够的上下文信息，便于问题定位
- 避免记录敏感信息（密码、令牌等）
- 使用结构化的日志格式，便于解析

### 2. 日志级别

- 合理使用日志级别，避免信息过载
- 生产环境中减少 DEBUG 级别日志
- 重要异常使用 ERROR 或 CRITICAL 级别

### 3. 性能考虑

- 异步记录日志，避免阻塞主程序
- 实现日志轮转，控制文件大小
- 定期清理过期日志，释放存储空间

## 总结

Typing PHP Framework 的日志记录系统提供了：

- 多种日志存储策略（文件、数据库、远程服务）
- 灵活的日志轮转机制
- 高效的批量处理和异步记录
- 完善的查询和分析功能
- 智能的监控和告警系统

通过合理配置日志记录策略，可以构建可靠的异常追踪和分析系统。
