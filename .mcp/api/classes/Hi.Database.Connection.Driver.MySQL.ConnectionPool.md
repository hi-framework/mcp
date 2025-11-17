---
fqcn: Hi\Database\Connection\Driver\MySQL\ConnectionPool
type: class
namespace: Hi\Database\Connection\Driver\MySQL
module: Database
file: src/Database/Connection/Driver/MySQL/ConnectionPool.php
line: 12
---
# ConnectionPool

**命名空间**: `Hi\Database\Connection\Driver\MySQL`

**类型**: Class

**文件**: `src/Database/Connection/Driver/MySQL/ConnectionPool.php:12`

## 继承关系

**继承**: `Hi\Database\Connection\PDOConnectionPool`

## 方法

### Protected 方法

#### `initConfig`

```php
protected function initConfig(array $config): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `void`

#### `createConnection`

```php
protected function createConnection(int $number): Hi\ConnectionPool\ConnectionInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

