---
fqcn: Hi\Event\Metrics\MetricsCollectorInterface
type: interface
namespace: Hi\Event\Metrics
module: Event
file: src/Event/Metrics/MetricsCollectorInterface.php
line: 15
---
# MetricsCollectorInterface

**命名空间**: `Hi\Event\Metrics`

**类型**: Interface

**文件**: `src/Event/Metrics/MetricsCollectorInterface.php:15`

Event Metrics Collector Interface

Defines the contract for collecting event system metrics including:
- Event dispatching metrics (counts, durations, results)
- Listener execution metrics (individual timings, success/failure rates)
- Async processing metrics (queuing, retries, failures, active jobs)

## 方法

### Public 方法

#### `incrementEventsDispatched`

```php
public function incrementEventsDispatched(string $eventClass): void
```

Increment the total number of events dispatched

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |

**返回**: `void`

#### `recordEventDispatchDuration`

```php
public function recordEventDispatchDuration(string $eventClass, float $durationMs): void
```

Record event dispatch duration

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |
| `$durationMs` | `float` | - | Duration in milliseconds |

**返回**: `void`

#### `incrementEventDispatchResult`

```php
public function incrementEventDispatchResult(string $eventClass, string $status): void
```

Increment event dispatch result counter

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |
| `$status` | `string` | - | Result status: 'success' or 'failure' |

**返回**: `void`

#### `recordListenerExecutionDuration`

```php
public function recordListenerExecutionDuration(string $eventClass, string $listenerName, float $durationMs): void
```

Record listener execution duration

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |
| `$listenerName` | `string` | - | Listener identifier/name |
| `$durationMs` | `float` | - | Execution duration in milliseconds |

**返回**: `void`

#### `incrementListenerExecutionResult`

```php
public function incrementListenerExecutionResult(string $eventClass, string $listenerName, string $status, ?string $exceptionType = 'null'): void
```

Increment listener execution result counter

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |
| `$listenerName` | `string` | - | Listener identifier/name |
| `$status` | `string` | - | Result status: 'success' or 'failure' |
| `$exceptionType` | `?string` | 'null' | Exception class name if failed |

**返回**: `void`

#### `incrementAsyncListenerEnqueued`

```php
public function incrementAsyncListenerEnqueued(string $eventClass, string $listenerName): void
```

Increment async listener enqueued counter

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |
| `$listenerName` | `string` | - | Listener identifier/name |

**返回**: `void`

#### `incrementAsyncListenerRetries`

```php
public function incrementAsyncListenerRetries(string $eventClass, string $listenerName, int $attemptNumber): void
```

Increment async listener retry counter

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |
| `$listenerName` | `string` | - | Listener identifier/name |
| `$attemptNumber` | `int` | - | Current attempt number (1-based) |

**返回**: `void`

#### `incrementAsyncListenerFailed`

```php
public function incrementAsyncListenerFailed(string $eventClass, string $listenerName, int $totalAttempts): void
```

Increment async listener final failure counter

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - | Fully qualified event class name |
| `$listenerName` | `string` | - | Listener identifier/name |
| `$totalAttempts` | `int` | - | Total number of attempts made |

**返回**: `void`

#### `setAsyncListenersActiveJobs`

```php
public function setAsyncListenersActiveJobs(int $count): void
```

Set the current number of active async jobs

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$count` | `int` | - | Current active job count |

**返回**: `void`

#### `getMetrics`

```php
public function getMetrics(): array
```

Get all current metric values (for debugging/monitoring)

**返回**: `array` - mixed> Current metric values

#### `reset`

```php
public function reset(): void
```

Reset all metrics (useful for testing)

**返回**: `void`

#### `flush`

```php
public function flush(): void
```

Flush any buffered metrics to storage/backend

**返回**: `void`

