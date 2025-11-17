---
fqcn: Hi\Database\Transaction\TransactionIsolationEnum
type: enum
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionIsolationEnum.php
line: 15
---
# TransactionIsolationEnum

**命名空间**: `Hi\Database\Transaction`

**类型**: Enum

**文件**: `src/Database/Transaction/TransactionIsolationEnum.php:15`

事务隔离级别枚举

定义四个标准的 SQL 事务隔离级别，支持不同数据库的 SQL 语句生成。
框架不设置默认隔离级别，保持数据库原生默认行为的透明性。

## 方法

### Public 方法

#### `getMySQLStatement`

```php
public function getMySQLStatement(): string
```

获取 MySQL 设置语句

**返回**: `string`

#### `getPostgreSQLStatement`

```php
public function getPostgreSQLStatement(): string
```

获取 PostgreSQL 设置语句

**返回**: `string`

#### `getSQLServerStatement`

```php
public function getSQLServerStatement(): string
```

获取 SQL Server 设置语句

**返回**: `string`

#### `getClickHouseStatement`

```php
public function getClickHouseStatement(): string
```

获取 ClickHouse 设置语句
注意：ClickHouse 不支持传统事务隔离级别，此方法主要用于兼容性

**返回**: `string`

#### `getStatementForDriver`

```php
public function getStatementForDriver(Hi\Database\Connection\DriverEnum $driver): string
```

根据数据库驱动获取对应的 SQL 语句

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$driver` | `Hi\Database\Connection\DriverEnum` | - |  |

**返回**: `string`

#### `allowsDirtyRead`

```php
public function allowsDirtyRead(): bool
```

检查是否允许脏读

**返回**: `bool`

#### `allowsNonRepeatableRead`

```php
public function allowsNonRepeatableRead(): bool
```

检查是否允许不可重复读

**返回**: `bool`

#### `allowsPhantomRead`

```php
public function allowsPhantomRead(): bool
```

检查是否允许幻读

**返回**: `bool`

#### `getPerformanceLevel`

```php
public function getPerformanceLevel(): int
```

获取隔离级别的性能等级（1-4，数字越小性能越高）

**返回**: `int`

#### `getRecommendedScenarios`

```php
public function getRecommendedScenarios(): array
```

推荐的业务场景

**返回**: `array`

#### `getDatabaseDefault`

**标记**: static

```php
public static function getDatabaseDefault(Hi\Database\Connection\DriverEnum $driver): self
```

获取不同数据库的默认隔离级别

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$driver` | `Hi\Database\Connection\DriverEnum` | - |  |

**返回**: `self`

#### `isTypicalDefault`

```php
public function isTypicalDefault(Hi\Database\Connection\DriverEnum $driver): bool
```

检查隔离级别是否为数据库的典型默认级别

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$driver` | `Hi\Database\Connection\DriverEnum` | - |  |

**返回**: `bool`

#### `getSelectionGuidance`

**标记**: static

```php
public static function getSelectionGuidance(): array
```

获取隔离级别选择建议

**返回**: `array`

#### `getDescription`

```php
public function getDescription(): string
```

获取隔离级别的详细描述

**返回**: `string`

#### `getConcurrencyIssues`

```php
public function getConcurrencyIssues(): array
```

获取可能出现的并发问题

**返回**: `array`

#### `compareStrictness`

```php
public function compareStrictness(self $other): int
```

比较两个隔离级别的严格程度
返回值：-1 表示当前级别更宽松，0 表示相同，1 表示当前级别更严格

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$other` | `self` | - |  |

**返回**: `int`

#### `getAllLevels`

**标记**: static

```php
public static function getAllLevels(): array
```

获取所有可用的隔离级别

**返回**: `array`

