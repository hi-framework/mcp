---
fqcn: Hi\Database\Transaction\TransactionCoordinator
type: class
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionCoordinator.php
line: 18
---
# TransactionCoordinator

**命名空间**: `Hi\Database\Transaction`

**类型**: Class

**文件**: `src/Database/Transaction/TransactionCoordinator.php:18`

事务协调器

负责协调跨多个数据库的分布式事务，提供事务的提交、回滚机制。
支持多数据库连接的事务管理，确保数据一致性。

## 继承关系

**实现**: `Hi\Database\Transaction\TransactionCoordinatorInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | - |  |
| `$metricsCollector` | `?Hi\Database\Transaction\Metrics\TransactionMetricsCollectorInterface` | private readonly | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger, ?Hi\Database\Transaction\Metrics\TransactionMetricsCollectorInterface $metricsCollector = 'null')
```

构造函数

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | - | 日志记录器 |
| `$metricsCollector` | `?Hi\Database\Transaction\Metrics\TransactionMetricsCollectorInterface` | 'null' | 指标收集器 |

**返回**: `void`

#### `commitAll`

```php
public function commitAll(Hi\Database\Transaction\TransactionContextInterface $context): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Database\Transaction\TransactionContextInterface` | - |  |

**返回**: `array`

#### `rollbackAll`

```php
public function rollbackAll(Hi\Database\Transaction\TransactionContextInterface $context): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Database\Transaction\TransactionContextInterface` | - |  |

**返回**: `array`

#### `commitSingle`

```php
public function commitSingle(Hi\Database\Connection\PDOConnection $connection, string $connectionName, string $transactionName): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |
| `$connectionName` | `string` | - |  |
| `$transactionName` | `string` | - |  |

**返回**: `void`

#### `rollbackSingle`

```php
public function rollbackSingle(Hi\Database\Connection\PDOConnection $connection, string $connectionName, string $transactionName): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |
| `$connectionName` | `string` | - |  |
| `$transactionName` | `string` | - |  |

**返回**: `void`

#### `commitNested`

```php
public function commitNested(Hi\Database\Connection\PDOConnection $connection, Hi\Database\Transaction\TransactionSavepoint $savepointManager, string $connectionName, string $transactionName): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |
| `$savepointManager` | `Hi\Database\Transaction\TransactionSavepoint` | - |  |
| `$connectionName` | `string` | - |  |
| `$transactionName` | `string` | - |  |

**返回**: `void`

#### `rollbackNested`

```php
public function rollbackNested(Hi\Database\Connection\PDOConnection $connection, Hi\Database\Transaction\TransactionSavepoint $savepointManager, string $connectionName, string $transactionName): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |
| `$savepointManager` | `Hi\Database\Transaction\TransactionSavepoint` | - |  |
| `$connectionName` | `string` | - |  |
| `$transactionName` | `string` | - |  |

**返回**: `void`

#### `allConnectionsInTransaction`

```php
public function allConnectionsInTransaction(Hi\Database\Transaction\TransactionContextInterface $context): bool
```

检查所有连接是否都在事务中

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Database\Transaction\TransactionContextInterface` | - | 事务上下文 |

**返回**: `bool` - 所有连接是否都在事务中

#### `getTransactionStats`

```php
public function getTransactionStats(Hi\Database\Transaction\TransactionContextInterface $context): array
```

获取事务状态统计

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Database\Transaction\TransactionContextInterface` | - | 事务上下文 |

**返回**: `array`

