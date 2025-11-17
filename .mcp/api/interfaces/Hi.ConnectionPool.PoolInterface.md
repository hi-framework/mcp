---
fqcn: Hi\ConnectionPool\PoolInterface
type: interface
namespace: Hi\ConnectionPool
module: ConnectionPool
file: src/ConnectionPool/PoolInterface.php
line: 7
---
# PoolInterface

**命名空间**: `Hi\ConnectionPool`

**类型**: Interface

**文件**: `src/ConnectionPool/PoolInterface.php:7`

## 方法

### Public 方法

#### `get`

```php
public function get(float $timeout = 0): Hi\ConnectionPool\ConnectionInterface
```

Get a connection from the pool

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$timeout` | `float` | 0 |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

#### `put`

```php
public function put(Hi\ConnectionPool\ConnectionInterface $connection): void
```

Put a connection back into the pool

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\ConnectionPool\ConnectionInterface` | - |  |

**返回**: `void`

#### `flush`

```php
public function flush(): void
```

Remove expired idle timeout and lifetime expired connections.

**返回**: `void`

#### `getConnectionLimit`

```php
public function getConnectionLimit(): int
```

Get the maximum number of open connections

**返回**: `int`

#### `getConnectionCount`

```php
public function getConnectionCount(): int
```

Get the current number of connections

**返回**: `int`

#### `getIdleLimit`

```php
public function getIdleLimit(): int
```

Get the maximum number of idle connections

**返回**: `int`

#### `getIdleCount`

```php
public function getIdleCount(): int
```

Get the current number of idle connections

**返回**: `int`

#### `getIdleTimeout`

```php
public function getIdleTimeout(): int
```

Get the idle timeout

**返回**: `int`

#### `getMaxLifetime`

```php
public function getMaxLifetime(): int
```

Get the maximum lifetime

**返回**: `int`

#### `getMaxGetRetries`

```php
public function getMaxGetRetries(): int
```

Get the maximum number of retries

**返回**: `int`

#### `finalize`

```php
public function finalize(): void
```

Finalize the pool

**返回**: `void`

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

