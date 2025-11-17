---
fqcn: Hi\Event\EventDispatcher
type: class
namespace: Hi\Event
module: Event
file: src/Event/EventDispatcher.php
line: 21
---
# EventDispatcher

**命名空间**: `Hi\Event`

**类型**: Class

**文件**: `src/Event/EventDispatcher.php:21`

PSR-14 Event Dispatcher

Core event dispatching implementation that supports both synchronous and asynchronous processing

## 继承关系

**实现**: `Psr\EventDispatcher\EventDispatcherInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$eventListenersCache` | `array` | private | [] | Event listeners cache |
| `$listenerProvider` | `Psr\EventDispatcher\ListenerProviderInterface` | private readonly | - |  |
| `$syncExecutor` | `Hi\Event\Executor\SyncListenerExecutor` | private readonly | - |  |
| `$asyncExecutor` | `Hi\Event\Executor\AsyncListenerExecutor` | private readonly | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | '...' |  |
| `$metricsCollector` | `Hi\Event\Metrics\MetricsCollectorInterface` | private readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\EventDispatcher\ListenerProviderInterface $listenerProvider, Hi\Event\Executor\SyncListenerExecutor $syncExecutor, Hi\Event\Executor\AsyncListenerExecutor $asyncExecutor, Psr\Log\LoggerInterface $logger = '...', Hi\Event\Metrics\MetricsCollectorInterface $metricsCollector = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$listenerProvider` | `Psr\EventDispatcher\ListenerProviderInterface` | - |  |
| `$syncExecutor` | `Hi\Event\Executor\SyncListenerExecutor` | - |  |
| `$asyncExecutor` | `Hi\Event\Executor\AsyncListenerExecutor` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |
| `$metricsCollector` | `Hi\Event\Metrics\MetricsCollectorInterface` | '...' |  |

**返回**: `void`

#### `dispatch`

```php
public function dispatch(object $event): object
```

Dispatch an event to all registered listeners

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$event` | `object` | - | Event to dispatch |

**返回**: `object` - The event object (potentially modified by listeners)

