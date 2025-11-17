---
fqcn: Hi\Http\Client\Connection\Driver\Swoole\SwooleConnection
type: class
namespace: Hi\Http\Client\Connection\Driver\Swoole
module: Http
file: src/Http/Client/Connection/Driver/Swoole/SwooleConnection.php
line: 17
---
# SwooleConnection

**命名空间**: `Hi\Http\Client\Connection\Driver\Swoole`

**类型**: Class

**文件**: `src/Http/Client/Connection/Driver/Swoole/SwooleConnection.php:17`

## 继承关系

**继承**: `Hi\ConnectionPool\Connection`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$createdTime` | `int` | protected readonly | - |  |
| `$client` | `?Swoole\Coroutine\Http\Client` | protected | 'null' | Swoole客户端实例 |
| `$number` | `int` | public readonly | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | protected readonly | - |  |
| `$config` | `Hi\Http\Client\Connection\Driver\Swoole\ConnectionConfig` | protected readonly | - |  |
| `$logger` | `?Psr\Log\LoggerInterface` | protected | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $number, Hi\ConnectionPool\PoolInterface $pool, Hi\Http\Client\Connection\Driver\Swoole\ConnectionConfig $config, ?Psr\Log\LoggerInterface $logger = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | - |  |
| `$config` | `Hi\Http\Client\Connection\Driver\Swoole\ConnectionConfig` | - |  |
| `$logger` | `?Psr\Log\LoggerInterface` | 'null' |  |

**返回**: `void`

#### `connect`

```php
public function connect(): void
```

连接到Swoole HTTP客户端

**返回**: `void`

#### `disconnect`

```php
public function disconnect(): void
```

断开Swoole HTTP客户端连接

**返回**: `void`

#### `request`

```php
public function request(Psr\Http\Message\RequestInterface $request): Psr\Http\Message\ResponseInterface
```

发送HTTP请求

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

#### `cloneClient`

```php
public function cloneClient(Swoole\Coroutine\Http\Client $client): Swoole\Coroutine\Http\Client
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$client` | `Swoole\Coroutine\Http\Client` | - |  |

**返回**: `Swoole\Coroutine\Http\Client`

#### `getClient`

```php
public function getClient(): ?Swoole\Coroutine\Http\Client
```

**返回**: `?Swoole\Coroutine\Http\Client`

### Protected 方法

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

