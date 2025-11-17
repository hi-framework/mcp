---
fqcn: Hi\Database\DatabaseProviderInterface
type: interface
namespace: Hi\Database
module: Database
file: src/Database/DatabaseProviderInterface.php
line: 10
---
# DatabaseProviderInterface

**命名空间**: `Hi\Database`

**类型**: Interface

**文件**: `src/Database/DatabaseProviderInterface.php:10`

## 方法

### Public 方法

#### `getPool`

```php
public function getPool(string $name): Hi\ConnectionPool\PoolInterface
```

Get a database connection pool instance by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\PoolInterface`

#### `getConnection`

```php
public function getConnection(string $name): Hi\ConnectionPool\ConnectionInterface
```

Get a database connection instance by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

