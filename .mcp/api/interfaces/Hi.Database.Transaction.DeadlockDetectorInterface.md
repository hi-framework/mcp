---
fqcn: Hi\Database\Transaction\DeadlockDetectorInterface
type: interface
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/DeadlockDetectorInterface.php
line: 14
---
# DeadlockDetectorInterface

**命名空间**: `Hi\Database\Transaction`

**类型**: Interface

**文件**: `src/Database/Transaction/DeadlockDetectorInterface.php:14`

死锁检测器接口

提供死锁检测和相关的事务状态分析功能

## 方法

### Public 方法

#### `isDeadlock`

```php
public function isDeadlock(Hi\Database\Transaction\Throwable $exception): bool
```

检测给定的异常是否表示死锁

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$exception` | `Hi\Database\Transaction\Throwable` | - | 待检测的异常 |

**返回**: `bool` - 是否为死锁异常

#### `hasLockWaitTimeout`

```php
public function hasLockWaitTimeout(Hi\Database\Connection\PDOConnection $connection, int $timeoutSeconds = 30): bool
```

检测连接上是否存在长时间的锁等待

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接 |
| `$timeoutSeconds` | `int` | 30 | 超时秒数，默认30秒 |

**返回**: `bool` - 是否存在锁等待超时

#### `getLockInfo`

```php
public function getLockInfo(Hi\Database\Connection\PDOConnection $connection): array
```

获取连接上当前的锁信息

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接 |

**返回**: `array` - array, wait_locks: array, transactions: array}

#### `analyzeDeadlock`

```php
public function analyzeDeadlock(Hi\Database\Connection\PDOConnection $connection): array
```

分析死锁详情

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - | 数据库连接 |

**返回**: `array` - string, involved_transactions: array}

#### `canRetry`

```php
public function canRetry(Hi\Database\Transaction\Throwable $exception, int $attemptCount): bool
```

检查事务是否可以安全重试

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$exception` | `Hi\Database\Transaction\Throwable` | - | 发生的异常 |
| `$attemptCount` | `int` | - | 已尝试次数 |

**返回**: `bool` - 是否可以重试

