# 异常系统

## 概述

Typing PHP Framework 提供了完整的异常处理系统，包括全局异常捕获、错误报告、自定义异常类型等功能。系统设计遵循 PSR 标准，支持多种异常处理策略。

## 核心架构

### 异常处理器接口

框架定义了 `ExceptionHandlerInterface` 接口，提供统一的异常处理契约：

```php
interface ExceptionHandlerInterface extends ExceptionReporterInterface
{
    /**
     * 启用全局异常处理
     */
    public function register(): void;

    /**
     * 处理全局异常并输出错误信息
     */
    public function handleGlobalException(\Throwable $e): void;

    /**
     * 处理异常并返回响应
     */
    public function handle(\Throwable $th, mixed $context = null): mixed;
}
```

### 默认异常处理器

`ExceptionHandler` 类实现了默认的异常处理逻辑：

- **全局异常注册**：自动注册 PHP 错误处理器、异常处理器和关闭函数
- **错误转换**：将 PHP 错误转换为 `ErrorException`
- **致命错误处理**：捕获 PHP 关闭时的致命错误
- **异常报告**：支持多种报告器

## 异常处理流程

### 1. 异常捕获

```php
// 自动捕获未处理的异常
set_exception_handler($this->handleGlobalException(...));

// 捕获 PHP 错误
set_error_handler($this->handleError(...));

// 捕获致命错误
register_shutdown_function($this->handleShutdown(...));
```

### 2. 异常分类

框架支持两种主要的异常类型：

#### 预期异常 (ExpectedException)
- 业务逻辑中的预期错误
- 不会导致系统崩溃
- 可以返回友好的错误信息

#### 非预期异常
- 系统错误、运行时错误
- 需要记录日志和报告
- 在生产环境中隐藏详细错误信息

### 3. 异常响应

根据异常类型和上下文，系统会生成不同的响应：

```php
public function handle(\Throwable $th, mixed $context = null): mixed
{
    // 报告异常
    $this->report($th, $context);

    // 如果是 HTTP 上下文，返回 HTTP 响应
    if (! $context instanceof Context) {
        return '';
    }

    return new Response(
        body: $th->getMessage(),
        statusCode: 500,
    );
}
```

## 自定义异常处理器

### 继承默认处理器

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

### 注册自定义处理器

```php
// 在应用启动时注册
$handler = new Application\Exception\Handler();
$handler->register();
```

## 异常类型

### 基础异常类

框架提供了多种预定义的异常类型：

- `ExpectedException`：预期异常基类
- `PassedDataException`：数据透传异常
- `NeedRedirectException`：重定向异常
- `NoReportedExceptionInterface`：不报告异常接口

### 自定义异常

```php
use Hi\Exception\Exception;

class UserNotFoundException extends Exception
{
    public function __construct(string $userId)
    {
        parent::__construct("用户 {$userId} 不存在", 404);
    }
}
```

## 最佳实践

### 1. 异常粒度

- 为不同的错误情况创建专门的异常类
- 使用有意义的异常消息
- 提供足够的上下文信息

### 2. 异常处理策略

- 在业务逻辑中抛出预期异常
- 使用 `NoReportedExceptionInterface` 标记不需要报告的异常
- 在控制器中捕获并处理异常

### 3. 错误信息

- 生产环境中隐藏敏感信息
- 提供用户友好的错误消息
- 记录详细的调试信息到日志

## 配置选项

### 异常报告控制

```php
// 不报告特定类型的异常
$handler->dontReport(NoReportedExceptionInterface::class);

// 添加自定义报告器
$handler->addReporter(new CustomReporter());

// 重置报告器
$handler->resetReporters();
```

### 调试模式

在开发环境中，可以启用调试模式以显示详细的错误信息：

```php
if (AppDebug) {
    return $this->prepareDebugResponse($th, $context);
}
```

## 总结

Typing PHP Framework 的异常系统提供了：

- 完整的异常捕获和处理机制
- 灵活的异常分类和响应策略
- 可扩展的异常报告系统
- 符合 PSR 标准的接口设计
- 丰富的预定义异常类型

通过合理使用这些功能，可以构建健壮、用户友好的应用程序。
