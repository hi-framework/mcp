# 异常处理

## 概述

Typing PHP Framework 提供了完整的异常处理系统，帮助开发者构建健壮、可靠的应用程序。系统支持全局异常捕获、错误报告、日志记录等功能，遵循 PSR 标准，提供灵活的配置选项。

## 核心特性

- **全局异常捕获**：自动捕获未处理的异常和 PHP 错误
- **灵活的报告系统**：支持多种报告器和自定义报告策略
- **结构化日志记录**：提供完整的异常追踪和分析能力
- **异常分类处理**：区分预期异常和系统异常，采用不同的处理策略
- **性能优化**：支持异步处理和批量操作

## 快速开始

### 1. 基本使用

```php
use Hi\Exception\ExceptionHandler;

// 创建异常处理器
$handler = new ExceptionHandler();

// 注册全局异常处理
$handler->register();
```

### 2. 自定义异常处理器

```php
namespace Application\Exception;

use Hi\Exception\ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function handle(\Throwable $th, mixed $context = null): mixed
    {
        // 自定义异常处理逻辑
        if ($th instanceof CustomException) {
            return $this->handleCustomException($th, $context);
        }

        return parent::handle($th, $context);
    }
}
```

### 3. 添加报告器

```php
$handler = new ExceptionHandler();

// 添加邮件报告器
$handler->addReporter(new EmailReporter('admin@example.com', $mailer));

// 添加日志报告器
$handler->addReporter(new LogReporter($logger));
```

## 文档导航

### [异常系统](./system.md)

了解框架异常处理的核心架构和设计理念：

- 异常处理器接口和实现
- 异常处理流程和分类
- 自定义异常处理器
- 异常类型和最佳实践

### [错误报告](./reporting.md)

深入理解异常报告机制：

- 报告器接口设计
- 内置和自定义报告器
- 报告器管理和配置
- 异常过滤和条件报告

### [日志记录](./logging.md)

掌握异常日志记录的最佳实践：

- 日志记录策略和格式
- 多种存储方式（文件、数据库、远程服务）
- 日志轮转和性能优化
- 监控告警和健康检查

## 架构图

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   应用程序代码   │    │   异常处理器     │    │   报告器系统     │
│                 │    │                 │    │                 │
│  throw new      │───▶│  Exception      │───▶│  Console        │
│  Exception()    │    │  Handler        │    │  Reporter       │
└─────────────────┘    └─────────────────┘    ├─────────────────┤
                                              │  Log Reporter   │
                                              ├─────────────────┤
                                              │  Email          │
                                              │  Reporter       │
                                              └─────────────────┘
```

## 常见使用场景

### 1. Web 应用异常处理

```php
// 在 HTTP 中间件中处理异常
try {
    $response = $next($request);
} catch (\Throwable $e) {
    return $handler->handle($e, $request);
}
```

### 2. 命令行应用异常处理

```php
// 在控制台命令中处理异常
try {
    $this->execute();
} catch (\Throwable $e) {
    $handler->handle($e);
    return 1;
}
```

### 3. 业务逻辑异常

```php
// 抛出业务异常
if (!$user) {
    throw new UserNotFoundException("用户不存在");
}

// 抛出数据透传异常
if ($validation->fails()) {
    throw new PassedDataException(
        "验证失败",
        422,
        $validation->errors()
    );
}
```

## 配置选项

### 环境配置

```php
// 生产环境配置
if (!AppDebug) {
    $handler->dontReport(NoReportedExceptionInterface::class);
    $handler->addReporter(new ProductionReporter());
}

// 开发环境配置
if (AppDebug) {
    $handler->addReporter(new ConsoleReporter());
    $handler->addReporter(new DebugReporter());
}
```

### 报告器配置

```php
// 配置邮件报告器
$emailReporter = new EmailReporter(
    adminEmail: 'admin@example.com',
    mailer: $mailer
);
$handler->addReporter($emailReporter);

// 配置日志报告器
$logReporter = new LogReporter(
    logger: $logger,
    level: 'ERROR'
);
$handler->addReporter($logReporter);
```

## 最佳实践

### 1. 异常设计

- 为不同的错误情况创建专门的异常类
- 使用有意义的异常消息和错误代码
- 实现 `NoReportedExceptionInterface` 标记不需要报告的异常

### 2. 异常处理

- 在业务逻辑中抛出预期异常
- 在控制器或中间件中捕获和处理异常
- 避免在异常处理器中抛出新的异常

### 3. 日志记录

- 记录足够的上下文信息
- 避免记录敏感信息
- 实现日志轮转和清理

### 4. 性能考虑

- 使用异步报告器处理耗时操作
- 实现批量处理减少 I/O 操作
- 合理配置报告器数量

## 故障排除

### 常见问题

1. **异常处理器未生效**
   - 检查是否正确调用了 `register()` 方法
   - 确认异常处理器在应用启动时注册

2. **报告器未工作**
   - 验证报告器是否正确添加到处理器
   - 检查报告器的错误日志

3. **日志文件过大**
   - 配置日志轮转策略
   - 定期清理过期日志

### 调试技巧

```php
// 启用调试模式
if (AppDebug) {
    $handler->addReporter(new DebugReporter());
}

// 临时添加调试报告器
$handler->addReporter(function (\Throwable $th) {
    var_dump($th);
});
```

## 总结

Typing PHP Framework 的异常处理系统为应用程序提供了：

- **可靠性**：完整的异常捕获和处理机制
- **灵活性**：可扩展的报告器和自定义处理策略
- **可观测性**：详细的日志记录和监控能力
- **性能**：优化的异步处理和批量操作
- **标准性**：符合 PSR 标准的接口设计

通过合理使用这些功能，可以构建健壮、可维护的应用程序，快速定位和解决问题。
