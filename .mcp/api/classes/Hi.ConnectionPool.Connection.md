---
fqcn: Hi\ConnectionPool\Connection
type: class
namespace: Hi\ConnectionPool
module: ConnectionPool
file: src/ConnectionPool/Connection.php
line: 9
---
# Connection

**命名空间**: `Hi\ConnectionPool`

**类型**: Class

**文件**: `src/ConnectionPool/Connection.php:9`

**修饰符**: abstract

## 继承关系

**实现**: `Hi\ConnectionPool\ConnectionInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$createdTime` | `int` | protected readonly | - | The connection created time (timestamp). |
| `$lastUseTime` | `float` | protected | 0 | Last use time, accurate to milliseconds. |
| `$closed` | `bool` | protected | 'false' | Whether the connection is closed. |
| `$connected` | `bool` | protected | 'false' | Whether the connection is connected. |
| `$isReleased` | `bool` | protected | 'false' | Whether the connection is released. Used to avoid double release. |
| `$number` | `int` | public readonly | - | The unique number of this connection. |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | protected readonly | - | The current connection pool instance. |
| `$logger` | `?Psr\Log\LoggerInterface` | protected | 'null' |  |

## 方法

### Public 方法

#### `__destruct`

```php
public function __destruct()
```

**返回**: `void`

#### `use`

```php
public function use(): self
```

**返回**: `self`

#### `release`

```php
public function release(): void
```

**返回**: `void`

#### `isConnected`

```php
public function isConnected(): bool
```

**返回**: `bool`

#### `isClosed`

```php
public function isClosed(): bool
```

**返回**: `bool`

#### `getLastUseTime`

```php
public function getLastUseTime(): float
```

**返回**: `float`

#### `getCreatedTime`

```php
public function getCreatedTime(): int
```

**返回**: `int`

#### `getNumber`

```php
public function getNumber(): int
```

**返回**: `int`

