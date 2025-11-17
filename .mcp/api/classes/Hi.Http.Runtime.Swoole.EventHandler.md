---
fqcn: Hi\Http\Runtime\Swoole\EventHandler
type: class
namespace: Hi\Http\Runtime\Swoole
module: Http
file: src/Http/Runtime/Swoole/EventHandler.php
line: 19
---
# EventHandler

**命名空间**: `Hi\Http\Runtime\Swoole`

**类型**: Class

**文件**: `src/Http/Runtime/Swoole/EventHandler.php:19`

## 继承关系

**实现**: `Hi\Http\Runtime\EventHandlerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | protected | - |  |
| `$exceptionHandler` | `?Hi\Exception\ExceptionHandlerInterface` | protected | 'null' |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Http\RouterInterface $router, ?Hi\Exception\ExceptionHandlerInterface $exceptionHandler = 'null', Psr\Log\LoggerInterface $logger = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |
| `$exceptionHandler` | `?Hi\Exception\ExceptionHandlerInterface` | 'null' |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |

**返回**: `void`

#### `workerStart`

```php
public function workerStart(Swoole\Server $server): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$server` | `Swoole\Server` | - |  |

**返回**: `void`

#### `process`

```php
public function process(Swoole\Http\Request $request, Swoole\Http\Response $response): void
```

Http 请求回调 handle.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Swoole\Http\Request` | - |  |
| `$response` | `Swoole\Http\Response` | - |  |

**返回**: `void`

#### `task`

```php
public function task(Swoole\Server $server, Swoole\Server\Task $task): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$server` | `Swoole\Server` | - |  |
| `$task` | `Swoole\Server\Task` | - |  |

**返回**: `mixed`

