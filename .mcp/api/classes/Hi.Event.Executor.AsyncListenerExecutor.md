---
fqcn: Hi\Event\Executor\AsyncListenerExecutor
type: class
namespace: Hi\Event\Executor
module: Event
file: src/Event/Executor/AsyncListenerExecutor.php
line: 20
---
# AsyncListenerExecutor

**命名空间**: `Hi\Event\Executor`

**类型**: Class

**文件**: `src/Event/Executor/AsyncListenerExecutor.php:20`

Asynchronous Listener Executor

Handles the execution of asynchronous event listeners with coroutine support,
retry mechanisms, and resource management

## 继承关系

**继承**: `Hi\Event\Executor\AbstractListenerExecutor`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$activeJobs` | `int` | private | 0 |  |
| `$maxConcurrentJobs` | `int` | private | - |  |
| `$coroutine` | `Hi\Runtime\CoroutineInterface` | private readonly | - |  |
| `$metricsCollector` | `Hi\Event\Metrics\MetricsCollectorInterface` | private | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Runtime\CoroutineInterface $coroutine, int $maxConcurrentJobs = 1000, Psr\Log\LoggerInterface $logger = '...', Hi\Event\Metrics\MetricsCollectorInterface $metricsCollector = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$coroutine` | `Hi\Runtime\CoroutineInterface` | - |  |
| `$maxConcurrentJobs` | `int` | 1000 |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |
| `$metricsCollector` | `Hi\Event\Metrics\MetricsCollectorInterface` | '...' |  |

**返回**: `void`

#### `execute`

```php
public function execute(object $event, array $listeners): void
```

Execute asynchronous listeners for an event

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$event` | `object` | - | Event to process |
| `$listeners` | `array` | - | Async listeners to execute |

**返回**: `void`

#### `getActiveJobCount`

```php
public function getActiveJobCount(): int
```

Get current active job count

**返回**: `int`

#### `getMaxConcurrentJobs`

```php
public function getMaxConcurrentJobs(): int
```

Get maximum concurrent job limit

**返回**: `int`

#### `waitForCompletion`

```php
public function waitForCompletion(int $timeout = 30): bool
```

Wait for all async jobs to complete

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$timeout` | `int` | 30 | Timeout in seconds |

**返回**: `bool` - True if all jobs completed, false if timeout

#### `cleanup`

```php
public function cleanup(): void
```

Force cleanup of all async resources

**返回**: `void`

