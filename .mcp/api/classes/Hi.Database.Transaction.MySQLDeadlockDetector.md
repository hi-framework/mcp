---
fqcn: Hi\Database\Transaction\MySQLDeadlockDetector
type: class
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/MySQLDeadlockDetector.php
line: 12
---
# MySQLDeadlockDetector

**命名空间**: `Hi\Database\Transaction`

**类型**: Class

**文件**: `src/Database/Transaction/MySQLDeadlockDetector.php:12`

MySQL 死锁检测器实现

## 继承关系

**实现**: `Hi\Database\Transaction\DeadlockDetectorInterface`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `DEADLOCK_ERROR_CODE` | 1213 | private |  |
| `LOCK_WAIT_TIMEOUT_ERROR_CODE` | 1205 | private |  |
| `CONNECTION_LOST_ERROR_CODE` | 2006 | private |  |
| `SERVER_GONE_AWAY_ERROR_CODE` | 2013 | private |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$retryPolicy` | `Hi\Database\Transaction\RetryPolicy` | private readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Database\Transaction\RetryPolicy $retryPolicy = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$retryPolicy` | `Hi\Database\Transaction\RetryPolicy` | '...' | 重试策略 |

**返回**: `void`

#### `isDeadlock`

```php
public function isDeadlock(Hi\Database\Transaction\Throwable $exception): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$exception` | `Hi\Database\Transaction\Throwable` | - |  |

**返回**: `bool`

#### `hasLockWaitTimeout`

```php
public function hasLockWaitTimeout(Hi\Database\Connection\PDOConnection $connection, int $timeoutSeconds = 30): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |
| `$timeoutSeconds` | `int` | 30 |  |

**返回**: `bool`

#### `getLockInfo`

```php
public function getLockInfo(Hi\Database\Connection\PDOConnection $connection): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |

**返回**: `array`

#### `analyzeDeadlock`

```php
public function analyzeDeadlock(Hi\Database\Connection\PDOConnection $connection): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Hi\Database\Connection\PDOConnection` | - |  |

**返回**: `array`

#### `canRetry`

```php
public function canRetry(Hi\Database\Transaction\Throwable $exception, int $attemptCount): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$exception` | `Hi\Database\Transaction\Throwable` | - |  |
| `$attemptCount` | `int` | - |  |

**返回**: `bool`

