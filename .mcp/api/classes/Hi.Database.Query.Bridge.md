---
fqcn: Hi\Database\Query\Bridge
type: class
namespace: Hi\Database\Query
module: Database
file: src/Database/Query/Bridge.php
line: 14
---
# Bridge

**命名空间**: `Hi\Database\Query`

**类型**: Class

**文件**: `src/Database/Query/Bridge.php:14`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$poolName` | `string` | private | - |  |
| `$pdo` | `?Hi\Database\Connection\PDOConnection` | private | 'null' |  |
| `$transactionManager` | `Hi\Database\Transaction\TransactionManagerInterface` | private readonly | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | - |  |
| `$metricCollector` | `?Hi\Database\Query\MetricCollectorInterface` | private readonly | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Database\Transaction\TransactionManagerInterface $transactionManager, Psr\Log\LoggerInterface $logger, ?Hi\Database\Query\MetricCollectorInterface $metricCollector = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionManager` | `Hi\Database\Transaction\TransactionManagerInterface` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |
| `$metricCollector` | `?Hi\Database\Query\MetricCollectorInterface` | 'null' |  |

**返回**: `void`

#### `__destruct`

```php
public function __destruct()
```

**返回**: `void`

#### `setPoolName`

```php
public function setPoolName(string $poolName): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$poolName` | `string` | - |  |

**返回**: `self`

#### `execute`

```php
public function execute(string $sql, array $bind = []): Hi\Database\Connection\PDOStatementProxy
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |
| `$bind` | `array` | [] |  |

**返回**: `Hi\Database\Connection\PDOStatementProxy`

#### `lastId`

```php
public function lastId(string $sql, array $bind = []): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |
| `$bind` | `array` | [] |  |

**返回**: `string`

#### `rowCount`

```php
public function rowCount(string $sql, array $bind = []): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |
| `$bind` | `array` | [] |  |

**返回**: `int`

#### `fetch`

```php
public function fetch(string $sql, array $bind = [], int $mode = 'PDO::FETCH_ASSOC'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |
| `$bind` | `array` | [] |  |
| `$mode` | `int` | 'PDO::FETCH_ASSOC' |  |

**返回**: `mixed`

#### `fetchAll`

```php
public function fetchAll(string $sql, array $bind = [], int $mode = 'PDO::FETCH_ASSOC'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |
| `$bind` | `array` | [] |  |
| `$mode` | `int` | 'PDO::FETCH_ASSOC' |  |

**返回**: `mixed`

### Protected 方法

#### `unformatted`

```php
protected function unformatted(string $sql): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |

**返回**: `string`

#### `prepare`

```php
protected function prepare(string $sql): Hi\Database\Connection\PDOStatementProxy
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |

**返回**: `Hi\Database\Connection\PDOStatementProxy`

