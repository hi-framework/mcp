---
fqcn: Hi\Database\Transaction\TransactionCoordinatorInterface
type: interface
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionCoordinatorInterface.php
line: 15
---
# TransactionCoordinatorInterface

**命名空间**: `Hi\Database\Transaction`

**类型**: Interface

**文件**: `src/Database/Transaction/TransactionCoordinatorInterface.php:15`

事务协调器接口

定义分布式事务协调的核心契约，负责协调跨多个数据库的事务操作。
统一处理根事务、嵌套事务和多连接事务的提交和回滚操作。

## 方法

### Public 方法

#### `commitAll`

```php
public function commitAll(Hi\Database\Transaction\TransactionContextInterface $context): array
```

提交所有参与的数据库事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Database\Transaction\TransactionContextInterface` | - | 事务上下文 |

**返回**: `array`

#### `rollbackAll`

```php
public function rollbackAll(Hi\Database\Transaction\TransactionContextInterface $context): array
```

回滚所有参与的数据库事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Database\Transaction\TransactionContextInterface` | - | 事务上下文 |

**返回**: `array`

#### `commitSingle`

```php
public function commitSingle(Hi\Database\Connection\PDOConnection $connection, string $connectionName, string $transactionName): void
```

提交单个连接的根事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接 |
| `$connectionName` | `string` | - | 连接名称 |
| `$transactionName` | `string` | - | 事务名称 |

**返回**: `void`

#### `rollbackSingle`

```php
public function rollbackSingle(Hi\Database\Connection\PDOConnection $connection, string $connectionName, string $transactionName): void
```

回滚单个连接的根事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接 |
| `$connectionName` | `string` | - | 连接名称 |
| `$transactionName` | `string` | - | 事务名称 |

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当回滚失败时

#### `commitNested`

```php
public function commitNested(Hi\Database\Connection\PDOConnection $connection, Hi\Database\Transaction\TransactionSavepoint $savepointManager, string $connectionName, string $transactionName): void
```

提交嵌套事务的 savepoint

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接 |
| `$savepointManager` | `Hi\Database\Transaction\TransactionSavepoint` | - | savepoint 管理器 |
| `$connectionName` | `string` | - | 连接名称 |
| `$transactionName` | `string` | - | 事务名称 |

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当提交嵌套事务的 savepoint 失败时

#### `rollbackNested`

```php
public function rollbackNested(Hi\Database\Connection\PDOConnection $connection, Hi\Database\Transaction\TransactionSavepoint $savepointManager, string $connectionName, string $transactionName): void
```

回滚嵌套事务的 savepoint

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接 |
| `$savepointManager` | `Hi\Database\Transaction\TransactionSavepoint` | - | savepoint 管理器 |
| `$connectionName` | `string` | - | 连接名称 |
| `$transactionName` | `string` | - | 事务名称 |

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当 savepoint 操作失败时

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

