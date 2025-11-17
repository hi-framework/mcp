---
fqcn: Hi\Http\Runtime\Workerman\EventHandler
type: class
namespace: Hi\Http\Runtime\Workerman
module: Http
file: src/Http/Runtime/Workerman/EventHandler.php
line: 16
---
# EventHandler

**命名空间**: `Hi\Http\Runtime\Workerman`

**类型**: Class

**文件**: `src/Http/Runtime/Workerman/EventHandler.php:16`

## 继承关系

**实现**: `Hi\Http\Runtime\EventHandlerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Http\RouterInterface $router)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `void`

#### `process`

```php
public function process(Workerman\Connection\TcpConnection $connection, Workerman\Protocols\Http\Request $request): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Workerman\Connection\TcpConnection` | - |  |
| `$request` | `Workerman\Protocols\Http\Request` | - |  |

**返回**: `void`

