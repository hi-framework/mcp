---
fqcn: Hi\Server\ServerInterface
type: interface
namespace: Hi\Server
module: Server
file: src/Server/ServerInterface.php
line: 9
---
# ServerInterface

**命名空间**: `Hi\Server`

**类型**: Interface

**文件**: `src/Server/ServerInterface.php:9`

## 方法

### Public 方法

#### `withHost`

```php
public function withHost(string $host): self
```

Set server host.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$host` | `string` | - |  |

**返回**: `self`

#### `withPort`

```php
public function withPort(int $port): self
```

Set server port.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$port` | `int` | - |  |

**返回**: `self`

#### `start`

```php
public function start(Hi\Http\RouterInterface $router): void
```

Start server.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `void`

#### `addCustomProcess`

```php
public function addCustomProcess(mixed $process): void
```

Add user custom process.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$process` | `mixed` | - |  |

**返回**: `void`

#### `task`

```php
public function task(string $taskClass, mixed $data = 'null'): int|false
```

Deliver Asynchronous Task

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$taskClass` | `string` | - |  |
| `$data` | `mixed` | 'null' |  |

**返回**: `int|false`

