---
fqcn: Hi\Database\Connection\PDOStatementProxy
type: class
namespace: Hi\Database\Connection
module: Database
file: src/Database/Connection/PDOStatementProxy.php
line: 9
---
# PDOStatementProxy

**命名空间**: `Hi\Database\Connection`

**类型**: Class

**文件**: `src/Database/Connection/PDOStatementProxy.php:9`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$stmt` | `Hi\Database\Connection\PDOStatement` | protected | - |  |
| `$connection` | `Hi\Database\Connection\PDOConnection` | protected readonly | - |  |
| `$previousName` | `string` | protected readonly | - |  |
| `$previousParameters` | `array` | protected readonly | - |  |
| `$logger` | `?Psr\Log\LoggerInterface` | protected readonly | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Database\Connection\PDOStatement $stmt, Hi\Database\Connection\PDOConnection $connection, string $previousName, array $previousParameters, ?Psr\Log\LoggerInterface $logger = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$stmt` | `Hi\Database\Connection\PDOStatement` | - |  |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |
| `$previousName` | `string` | - |  |
| `$previousParameters` | `array` | - |  |
| `$logger` | `?Psr\Log\LoggerInterface` | 'null' |  |

**返回**: `void`

#### `getStatement`

```php
public function getStatement(): Hi\Database\Connection\PDOStatement
```

**返回**: `Hi\Database\Connection\PDOStatement`

#### `bindColumn`

```php
public function bindColumn(string|int $column, mixed &$var, int $type = 'PDO::PARAM_STR', int $maxLength = 0, mixed $driverOptions = 'null'): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$column` | `string\|int` | - |  |
| `$var` | `mixed` | - |  |
| `$type` | `int` | 'PDO::PARAM_STR' |  |
| `$maxLength` | `int` | 0 |  |
| `$driverOptions` | `mixed` | 'null' |  |

**返回**: `bool`

#### `bindParam`

```php
public function bindParam(string|int $param, mixed &$var, int $type = 'PDO::PARAM_STR', int $maxLength = 0, mixed $driverOptions = 'null'): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$param` | `string\|int` | - |  |
| `$var` | `mixed` | - |  |
| `$type` | `int` | 'PDO::PARAM_STR' |  |
| `$maxLength` | `int` | 0 |  |
| `$driverOptions` | `mixed` | 'null' |  |

**返回**: `bool`

#### `bindValue`

```php
public function bindValue(string|int $param, mixed $value, int $type = 'PDO::PARAM_STR'): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$param` | `string\|int` | - |  |
| `$value` | `mixed` | - |  |
| `$type` | `int` | 'PDO::PARAM_STR' |  |

**返回**: `bool`

#### `closeCursor`

```php
public function closeCursor(): bool
```

**返回**: `bool`

#### `columnCount`

```php
public function columnCount(): int
```

**返回**: `int`

#### `debugDumpParams`

```php
public function debugDumpParams(): ?bool
```

**返回**: `?bool`

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

#### `execute`

```php
public function execute(?array $params = 'null'): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$params` | `?array` | 'null' |  |

**返回**: `bool`

#### `fetch`

```php
public function fetch(int $mode = 'PDO::FETCH_DEFAULT', int $cursorOrientation = 'PDO::FETCH_ORI_NEXT', int $cursorOffset = 0): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$mode` | `int` | 'PDO::FETCH_DEFAULT' |  |
| `$cursorOrientation` | `int` | 'PDO::FETCH_ORI_NEXT' |  |
| `$cursorOffset` | `int` | 0 |  |

**返回**: `mixed`

#### `fetchAll`

```php
public function fetchAll(int $mode = 'PDO::FETCH_DEFAULT', ...$ctorArgs): array|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$mode` | `int` | 'PDO::FETCH_DEFAULT' |  |
| `...$ctorArgs` | `mixed` | - |  |

**返回**: `array|false`

#### `fetchColumn`

```php
public function fetchColumn(int $column = 0): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$column` | `int` | 0 |  |

**返回**: `mixed`

#### `fetchObject`

```php
public function fetchObject(?string $class = 'stdClass::class', array $ctorArgs = []): object|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$class` | `?string` | 'stdClass::class' |  |
| `$ctorArgs` | `array` | [] |  |

**返回**: `object|false`

#### `getAttribute`

```php
public function getAttribute(int $attribute): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `int` | - |  |

**返回**: `mixed`

#### `getColumnMeta`

```php
public function getColumnMeta(int $column): array|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$column` | `int` | - |  |

**返回**: `array|false`

#### `getIterator`

```php
public function getIterator(): Hi\Database\Connection\Iterator
```

**返回**: `Hi\Database\Connection\Iterator`

#### `nextRowset`

```php
public function nextRowset(): bool
```

**返回**: `bool`

#### `rowCount`

```php
public function rowCount(): int
```

**返回**: `int`

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

#### `setFetchMode`

```php
public function setFetchMode(int $mode, ...$ctorArgs): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$mode` | `int` | - |  |
| `...$ctorArgs` | `mixed` | - |  |

**返回**: `bool`

### Protected 方法

#### `retry`

```php
protected function retry(string $name, array $parameters = []): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$parameters` | `array` | [] |  |

**返回**: `mixed`

