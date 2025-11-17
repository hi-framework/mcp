---
fqcn: Hi\Event\Metrics\InMemoryMetricsCollector
type: class
namespace: Hi\Event\Metrics
module: Event
file: src/Event/Metrics/InMemoryMetricsCollector.php
line: 15
---
# InMemoryMetricsCollector

**命名空间**: `Hi\Event\Metrics`

**类型**: Class

**文件**: `src/Event/Metrics/InMemoryMetricsCollector.php:15`

In-Memory Metrics Collector

A simple implementation that stores all metrics in memory.
Suitable for testing, development, and single-process applications.
For production use, consider implementing a collector that exports
to Prometheus, StatsD, or other monitoring systems.

## 继承关系

**实现**: `Hi\Event\Metrics\MetricsCollectorInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$counters` | `array` | private | [] |  |
| `$histograms` | `array` | private | [] |  |
| `$gauges` | `array` | private | [] |  |

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

#### `getCounter`

```php
public function getCounter(string $key): int
```

Get counter value by key (for testing)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `int`

#### `getHistogram`

```php
public function getHistogram(string $key): array
```

Get histogram values by key (for testing)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `array`

#### `getGauge`

```php
public function getGauge(string $key): int|float|null
```

Get gauge value by key (for testing)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `int|float|null`

