---
fqcn: Hi\Http\Client\Connection\Driver\Curl\CurlConnection
type: class
namespace: Hi\Http\Client\Connection\Driver\Curl
module: Http
file: src/Http/Client/Connection/Driver/Curl/CurlConnection.php
line: 16
---
# CurlConnection

**命名空间**: `Hi\Http\Client\Connection\Driver\Curl`

**类型**: Class

**文件**: `src/Http/Client/Connection/Driver/Curl/CurlConnection.php:16`

## 继承关系

**继承**: `Hi\ConnectionPool\Connection`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$createdTime` | `int` | protected readonly | - |  |
| `$curlHandle` | `mixed` | protected | - | cURL资源句柄 |
| `$connectionErrorCodes` | `array` | protected | [] | 用于判断连接是否有效的错误码列表 |
| `$number` | `int` | public readonly | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | protected readonly | - |  |
| `$config` | `Hi\Http\Client\Connection\Driver\Curl\ConnectionConfig` | protected readonly | - |  |
| `$logger` | `?Psr\Log\LoggerInterface` | protected | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $number, Hi\ConnectionPool\PoolInterface $pool, Hi\Http\Client\Connection\Driver\Curl\ConnectionConfig $config, ?Psr\Log\LoggerInterface $logger = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | - |  |
| `$config` | `Hi\Http\Client\Connection\Driver\Curl\ConnectionConfig` | - |  |
| `$logger` | `?Psr\Log\LoggerInterface` | 'null' |  |

**返回**: `void`

#### `connect`

```php
public function connect(): void
```

连接到cURL

**返回**: `void`

#### `disconnect`

```php
public function disconnect(): void
```

断开cURL连接

**返回**: `void`

#### `request`

```php
public function request(Psr\Http\Message\RequestInterface $request): Psr\Http\Message\ResponseInterface
```

发送HTTP请求，包含重连逻辑

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Psr\Http\Message\RequestInterface` | - | PSR-7请求接口 |

**返回**: `Psr\Http\Message\ResponseInterface` - PSR-7响应接口

**抛出异常**:

- `\RuntimeException` - 当请求失败时抛出

#### `ping`

```php
public function ping(): bool
```

执行一个简单的请求来检查连接是否有效

**返回**: `bool` - 连接是否有效

### Protected 方法

#### `parseResponseHeaders`

```php
protected function parseResponseHeaders(string $rawHeaders): array
```

解析响应头

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$rawHeaders` | `string` | - | 原始响应头 |

**返回**: `array` - 解析后的响应头

#### `createResponse`

```php
protected function createResponse(int $statusCode, array $headers, string $body, int $attempts): Psr\Http\Message\ResponseInterface
```

创建PSR-7响应对象

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$statusCode` | `int` | - | HTTP状态码 |
| `$headers` | `array` | - | 响应头 |
| `$body` | `string` | - | 响应体 |
| `$attempts` | `int` | - | 尝试次数 |

**返回**: `Psr\Http\Message\ResponseInterface`

#### `isConnectionError`

```php
protected function isConnectionError(int $errorCode): bool
```

检查是否是连接相关的错误

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$errorCode` | `int` | - | cURL错误码 |

**返回**: `bool` - 如果是连接相关错误则返回true

