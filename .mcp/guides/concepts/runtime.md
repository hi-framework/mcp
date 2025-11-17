# 运行时系统

Hi Framework 的运行时系统提供了统一的抽象层，支持多种 PHP 运行时环境，包括内置同步运行时和 Swoole 异步运行时。通过运行时抽象，应用程序可以在不同运行时环境间无缝切换。

## 核心概念

### 1. 运行时类型

Hi Framework 支持两种运行时类型：

```php
enum AppRuntimeTypeEnum: string
{
    case Builtin = 'builtin';  // PHP 内置运行时（同步）
    case Swoole = 'swoole';    // Swoole 运行时（异步）
}
```

运行时类型通过环境变量 `APP_RUNTIME_TYPE` 配置，默认为 `builtin`。

### 2. 运行时组件

运行时系统包含三个核心组件：

- **协程管理** (`CoroutineInterface`) - 协程创建、睡眠、上下文管理
- **定时器** (`TimerInterface`) - 定时任务和延迟执行
- **通道** (`ChannelInterface`) - 协程间通信（仅 Swoole）

## 快速开始

### 基本用法

```php
use Hi\Runtime\AppRuntime;

// 获取当前运行时类型
$type = AppRuntime::getType(); // AppRuntimeTypeEnum

// 协程操作
$coroutine = AppRuntime::coroutine();
$coroutine->sleep(1.0); // 睡眠 1 秒

// 协程容器
$coroutine->space(function () {
    echo "Hello from coroutine corotine\n";
});

// 创建协程
$coroutine->create(function () {
    echo "Hello from coroutine\n";
});

// 定时器操作
$timer = AppRuntime::timer();

// 延迟执行
$timer->after(2.0, function () {
    echo "Delayed execution\n";
});

// 周期执行
$timerId = $timer->tick(1.0, function () {
    echo "Periodic task\n";
});

// 清理定时器
$timer->clear($timerId);
```

### 环境配置

通过环境变量配置运行时类型：

```bash
# 使用内置运行时（默认）
export APP_RUNTIME_TYPE=builtin

# 使用 Swoole 运行时
export APP_RUNTIME_TYPE=swoole
```

## 协程管理

### CoroutineInterface 接口

```php
interface CoroutineInterface
{
    // 创建协程空间并运行
    public function space(callable $callback, mixed ...$arguments): void;
    
    // 创建新协程
    public function create(callable $callback, mixed ...$arguments): int;
    
    // 协程睡眠
    public function sleep(float $time): void;
    
    // 延迟执行回调
    public function defer(callable $callback): void;
    
    // 获取协程上下文
    public function context(): ?object;
}
```

## 定时器管理

### TimerInterface 接口

```php
interface TimerInterface
{
    // 周期执行定时器
    public function tick(float $time, callable $callback, mixed ...$arguments): int;
    
    // 延迟执行定时器
    public function after(float $time, callable $callback, mixed ...$arguments): int;
    
    // 清理定时器
    public function clear(int $id): void;
}
```

### 定时器使用示例

```php
$timer = AppRuntime::timer();

// 延迟执行 - 2 秒后执行一次
$timer->after(2.0, function () {
    echo "Delayed task executed\n";
});

// 周期执行 - 每秒执行一次
$tickId = $timer->tick(1.0, function () {
    echo "Periodic task: " . date('Y-m-d H:i:s') . "\n";
});

// 5 秒后清理周期任务
$timer->after(5.0, function () use ($timer, $tickId) {
    $timer->clear($tickId);
    echo "Periodic task cleared\n";
});
```

## 通道通信

### ChannelInterface 接口

```php
interface ChannelInterface
{
    // 创建通道
    public function create(int $size = 0): mixed;
}
```

### Swoole 通道实现

```php
// 仅在 Swoole 运行时可用
$channel = AppRuntime::channel();

// 创建有缓冲通道
$chan = $channel->create(10); // Swoole\Coroutine\Channel

// 协程间通信
AppRuntime::coroutine()->create(function () use ($chan) {
    $chan->push("Hello from producer");
});

AppRuntime::coroutine()->create(function () use ($chan) {
    $message = $chan->pop();
    echo "Received: $message\n";
});
```

## 运行时控制

### 程序退出控制

```php
// 安全退出 Swoole 事件循环
AppRuntime::exit();
```

### 等待协程完成

```php
// 等待所有协程完成，最多等待 60 秒
AppRuntime::wait(60);
```

### shutdown

```php
// 等待协程退出并退出所有事件
AppRuntime::shutdown();
```

## 重试机制

Runtime 组件还提供了重试机制：

### RetryInterface 接口

```php
interface RetryInterface
{
    // 重试执行，失败时抛出异常
    public function do(int $times, float $timeout, callable $callback): mixed;
    
    // 尝试执行，失败时返回 null
    public function tryDo(int $times, float $timeout, callable $callback): mixed;
}
```

### 重试使用示例

```php
use Hi\Runtime\Retry;

$retry = new Retry();

// 重试机制 - 失败抛出异常
try {
    $result = $retry->do(3, 1.0, function () {
        // 返回 null 表示失败，需要重试
        // 返回其他值表示成功
        if (rand(0, 1)) {
            return "success";
        }
        return null;
    });
    echo "Result: $result\n";
} catch (RetryTimeoutException $e) {
    echo "Retry failed after 3 attempts\n";
}

// 尝试机制 - 失败返回 null
$result = $retry->tryDo(3, 1.0, function () {
    // 模拟不稳定的操作
    return rand(0, 2) ? "success" : null;
});

if ($result) {
    echo "Success: $result\n";
} else {
    echo "Failed after retries\n";
}
```

## 运行时差异

### Swoole 运行时特性

- **真实协程**：基于 Swoole 的协程实现
- **异步 I/O**：支持异步文件、网络操作
- **协程上下文**：每个协程有独立的上下文
- **定时器**：高精度的异步定时器
- **通道通信**：协程间高效通信

### Builtin 运行时特性

- **同步执行**：所有操作都是同步的
- **简单睡眠**：使用 `time_nanosleep` 实现
- **模拟上下文**：使用 `ArrayObject` 模拟协程上下文
- **功能受限**：定时器功能尚未实现
- **兼容性**：在任何 PHP 环境都可运行

## 注意事项

### 1. 运行时兼容性

- Builtin 运行时的定时器功能尚未实现
- 通道功能仅在 Swoole 运行时可用
- 确保代码在两种运行时下都能正常工作

### 2. 协程安全

- 在 Swoole 运行时下注意协程安全
- 避免在协程间共享可变状态
- 使用适当的同步机制

### 3. 性能考虑

- Swoole 运行时适合高并发场景
- Builtin 运行时适合简单的同步场景
- 根据应用需求选择合适的运行时类型

## 总结

Hi Framework 的运行时系统通过统一的抽象层，实现了：

- **多运行时支持**：同时支持同步和异步运行时
- **统一接口**：应用代码在不同运行时间无缝切换
- **功能完整**：协程、定时器、通道等核心功能
- **扩展性强**：易于添加新的运行时支持

运行时系统是框架的基础设施，为作用域管理、异步任务处理等高级功能提供了底层支持。