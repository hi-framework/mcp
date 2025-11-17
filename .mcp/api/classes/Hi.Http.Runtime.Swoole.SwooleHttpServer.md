---
fqcn: Hi\Http\Runtime\Swoole\SwooleHttpServer
type: class
namespace: Hi\Http\Runtime\Swoole
module: Http
file: src/Http/Runtime/Swoole/SwooleHttpServer.php
line: 12
---
# SwooleHttpServer

**命名空间**: `Hi\Http\Runtime\Swoole`

**类型**: Class

**文件**: `src/Http/Runtime/Swoole/SwooleHttpServer.php:12`

## 继承关系

**继承**: `Hi\Server\Server`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$swoole` | `Swoole\Http\Server` | protected | - |  |

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

#### `task`

```php
public function task(string $taskClass, $data = 'null'): int|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$taskClass` | `string` | - |  |
| `$data` | `mixed` | 'null' |  |

**返回**: `int|false`

### Protected 方法

#### `configure`

```php
protected function configure(Hi\Http\RouterInterface $router): Swoole\Http\Server
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `Swoole\Http\Server`

#### `createServer`

```php
protected function createServer(): Swoole\Http\Server
```

**返回**: `Swoole\Http\Server`

#### `createEventHandler`

```php
protected function createEventHandler(Hi\Http\RouterInterface $router): Hi\Http\Runtime\Swoole\EventHandler
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `Hi\Http\Runtime\Swoole\EventHandler`

#### `isExtensionLoaded`

```php
protected function isExtensionLoaded(): bool
```

**返回**: `bool`

