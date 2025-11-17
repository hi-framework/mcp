---
fqcn: Hi\Database\Transaction\TransactionContextInterface
type: interface
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionContextInterface.php
line: 14
---
# TransactionContextInterface

**命名空间**: `Hi\Database\Transaction`

**类型**: Interface

**文件**: `src/Database/Transaction/TransactionContextInterface.php:14`

事务上下文接口

定义事务上下文管理的核心契约，用于管理事务状态和数据库连接

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

获取事务名称

**返回**: `string` - 事务的唯一标识名称

#### `getType`

```php
public function getType(): Hi\Database\Transaction\TransactionTypeEnum
```

获取事务类型

**返回**: `Hi\Database\Transaction\TransactionTypeEnum` - 事务类型（注解驱动、闭包、手动）

#### `getState`

```php
public function getState(): Hi\Database\Transaction\TransactionStateEnum
```

获取事务状态

**返回**: `Hi\Database\Transaction\TransactionStateEnum` - 当前事务状态（活跃、已提交、已回滚）

#### `setState`

```php
public function setState(Hi\Database\Transaction\TransactionStateEnum $state): void
```

设置事务状态

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$state` | `Hi\Database\Transaction\TransactionStateEnum` | - | 要设置的事务状态 |

**返回**: `void`

#### `getStartTime`

```php
public function getStartTime(): float
```

获取事务开始时间

**返回**: `float` - 事务开始时的微秒时间戳

#### `isTransactionActive`

```php
public function isTransactionActive(): bool
```

检查事务是否活跃

**返回**: `bool` - 是否活跃

#### `markConnectionAsActive`

```php
public function markConnectionAsActive(string $connectionPoolName): void
```

标记连接池为活跃状态

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |

**返回**: `void`

#### `unmarkConnectionAsActive`

```php
public function unmarkConnectionAsActive(string $connectionPoolName): void
```

取消连接池活跃标记

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |

**返回**: `void`

#### `isConnectionActive`

```php
public function isConnectionActive(string $connectionPoolName): bool
```

检查连接池是否活跃

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |

**返回**: `bool` - 是否活跃

#### `addConnection`

```php
public function addConnection(string $connectionPoolName, Hi\Database\Connection\PDOConnection $connection): void
```

添加连接到事务上下文

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接实例 |

**返回**: `void`

#### `getConnection`

```php
public function getConnection(string $connectionPoolName): ?Hi\Database\Connection\PDOConnection
```

获取指定连接池的连接

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |

**返回**: `?Hi\Database\Connection\PDOConnection` - 数据库连接，如果不存在则返回 null

#### `getConnectionCount`

```php
public function getConnectionCount(): int
```

获取连接数量

**返回**: `int` - 连接数量

#### `getAllConnections`

```php
public function getAllConnections(): array
```

获取所有连接

**返回**: `array` - PDOConnection> 所有连接的数组，键为连接池名称

#### `setConnectionIsolation`

```php
public function setConnectionIsolation(string $connectionPoolName, Hi\Database\Transaction\TransactionIsolationEnum $isolationLevel): void
```

设置连接隔离级别

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |
| `$isolationLevel` | `Hi\Database\Transaction\TransactionIsolationEnum` | - | 隔离级别 |

**返回**: `void`

#### `getConnectionIsolation`

```php
public function getConnectionIsolation(string $connectionPoolName): ?Hi\Database\Transaction\TransactionIsolationEnum
```

获取连接隔离级别

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |

**返回**: `?Hi\Database\Transaction\TransactionIsolationEnum` - 隔离级别，未设置则返回 null

#### `getSavepointManager`

```php
public function getSavepointManager(): Hi\Database\Transaction\TransactionSavepoint
```

获取 savepoint 管理器

**返回**: `Hi\Database\Transaction\TransactionSavepoint`

#### `removeConnection`

```php
public function removeConnection(string $connectionPoolName): void
```

从事务上下文中移除连接

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionPoolName` | `string` | - | 连接池名称 |

**返回**: `void`

