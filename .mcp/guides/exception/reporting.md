# 错误报告

## 概述

错误报告是异常处理系统的重要组成部分，负责收集、处理和分发异常信息。Typing PHP Framework 提供了灵活的错误报告机制，支持多种报告器和自定义报告策略。

## 报告器接口

### ExceptionReporterInterface

所有报告器都必须实现 `ExceptionReporterInterface` 接口：

```php
interface ExceptionReporterInterface
{
    /**
     * 报告异常
     * 注意：此方法不能抛出异常
     */
    public function report(\Throwable $th, mixed $context = null): void;
}
```

### 报告器契约

- **不抛出异常**：报告器本身不能抛出异常，确保异常处理系统的稳定性
- **异步处理**：报告操作应该是非阻塞的，不影响主程序执行
- **错误容忍**：即使报告失败，也不应影响异常处理流程

## 内置报告器

### ConsoleReporter

`ConsoleReporter` 是框架默认的控制台报告器，专门用于命令行环境：

```php
class ConsoleReporter implements ExceptionReporterInterface
{
    public function __construct(protected OutputInterface $output = new Output)
    {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        $output = $this->output;

        // 显示异常类型
        $output->displayErrorTips('Uncaught ' . $th::class);

        // 显示异常消息
        $output->writeInBold($th->getMessage());
        $output->writeWarning('at ' . $th->getFile() . ':' . $th->getLine());
        $output->newLine();

        // 显示堆栈跟踪
        $output->writeln('Stack Trace:');
        \array_map(
            static fn (string $trace) => $output->writeInGray($trace),
            \explode(\PHP_EOL, $th->getTraceAsString()),
        );
        $output->newLine();

        // 递归显示前一个异常
        if ($e = $th->getPrevious()) {
            $output->newLine(2);
            $output->writeInBlue('Previous Exception:');
            $this->report($e, $context);
        }
    }
}
```

#### 输出格式

控制台报告器提供格式化的错误输出：

- **错误提示**：显示异常类型
- **错误消息**：粗体显示异常消息
- **位置信息**：警告样式显示文件和行号
- **堆栈跟踪**：灰色显示完整的调用堆栈
- **前一个异常**：蓝色显示链式异常信息

## 自定义报告器

### 创建自定义报告器

```php
use Hi\Exception\ExceptionReporterInterface;

class EmailReporter implements ExceptionReporterInterface
{
    public function __construct(
        private string $adminEmail,
        private MailerInterface $mailer
    ) {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        try {
            $this->mailer->send(
                to: $this->adminEmail,
                subject: '应用异常报告: ' . $th->getMessage(),
                body: $this->formatExceptionReport($th, $context)
            );
        } catch (\Throwable $e) {
            // 记录报告失败，但不抛出异常
            error_log('Failed to send exception report: ' . $e->getMessage());
        }
    }

    private function formatExceptionReport(\Throwable $th, mixed $context): string
    {
        $report = [
            'Exception Class: ' . $th::class,
            'Message: ' . $th->getMessage(),
            'File: ' . $th->getFile() . ':' . $th->getLine(),
            'Stack Trace: ' . $th->getTraceAsString(),
            'Context: ' . json_encode($context, JSON_PRETTY_PRINT),
        ];

        return implode("\n\n", $report);
    }
}
```

### 日志报告器

```php
use Hi\Exception\ExceptionReporterInterface;
use Psr\Log\LoggerInterface;

class LogReporter implements ExceptionReporterInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        $logContext = [
            'exception_class' => $th::class,
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'code' => $th->getCode(),
            'context' => $context,
        ];

        $this->logger->error($th->getMessage(), $logContext);
    }
}
```

### 数据库报告器

```php
use Hi\Exception\ExceptionReporterInterface;
use Hi\Database\DatabaseManager;

class DatabaseReporter implements ExceptionReporterInterface
{
    public function __construct(private DatabaseManager $db)
    {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        try {
            $this->db->table('error_logs')->insert([
                'exception_class' => $th::class,
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'stack_trace' => $th->getTraceAsString(),
                'context' => json_encode($context),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $e) {
            // 记录报告失败
            error_log('Failed to log exception to database: ' . $e->getMessage());
        }
    }
}
```

## 报告器管理

### 添加报告器

```php
$handler = new ExceptionHandler();

// 添加邮件报告器
$handler->addReporter(new EmailReporter('admin@example.com', $mailer));

// 添加日志报告器
$handler->addReporter(new LogReporter($logger));

// 添加数据库报告器
$handler->addReporter(new DatabaseReporter($db));
```

### 闭包报告器

除了实现接口的类，还可以使用闭包作为报告器：

```php
$handler->addReporter(function (\Throwable $th, mixed $context = null) {
    // 自定义报告逻辑
    if ($th instanceof DatabaseException) {
        // 特殊处理数据库异常
        $this->notifyDatabaseAdmin($th);
    }
});
```

### 重置报告器

```php
// 清除所有报告器
$handler->resetReporters();

// 重新添加需要的报告器
$handler->addReporter(new ConsoleReporter());
$handler->addReporter(new LogReporter($logger));
```

## 异常过滤

### 不报告特定异常

```php
// 不报告实现了 NoReportedExceptionInterface 的异常
$handler->dontReport(NoReportedExceptionInterface::class);

// 不报告特定异常类
$handler->dontReport(UserNotFoundException::class);
$handler->dontReport(ValidationException::class);
```

### 条件报告

在报告器中实现条件逻辑：

```php
class ConditionalReporter implements ExceptionReporterInterface
{
    public function report(\Throwable $th, mixed $context = null): void
    {
        // 只在生产环境中报告严重异常
        if (!AppDebug && $this->isSevereException($th)) {
            $this->sendAlert($th);
        }
    }

    private function isSevereException(\Throwable $th): bool
    {
        $severeExceptions = [
            DatabaseConnectionException::class,
            MemoryLimitException::class,
            FatalErrorException::class,
        ];

        foreach ($severeExceptions as $severeException) {
            if ($th instanceof $severeException) {
                return true;
            }
        }

        return false;
    }
}
```

## 报告上下文

### 上下文信息

报告器可以接收额外的上下文信息：

```php
public function report(\Throwable $th, mixed $context = null): void
{
    $contextInfo = [];
    
    if ($context instanceof HttpContext) {
        $contextInfo = [
            'url' => $context->request->getUri()->__toString(),
            'method' => $context->request->getMethod(),
            'user_agent' => $context->request->getHeaderLine('User-Agent'),
            'ip' => $context->request->getServerParams()['REMOTE_ADDR'] ?? '',
        ];
    }

    // 使用上下文信息进行报告
    $this->logException($th, $contextInfo);
}
```

### 环境信息

```php
class EnvironmentReporter implements ExceptionReporterInterface
{
    public function report(\Throwable $th, mixed $context = null): void
    {
        $environment = [
            'php_version' => PHP_VERSION,
            'framework_version' => Framework::VERSION,
            'memory_usage' => memory_get_usage(true),
            'peak_memory' => memory_get_peak_usage(true),
            'server_time' => date('Y-m-d H:i:s'),
        ];

        $this->logExceptionWithEnvironment($th, $environment);
    }
}
```

### 批量报告

```php
class BatchReporter implements ExceptionReporterInterface
{
    private array $pendingReports = [];
    private int $batchSize = 100;

    public function report(\Throwable $th, mixed $context = null): void
    {
        $this->pendingReports[] = [
            'exception' => $th,
            'context' => $context,
            'timestamp' => time(),
        ];

        if (count($this->pendingReports) >= $this->batchSize) {
            $this->flushReports();
        }
    }

    private function flushReports(): void
    {
        if (empty($this->pendingReports)) {
            return;
        }

        // 批量处理报告
        $this->processBatch($this->pendingReports);
        $this->pendingReports = [];
    }
}
```

## 最佳实践

### 1. 报告器设计

- 保持报告器简单，专注于单一职责
- 实现错误容忍，报告失败不应影响主程序
- 考虑性能影响，避免阻塞操作

### 2. 异常分类

- 根据异常严重程度选择不同的报告策略
- 为不同类型的异常配置专门的报告器
- 避免过度报告，减少噪音

### 3. 监控和告警

- 实现报告器的监控机制
- 设置合理的告警阈值
- 定期检查报告系统的健康状态

## 总结

Typing PHP Framework 的错误报告系统提供了：

- 灵活的报告器接口设计
- 内置的控制台报告器
- 支持多种自定义报告器
- 异常过滤和条件报告
- 丰富的上下文信息支持
- 性能优化的异步和批量处理

通过合理配置报告器，可以构建完善的异常监控和告警系统。
