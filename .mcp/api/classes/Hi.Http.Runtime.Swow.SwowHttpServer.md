---
fqcn: Hi\Http\Runtime\Swow\SwowHttpServer
type: class
namespace: Hi\Http\Runtime\Swow
module: Http
file: src/Http/Runtime/Swow/SwowHttpServer.php
line: 16
---
# SwowHttpServer

**命名空间**: `Hi\Http\Runtime\Swow`

**类型**: Class

**文件**: `src/Http/Runtime/Swow/SwowHttpServer.php:16`

## 继承关系

**继承**: `Hi\Server\Server`

## 方法

### Public 方法

#### `start`

```php
public function start(Hi\Http\RouterInterface $router): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `void`

### Protected 方法

#### `loop`

```php
protected function loop(Swow\Psr7\Server\Server $server, Hi\Http\RouterInterface $router): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$server` | `Swow\Psr7\Server\Server` | - |  |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `void`

#### `createServer`

```php
protected function createServer(): Swow\Psr7\Server\Server
```

**返回**: `Swow\Psr7\Server\Server`

#### `createEventHandler`

```php
protected function createEventHandler(Hi\Http\RouterInterface $router): Hi\Http\Runtime\Swow\EventHandler
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `Hi\Http\Runtime\Swow\EventHandler`

#### `isExtensionLoaded`

```php
protected function isExtensionLoaded(): bool
```

**返回**: `bool`

