---
fqcn: Hi\Database\Transaction\Metrics\TransactionMetricsCollectorInterface
type: interface
namespace: Hi\Database\Transaction\Metrics
module: Database
file: src/Database/Transaction/Metrics/TransactionMetricsCollectorInterface.php
line: 26
---
# TransactionMetricsCollectorInterface

**命名空间**: `Hi\Database\Transaction\Metrics`

**类型**: Interface

**文件**: `src/Database/Transaction/Metrics/TransactionMetricsCollectorInterface.php:26`

Transaction Metrics Collector Interface

Defines the contract for collecting comprehensive transaction system metrics including:
- Transaction lifecycle metrics (started, duration, completed by status)
- Transaction type metrics (attribute/closure/manual classification)
- Connection and resource metrics (active connections, multi-database transactions)
- Error and exception metrics (failures, deadlocks, rollback failures)
- Savepoint metrics (creation, rollback usage)
- Performance and resource utilization metrics (memory usage, coordination overhead)

All metrics follow Prometheus naming conventions and include appropriate labels
for detailed monitoring and analysis. Implementations must ensure sub-2% performance
overhead and support both synchronous and asynchronous metric collection modes.

## 方法

### Public 方法

#### `recordTransactionStarted`

```php
public function recordTransactionStarted(string $transactionName, Hi\Database\Transaction\TransactionTypeEnum $type, ?Hi\Database\Transaction\TransactionIsolationEnum $isolation = 'null'): void
```

Record transaction startup metrics

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | Transaction name/identifier |
| `$type` | `Hi\Database\Transaction\TransactionTypeEnum` | - | Transaction type (attribute/closure/manual) |
| `$isolation` | `?Hi\Database\Transaction\TransactionIsolationEnum` | 'null' | Isolation level if explicitly set |

**返回**: `void`

#### `recordTransactionCompleted`

```php
public function recordTransactionCompleted(string $transactionName, Hi\Database\Transaction\TransactionStateEnum $status, float $durationSeconds, int $connectionCount): void
```

Record transaction completion metrics

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | Transaction name/identifier |
| `$status` | `Hi\Database\Transaction\TransactionStateEnum` | - | Final status (committed/rolled_back) |
| `$durationSeconds` | `float` | - | Transaction duration in seconds |
| `$connectionCount` | `int` | - | Number of connections involved |

**返回**: `void`

#### `recordTransactionByType`

```php
public function recordTransactionByType(Hi\Database\Transaction\TransactionTypeEnum $type): void
```

Increment counter for transactions by type

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$type` | `Hi\Database\Transaction\TransactionTypeEnum` | - | Transaction type |

**返回**: `void`

#### `recordExplicitIsolationLevel`

```php
public function recordExplicitIsolationLevel(Hi\Database\Transaction\TransactionIsolationEnum $isolation, string $connectionPool): void
```

Record when isolation level is explicitly set

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$isolation` | `Hi\Database\Transaction\TransactionIsolationEnum` | - | Explicitly set isolation level |
| `$connectionPool` | `string` | - | Connection pool name |

**返回**: `void`

#### `setActiveTransactionConnections`

```php
public function setActiveTransactionConnections(int $count): void
```

Set current active transaction connections gauge

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$count` | `int` | - | Current number of active transaction connections |

**返回**: `void`

#### `recordMultiDatabaseTransaction`

```php
public function recordMultiDatabaseTransaction(array $connectionPools, float $coordinationOverheadSeconds): void
```

Record multi-database transaction metrics

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPools` | `array` | - | Connection pools involved |
| `$coordinationOverheadSeconds` | `float` | - | Time spent in coordination logic |

**返回**: `void`

#### `recordTransactionError`

```php
public function recordTransactionError(string $transactionName, string $errorType, string $phase, string $connectionPool): void
```

Record transaction error metrics

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | Transaction name/identifier |
| `$errorType` | `string` | - | Error classification (e.g., 'connection_failed', 'isolation_error') |
| `$phase` | `string` | - | Transaction phase when error occurred (start/commit/rollback) |
| `$connectionPool` | `string` | - | Connection pool where error occurred |

**返回**: `void`

#### `recordDeadlock`

```php
public function recordDeadlock(string $connectionPool, string $databaseType): void
```

Record deadlock occurrence

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPool` | `string` | - | Connection pool where deadlock occurred |
| `$databaseType` | `string` | - | Database type (mysql/pgsql/clickhouse) |

**返回**: `void`

#### `recordRollbackFailure`

```php
public function recordRollbackFailure(string $transactionName, string $connectionPool, string $errorType): void
```

Record rollback failure

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | Transaction name/identifier |
| `$connectionPool` | `string` | - | Connection pool where rollback failed |
| `$errorType` | `string` | - | Specific rollback error type |

**返回**: `void`

#### `recordSavepointCreated`

```php
public function recordSavepointCreated(string $transactionName, string $connectionPool): void
```

Record savepoint creation

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | Transaction name/identifier |
| `$connectionPool` | `string` | - | Connection pool name |

**返回**: `void`

#### `recordSavepointRollback`

```php
public function recordSavepointRollback(string $transactionName, string $connectionPool): void
```

Record savepoint rollback

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | Transaction name/identifier |
| `$connectionPool` | `string` | - | Connection pool name |

**返回**: `void`

#### `recordTransactionContextMemory`

```php
public function recordTransactionContextMemory(int $bytes): void
```

Record transaction context memory usage

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$bytes` | `int` | - | Memory usage in bytes |

**返回**: `void`

#### `getTransactionMetrics`

```php
public function getTransactionMetrics(): array
```

Get all current transaction metric values

**返回**: `array` - mixed> Current transaction metric values

#### `resetTransactionMetrics`

```php
public function resetTransactionMetrics(): void
```

Reset all transaction metrics

**返回**: `void`

#### `flushTransactionMetrics`

```php
public function flushTransactionMetrics(): void
```

Flush transaction metrics to storage

**返回**: `void`

