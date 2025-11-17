---
fqcn: Hi\Event\Metrics\NullMetricsCollector
type: class
namespace: Hi\Event\Metrics
module: Event
file: src/Event/Metrics/NullMetricsCollector.php
line: 14
---
# NullMetricsCollector

**命名空间**: `Hi\Event\Metrics`

**类型**: Class

**文件**: `src/Event/Metrics/NullMetricsCollector.php:14`

Null Metrics Collector

A no-op implementation of MetricsCollectorInterface that provides zero-cost
metrics collection when monitoring is disabled. All methods are empty and
optimized away by the PHP opcache.

## 继承关系

**实现**: `Hi\Event\Metrics\MetricsCollectorInterface`

## 方法

### Public 方法

#### `incrementEventsDispatched`

```php
public function incrementEventsDispatched(string $eventClass): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |

**返回**: `void`

#### `recordEventDispatchDuration`

```php
public function recordEventDispatchDuration(string $eventClass, float $durationMs): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |
| `$durationMs` | `float` | - |  |

**返回**: `void`

#### `incrementEventDispatchResult`

```php
public function incrementEventDispatchResult(string $eventClass, string $status): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |
| `$status` | `string` | - |  |

**返回**: `void`

#### `recordListenerExecutionDuration`

```php
public function recordListenerExecutionDuration(string $eventClass, string $listenerName, float $durationMs): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |
| `$listenerName` | `string` | - |  |
| `$durationMs` | `float` | - |  |

**返回**: `void`

#### `incrementListenerExecutionResult`

```php
public function incrementListenerExecutionResult(string $eventClass, string $listenerName, string $status, ?string $exceptionType = 'null'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |
| `$listenerName` | `string` | - |  |
| `$status` | `string` | - |  |
| `$exceptionType` | `?string` | 'null' |  |

**返回**: `void`

#### `incrementAsyncListenerEnqueued`

```php
public function incrementAsyncListenerEnqueued(string $eventClass, string $listenerName): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |
| `$listenerName` | `string` | - |  |

**返回**: `void`

#### `incrementAsyncListenerRetries`

```php
public function incrementAsyncListenerRetries(string $eventClass, string $listenerName, int $attemptNumber): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |
| `$listenerName` | `string` | - |  |
| `$attemptNumber` | `int` | - |  |

**返回**: `void`

#### `incrementAsyncListenerFailed`

```php
public function incrementAsyncListenerFailed(string $eventClass, string $listenerName, int $totalAttempts): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventClass` | `string` | - |  |
| `$listenerName` | `string` | - |  |
| `$totalAttempts` | `int` | - |  |

**返回**: `void`

#### `setAsyncListenersActiveJobs`

```php
public function setAsyncListenersActiveJobs(int $count): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$count` | `int` | - |  |

**返回**: `void`

#### `getMetrics`

```php
public function getMetrics(): array
```

**返回**: `array`

#### `reset`

```php
public function reset(): void
```

**返回**: `void`

#### `flush`

```php
public function flush(): void
```

**返回**: `void`

