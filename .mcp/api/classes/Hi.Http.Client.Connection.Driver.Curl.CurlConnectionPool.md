---
fqcn: Hi\Http\Client\Connection\Driver\Curl\CurlConnectionPool
type: class
namespace: Hi\Http\Client\Connection\Driver\Curl
module: Http
file: src/Http/Client/Connection/Driver/Curl/CurlConnectionPool.php
line: 10
---
# CurlConnectionPool

**命名空间**: `Hi\Http\Client\Connection\Driver\Curl`

**类型**: Class

**文件**: `src/Http/Client/Connection/Driver/Curl/CurlConnectionPool.php:10`

## 继承关系

**继承**: `Hi\Http\Client\Connection\ClientPool`

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

