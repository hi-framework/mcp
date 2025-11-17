---
fqcn: Hi\Redis\RedisProviderInterface
type: interface
namespace: Hi\Redis
module: Redis
file: src/Redis/RedisProviderInterface.php
line: 10
---
# RedisProviderInterface

**命名空间**: `Hi\Redis`

**类型**: Interface

**文件**: `src/Redis/RedisProviderInterface.php:10`

## 方法

### Public 方法

#### `getPool`

```php
public function getPool(string $name): Hi\ConnectionPool\PoolInterface
```

Get a redis connection pool instance by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\PoolInterface`

#### `getConnection`

```php
public function getConnection(string $name): Hi\ConnectionPool\ConnectionInterface
```

Get a redis connection instance by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

