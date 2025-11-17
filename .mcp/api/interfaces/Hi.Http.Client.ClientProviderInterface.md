---
fqcn: Hi\Http\Client\ClientProviderInterface
type: interface
namespace: Hi\Http\Client
module: Http
file: src/Http/Client/ClientProviderInterface.php
line: 10
---
# ClientProviderInterface

**命名空间**: `Hi\Http\Client`

**类型**: Interface

**文件**: `src/Http/Client/ClientProviderInterface.php:10`

## 方法

### Public 方法

#### `getPool`

```php
public function getPool(string $name): Hi\ConnectionPool\PoolInterface
```

Get a http client connection pool instance by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\PoolInterface`

#### `getConnection`

```php
public function getConnection(string $name): Hi\ConnectionPool\ConnectionInterface
```

Get a http client instance by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

