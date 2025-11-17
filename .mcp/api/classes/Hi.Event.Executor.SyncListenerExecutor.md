---
fqcn: Hi\Event\Executor\SyncListenerExecutor
type: class
namespace: Hi\Event\Executor
module: Event
file: src/Event/Executor/SyncListenerExecutor.php
line: 20
---
# SyncListenerExecutor

**命名空间**: `Hi\Event\Executor`

**类型**: Class

**文件**: `src/Event/Executor/SyncListenerExecutor.php:20`

Synchronous Listener Executor

Handles the execution of synchronous event listeners with proper error isolation,
execution timing, and propagation control

## 继承关系

**继承**: `Hi\Event\Executor\AbstractListenerExecutor`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$metricsCollector` | `Hi\Event\Metrics\MetricsCollectorInterface` | private readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger = '...', Hi\Event\Metrics\MetricsCollectorInterface $metricsCollector = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |
| `$metricsCollector` | `Hi\Event\Metrics\MetricsCollectorInterface` | '...' |  |

**返回**: `void`

#### `execute`

```php
public function execute(object $event, array $listeners): object
```

Execute synchronous listeners for an event

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$event` | `object` | - | Event to process |
| `$listeners` | `array` | - | Sorted listeners to execute |

**返回**: `object` - The event object (potentially modified by listeners)

