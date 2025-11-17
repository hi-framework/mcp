---
fqcn: Hi\Redis\RedisConnection
type: class
namespace: Hi\Redis
module: Redis
file: src/Redis/RedisConnection.php
line: 11
---
# RedisConnection

**命名空间**: `Hi\Redis`

**类型**: Class

**文件**: `src/Redis/RedisConnection.php:11`

## 继承关系

**继承**: `Hi\ConnectionPool\Connection`

**实现**: `Hi\ConnectionPool\ConnectionInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$createdTime` | `int` | protected readonly | - |  |
| `$redis` | `Redis` | private | - |  |
| `$number` | `int` | public readonly | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | protected readonly | - |  |
| `$config` | `Hi\Redis\ConnectionConfig` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $number, Hi\ConnectionPool\PoolInterface $pool, Hi\Redis\ConnectionConfig $config, Psr\Log\LoggerInterface $logger)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | - |  |
| `$config` | `Hi\Redis\ConnectionConfig` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

#### `connect`

```php
public function connect(): void
```

**返回**: `void`

#### `disconnect`

```php
public function disconnect(): void
```

**返回**: `void`

#### `__call`

```php
public function __call(string $name, array $arguments): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$arguments` | `array` | - |  |

**返回**: `mixed`

#### `scan`

```php
public function scan(?int &$iterator, ?string $pattern = 'null', int $count = 0, ?string $type = 'null'): mixed
```

Scan the keyspace for keys

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$iterator` | `?int` | - |  |
| `$pattern` | `?string` | 'null' |  |
| `$count` | `int` | 0 |  |
| `$type` | `?string` | 'null' |  |

**返回**: `mixed` - This function will return an array of keys or FALSE if there are no more keys or Redis if in multimode

**抛出异常**:

- `\RedisException`

### Protected 方法

#### `createRedis`

```php
protected function createRedis(): Redis
```

**返回**: `Redis`

