---
fqcn: Hi\ConnectionPool\Pool
type: class
namespace: Hi\ConnectionPool
module: ConnectionPool
file: src/ConnectionPool/Pool.php
line: 21
---
# Pool

**命名空间**: `Hi\ConnectionPool`

**类型**: Class

**文件**: `src/ConnectionPool/Pool.php:21`

**修饰符**: abstract

Abstract connection pool implementation

## 继承关系

**实现**: `Hi\ConnectionPool\PoolInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$connections` | `Hi\ConnectionPool\SplObjectStorage` | private | - | In use connections. |
| `$idle` | `Hi\ConnectionPool\SplQueue` | private | - | Idle connection pool. |
| `$autoIncrement` | `int` | private | 0 | New connection auto increment id. |
| `$maxOpen` | `int` | protected | 4 | the maximum number of open connections to the database |
| `$maxIdle` | `int` | protected | 1 | the number of idle connection in the pool |
| `$idleTimeout` | `int` | protected | 600 | the maximum amount of seconds time a connection may be idle |
| `$maxLifetime` | `int` | protected | 3600 | the maximum amount of seconds time a connection may be reused |
| `$maxGetRetries` | `int` | protected | 100 | number of times to retry getting a connection |
| `$disablePredicting` | `bool` | protected | 'false' | disable predicting |
| `$demandHistory` | `array` | protected | [] | the demand history, Connection Demand Prediction Based on This Data |
| `$retry` | `Hi\Runtime\RetryInterface` | protected | - |  |
| `$flushInterval` | `int` | protected | 60 | pool flush interval |
| `$timer` | `Hi\Runtime\TimerInterface` | protected | - | Timer |
| `$timerIds` | `array` | protected | [] |  |
| `$logger` | `?Psr\Log\LoggerInterface` | protected | 'null' |  |
| `$metricCollector` | `?Hi\ConnectionPool\MetricCollectorInterface` | protected | 'null' | Collector pool metrics |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $maxOpen = 4, int $maxIdle = 1, int $idleTimeout = 30, int $maxLifetime = 300, int $maxGetRetries = 100, bool $disablePredicting = 'false', array $demandHistory = [], Hi\Runtime\RetryInterface $retry = '...', ?Hi\Runtime\TimerInterface $timer = 'null', int $flushInterval = 60)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$maxOpen` | `int` | 4 | the maximum number of open connections to the database |
| `$maxIdle` | `int` | 1 | the number of idle connection in the pool |
| `$idleTimeout` | `int` | 30 | the maximum amount of seconds time a connection may be idle |
| `$maxLifetime` | `int` | 300 | the maximum amount of seconds time a connection may be reused |
| `$maxGetRetries` | `int` | 100 | number of times to retry getting a connection |
| `$disablePredicting` | `bool` | 'false' |  |
| `$demandHistory` | `array` | [] | the demand history, Connection Demand Prediction Based on This Data |
| `$retry` | `Hi\Runtime\RetryInterface` | '...' |  |
| `$timer` | `?Hi\Runtime\TimerInterface` | 'null' |  |
| `$flushInterval` | `int` | 60 |  |

**返回**: `void`

#### `finalize`

```php
public function finalize(): void
```

**返回**: `void`

#### `get`

```php
public function get(float $timeout = 0.01): Hi\ConnectionPool\ConnectionInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$timeout` | `float` | 0.01 | timeout in seconds |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

#### `put`

```php
public function put(Hi\ConnectionPool\ConnectionInterface $connection): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\ConnectionPool\ConnectionInterface` | - |  |

**返回**: `void`

#### `flush`

```php
public function flush(): void
```

**返回**: `void`

#### `getConnectionLimit`

```php
public function getConnectionLimit(): int
```

**返回**: `int`

#### `getConnectionCount`

```php
public function getConnectionCount(): int
```

**返回**: `int`

#### `getIdleCount`

```php
public function getIdleCount(): int
```

**返回**: `int`

#### `getIdleLimit`

```php
public function getIdleLimit(): int
```

**返回**: `int`

#### `getIdleTimeout`

```php
public function getIdleTimeout(): int
```

**返回**: `int`

#### `getMaxLifetime`

```php
public function getMaxLifetime(): int
```

**返回**: `int`

#### `getMaxGetRetries`

```php
public function getMaxGetRetries(): int
```

**返回**: `int`

#### `setMetricCollector`

```php
public function setMetricCollector(Hi\ConnectionPool\MetricCollectorInterface $collector): self
```

Set pool metric collector

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$collector` | `Hi\ConnectionPool\MetricCollectorInterface` | - |  |

**返回**: `self`

#### `name`

**标记**: abstract

```php
abstract public function name(): string
```

**返回**: `string`

### Protected 方法

#### `removeExpiredIdleConnections`

```php
protected function removeExpiredIdleConnections(): int
```

Remove expired idle connections

**返回**: `int`

#### `removeExpiredConnections`

```php
protected function removeExpiredConnections(): int
```

Remove expired in use connections
If a connection has exceeded its lifetime, it will be removed

**返回**: `int`

#### `predictingConnections`

```php
protected function predictingConnections(): int
```

**返回**: `int`

#### `createConnection`

**标记**: abstract

```php
abstract protected function createConnection(int $number): Hi\ConnectionPool\ConnectionInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

