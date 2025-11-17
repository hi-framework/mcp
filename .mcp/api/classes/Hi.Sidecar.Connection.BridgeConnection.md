---
fqcn: Hi\Sidecar\Connection\BridgeConnection
type: class
namespace: Hi\Sidecar\Connection
module: Sidecar
file: src/Sidecar/Connection/BridgeConnection.php
line: 15
---
# BridgeConnection

**命名空间**: `Hi\Sidecar\Connection`

**类型**: Class

**文件**: `src/Sidecar/Connection/BridgeConnection.php:15`

## 继承关系

**继承**: `Hi\ConnectionPool\Connection`

**实现**: `Hi\ConnectionPool\ConnectionInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$createdTime` | `int` | protected readonly | - |  |
| `$rpc` | `Spiral\Goridge\RPC\RPC` | protected | - |  |
| `$relay` | `Spiral\Goridge\SocketRelay` | protected | - |  |
| `$number` | `int` | public readonly | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | protected readonly | - |  |
| `$host` | `string` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $number, Hi\ConnectionPool\PoolInterface $pool, string $host)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |
| `$pool` | `Hi\ConnectionPool\PoolInterface` | - |  |
| `$host` | `string` | - |  |

**返回**: `void`

#### `connect`

```php
public function connect(): void
```

**返回**: `void`

#### `disconnect`

```php
public function disconnect(): void
```

**返回**: `void`

#### `call`

```php
public function call(string $method, mixed $payload, mixed $options = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$payload` | `mixed` | - |  |
| `$options` | `mixed` | 'null' |  |

**返回**: `mixed`

