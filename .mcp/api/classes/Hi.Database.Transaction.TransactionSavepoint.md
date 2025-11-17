---
fqcn: Hi\Database\Transaction\TransactionSavepoint
type: class
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionSavepoint.php
line: 7
---
# TransactionSavepoint

**命名空间**: `Hi\Database\Transaction`

**类型**: Class

**文件**: `src/Database/Transaction/TransactionSavepoint.php:7`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$nestingDepth` | `int` | private | 0 |  |
| `$pendingSavepoints` | `array` | private | [] |  |
| `$allSavepoints` | `array` | private | [] | 所有已创建的 savepoint 记录 理想情况下所有嵌套事务会按照 savepoints 的创建倒序依次 commit 或者 rollback |
| `$connectionSavepoints` | `array` | private | [] | 连接级别的 savepoint 记录 理想情况下每个连接的嵌套事务会按照 savepoints 的创建倒序依次 commit 或者 rollback |

## 方法

### Public 方法

#### `isRootTransaction`

```php
public function isRootTransaction(): bool
```

是否为根事务

**返回**: `bool`

#### `isRootTransactionForConnection`

```php
public function isRootTransactionForConnection(string $connectionName): bool
```

指定连接是否为根事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接池名称 |

**返回**: `bool` - 是否为根事务

#### `markPendingSavepoint`

```php
public function markPendingSavepoint(string $connectionName, int $nestingLevel): void
```

标记连接在当前层级需要创建 savepoint

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接池名称 |
| `$nestingLevel` | `int` | - | 当前嵌套事务深度 |

**返回**: `void`

#### `popPendingSavepoint`

```php
public function popPendingSavepoint(string $connectionName): ?int
```

获取并移除待创建的 savepoint 标记
因为每个 beginTransaction 只创建一个 savepoint，所以获取后需要移除标记

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - | 连接池名称 |

**返回**: `?int` - 嵌套层级，如果不存在则返回 null

#### `enterNestedTransaction`

```php
public function enterNestedTransaction(): void
```

进入嵌套事务

**返回**: `void`

#### `exitNestedTransaction`

```php
public function exitNestedTransaction(): void
```

退出嵌套事务

**返回**: `void`

#### `getNestingDepth`

```php
public function getNestingDepth(): int
```

获取嵌套深度

**返回**: `int`

#### `addSavepoint`

```php
public function addSavepoint(string $connectionName, string $savepointName): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - |  |
| `$savepointName` | `string` | - |  |

**返回**: `void`

#### `popConnectionSavepoint`

```php
public function popConnectionSavepoint(string $connectionName): ?string
```

弹出指定连接的最后一个 savepoint

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - |  |

**返回**: `?string`

