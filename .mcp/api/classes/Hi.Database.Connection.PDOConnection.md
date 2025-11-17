---
fqcn: Hi\Database\Connection\PDOConnection
type: class
namespace: Hi\Database\Connection
module: Database
file: src/Database/Connection/PDOConnection.php
line: 15
---
# PDOConnection

**命名空间**: `Hi\Database\Connection`

**类型**: Class

**文件**: `src/Database/Connection/PDOConnection.php:15`

## 继承关系

**继承**: `Hi\ConnectionPool\Connection`

**实现**: `Hi\ConnectionPool\ConnectionInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$createdTime` | `int` | protected readonly | - |  |
| `$pdo` | `Hi\Database\Connection\PDO` | protected | - |  |
| `$number` | `int` | public readonly | - |  |
| `$driverName` | `Hi\Database\Connection\DriverEnum` | public readonly | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | protected readonly | - |  |
| `$config` | `Hi\Database\Connection\PDOConnectionConfig` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $number, Hi\Database\Connection\DriverEnum $driverName, Hi\ConnectionPool\PoolInterface $pool, Hi\Database\Connection\PDOConnectionConfig $config, Psr\Log\LoggerInterface $logger)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |
| `$driverName` | `Hi\Database\Connection\DriverEnum` | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | - |  |
| `$config` | `Hi\Database\Connection\PDOConnectionConfig` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

#### `release`

```php
public function release(): void
```

**返回**: `void`

#### `connect`

```php
public function connect(): void
```

**返回**: `void`

#### `isConnected`

```php
public function isConnected(): bool
```

**返回**: `bool`

#### `reconnect`

```php
public function reconnect(Hi\Database\Connection\PDOException $previous): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$previous` | `Hi\Database\Connection\PDOException` | - |  |

**返回**: `void`

#### `disconnect`

```php
public function disconnect(): void
```

**返回**: `void`

#### `beginTransaction`

```php
public function beginTransaction(): bool
```

**返回**: `bool`

#### `commit`

```php
public function commit(): bool
```

**返回**: `bool`

#### `errorCode`

```php
public function errorCode(): ?string
```

**返回**: `?string`

#### `errorInfo`

```php
public function errorInfo(): array
```

**返回**: `array`

#### `exec`

```php
public function exec(string $statement): int|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$statement` | `string` | - |  |

**返回**: `int|false`

#### `getAttribute`

```php
public function getAttribute(int $attribute): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `int` | - |  |

**返回**: `mixed`

#### `inTransaction`

```php
public function inTransaction(): bool
```

**返回**: `bool`

#### `lastInsertId`

```php
public function lastInsertId(?string $name = 'null'): string|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `?string` | 'null' |  |

**返回**: `string|false`

#### `prepare`

```php
public function prepare(string $query, array $options = []): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$query` | `string` | - |  |
| `$options` | `array` | [] |  |

**返回**: `mixed`

#### `query`

```php
public function query(string $query, ?int $fetchMode = 'null', ...$ctorArgs): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$query` | `string` | - |  |
| `$fetchMode` | `?int` | 'null' |  |
| `...$ctorArgs` | `mixed` | - |  |

**返回**: `mixed`

#### `quote`

```php
public function quote(string $string, int $type = 'PDO::PARAM_STR'): string|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$string` | `string` | - |  |
| `$type` | `int` | 'PDO::PARAM_STR' |  |

**返回**: `string|false`

#### `rollback`

```php
public function rollback(): bool
```

**返回**: `bool`

#### `setAttribute`

```php
public function setAttribute(int $attribute, mixed $value): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `int` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `bool`

#### `getPDO`

```php
public function getPDO(): Hi\Database\Connection\PDO
```

获取 PDO 实例

**返回**: `Hi\Database\Connection\PDO` - PDO 实例

#### `retry`

```php
public function retry(string $name, array $parameters): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$parameters` | `array` | - |  |

**返回**: `mixed`

### Protected 方法

#### `createPDO`

```php
protected function createPDO(): Hi\Database\Connection\PDO
```

**返回**: `Hi\Database\Connection\PDO`

