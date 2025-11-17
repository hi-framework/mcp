---
fqcn: Hi\Database\Transaction\TransactionManagerInterface
type: interface
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionManagerInterface.php
line: 14
---
# TransactionManagerInterface

**命名空间**: `Hi\Database\Transaction`

**类型**: Interface

**文件**: `src/Database/Transaction/TransactionManagerInterface.php:14`

事务管理器接口

定义事务管理的核心契约，提供统一的事务管理入口点

## 方法

### Public 方法

#### `activate`

```php
public function activate(string $transactionName, Hi\Database\Transaction\TransactionTypeEnum $transactionType): Hi\Database\Transaction\TransactionContextInterface
```

激活事务上下文

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | 事务名称 |
| `$transactionType` | `Hi\Database\Transaction\TransactionTypeEnum` | - | 事务类型 |

**返回**: `Hi\Database\Transaction\TransactionContextInterface` - 事务上下文

#### `getConnection`

```php
public function getConnection(string $connectionName): Hi\Database\Connection\PDOConnection
```

获取数据库连接

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接池名称 |

**返回**: `Hi\Database\Connection\PDOConnection` - 数据库连接

**抛出异常**:

- `TransactionException` - 当无法获取连接时抛出

#### `releaseConnection`

```php
public function releaseConnection(string $connectionName, ?Hi\Database\Connection\PDOConnection $connection): void
```

释放数据库连接

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接池名称 |
| `$connection` | `?Hi\Database\Connection\PDOConnection` | - | 数据库连接 |

**返回**: `void`

#### `beginTransaction`

```php
public function beginTransaction(string $transactionName, Hi\Database\Transaction\TransactionTypeEnum $transactionType, string $connectionName): void
```

开始事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | 事务名称 |
| `$transactionType` | `Hi\Database\Transaction\TransactionTypeEnum` | - | 事务类型 |
| `$connectionName` | `string` | - | 连接池名称 |

**返回**: `void`

#### `beginTransactionWithIsolation`

```php
public function beginTransactionWithIsolation(string $transactionName, Hi\Database\Transaction\TransactionTypeEnum $transactionType, string $connectionName, Hi\Database\Transaction\TransactionIsolationEnum $isolation): void
```

开始事务并设置隔离级别

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | 事务名称 |
| `$transactionType` | `Hi\Database\Transaction\TransactionTypeEnum` | - | 事务类型 |
| `$connectionName` | `string` | - | 连接池名称 |
| `$isolation` | `Hi\Database\Transaction\TransactionIsolationEnum` | - | 隔离级别 |

**返回**: `void`

#### `commit`

```php
public function commit(string $connectionName): void
```

提交指定连接的事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接池名称 |

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当指定连接没有活跃事务时抛出

#### `rollback`

```php
public function rollback(string $connectionName): void
```

回滚指定连接的事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接池名称 |

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当指定连接没有活跃事务时抛出

#### `commitAll`

```php
public function commitAll(): void
```

提交所有连接的事务

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当没有活跃事务时抛出

#### `rollbackAll`

```php
public function rollbackAll(): void
```

回滚所有连接的事务

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当没有活跃事务时抛出

