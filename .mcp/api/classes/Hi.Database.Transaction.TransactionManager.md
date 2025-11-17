---
fqcn: Hi\Database\Transaction\TransactionManager
type: class
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionManager.php
line: 22
---
# TransactionManager

**命名空间**: `Hi\Database\Transaction`

**类型**: Class

**文件**: `src/Database/Transaction/TransactionManager.php:22`

**修饰符**: final

事务管理器

提供统一的事务管理入口点，支持注解式、手动式和闭包式事务。
负责协调事务的创建、管理和生命周期，支持嵌套事务和分布式事务。

## 继承关系

**实现**: `Hi\Database\Transaction\TransactionManagerInterface`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `DATABASE_CONTEXT_KEY` | '__hi_database_context' | protected |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$coordinator` | `Hi\Database\Transaction\TransactionCoordinatorInterface` | private readonly | - | 事务协调器，用于分布式事务管理 |
| `$coroutine` | `Hi\Runtime\CoroutineInterface` | private readonly | - |  |
| `$databaseProvider` | `Hi\Database\DatabaseProviderInterface` | private readonly | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | - |  |
| `$microtimer` | `Hi\Database\Transaction\MicrotimerInterface` | private readonly | '...' |  |
| `$metricsCollector` | `?Hi\Database\Transaction\Metrics\TransactionMetricsCollectorInterface` | private readonly | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Runtime\CoroutineInterface $coroutine, Hi\Database\DatabaseProviderInterface $databaseProvider, Psr\Log\LoggerInterface $logger, Hi\Database\Transaction\MicrotimerInterface $microtimer = '...', ?Hi\Database\Transaction\TransactionCoordinatorInterface $coordinator = 'null', ?Hi\Database\Transaction\Metrics\TransactionMetricsCollectorInterface $metricsCollector = 'null')
```

构造函数

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$coroutine` | `Hi\Runtime\CoroutineInterface` | - | 协程接口，用于获取运行时上下文 |
| `$databaseProvider` | `Hi\Database\DatabaseProviderInterface` | - | 数据库提供者，用于获取连接 |
| `$logger` | `Psr\Log\LoggerInterface` | - | 日志记录器，用于记录事务操作 |
| `$microtimer` | `Hi\Database\Transaction\MicrotimerInterface` | '...' | 微秒计时器，用于时间测量 |
| `$coordinator` | `?Hi\Database\Transaction\TransactionCoordinatorInterface` | 'null' |  |
| `$metricsCollector` | `?Hi\Database\Transaction\Metrics\TransactionMetricsCollectorInterface` | 'null' | 指标收集器，用于收集事务指标 |

**返回**: `void`

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
| `$connectionName` | `string` | - | 连接名称 |

**返回**: `void`

#### `beginTransactionWithIsolation`

```php
public function beginTransactionWithIsolation(string $transactionName, Hi\Database\Transaction\TransactionTypeEnum $transactionType, string $connectionName, Hi\Database\Transaction\TransactionIsolationEnum $isolation): void
```

开始带隔离级别的事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionName` | `string` | - | 事务名称 |
| `$transactionType` | `Hi\Database\Transaction\TransactionTypeEnum` | - | 事务类型 |
| `$connectionName` | `string` | - | 连接名称 |
| `$isolation` | `Hi\Database\Transaction\TransactionIsolationEnum` | - | 事务隔离级别 |

**返回**: `void`

#### `releaseConnection`

```php
public function releaseConnection(string $connectionName, ?Hi\Database\Connection\PDOConnection $connection): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - |  |
| `$connection` | `?Hi\Database\Connection\PDOConnection` | - |  |

**返回**: `void`

#### `getConnection`

```php
public function getConnection(string $connectionName): Hi\Database\Connection\PDOConnection
```

获取数据库连接

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接名称 |

**返回**: `Hi\Database\Connection\PDOConnection` - 数据库连接

**抛出异常**:

- `TransactionException` - 当无法获取连接或开始事务失败时

#### `commit`

```php
public function commit(string $connectionName): void
```

提交指定连接的事务（通常用于手动事务模式下）

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接名称 |

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当指定连接没有活跃事务时

#### `commitAll`

```php
public function commitAll(): void
```

提交所有连接的事务

**返回**: `void`

**抛出异常**:

- `TransactionException` - 当没有活跃事务时

#### `rollback`

```php
public function rollback(string $connectionName): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - |  |

**返回**: `void`

#### `rollbackAll`

```php
public function rollbackAll(): void
```

**返回**: `void`

#### `getExplicitIsolationLevel`

```php
public function getExplicitIsolationLevel(string $connectionName): ?Hi\Database\Transaction\TransactionIsolationEnum
```

获取显式设置的隔离级别

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接名称 |

**返回**: `?Hi\Database\Transaction\TransactionIsolationEnum` - 隔离级别，如果未设置则返回 null

#### `getDatabaseDefaultIsolationLevel`

```php
public function getDatabaseDefaultIsolationLevel(string $connectionName): Hi\Database\Transaction\TransactionIsolationEnum
```

获取数据库默认隔离级别

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接名称 |

**返回**: `Hi\Database\Transaction\TransactionIsolationEnum` - 数据库默认隔离级别

### Protected 方法

#### `getCoroutineContext`

```php
protected function getCoroutineContext(): Hi\Runtime\ContextInterface
```

获取协程上下文

**返回**: `Hi\Runtime\ContextInterface` - 协程上下文

**抛出异常**:

- `RuntimeContextException` - 当无法获取运行时上下文时

#### `getTransactionContext`

```php
protected function getTransactionContext(): ?Hi\Database\Transaction\TransactionContextInterface
```

获取事务上下文

**返回**: `?Hi\Database\Transaction\TransactionContextInterface` - 事务上下文，如果不存在则返回 null

#### `getTransactionContextOrFail`

```php
protected function getTransactionContextOrFail(): Hi\Database\Transaction\TransactionContextInterface
```

获取事务上下文或抛出异常

**返回**: `Hi\Database\Transaction\TransactionContextInterface` - 事务上下文

**抛出异常**:

- `TransactionException` - 当事务上下文不存在时

