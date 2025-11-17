---
fqcn: Hi\Http\Runtime\React\ReactHttpServer
type: class
namespace: Hi\Http\Runtime\React
module: Http
file: src/Http/Runtime/React/ReactHttpServer.php
line: 16
---
# ReactHttpServer

**命名空间**: `Hi\Http\Runtime\React`

**类型**: Class

**文件**: `src/Http/Runtime/React/ReactHttpServer.php:16`

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

#### `createEventHandler`

```php
protected function createEventHandler(Hi\Http\RouterInterface $router): Hi\Http\Runtime\React\EventHandler
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `Hi\Http\Runtime\React\EventHandler`

#### `run`

```php
protected function run(Hi\Http\RouterInterface $router): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `void`

