---
fqcn: Hi\Http\Runtime\Swow\EventHandler
type: class
namespace: Hi\Http\Runtime\Swow
module: Http
file: src/Http/Runtime/Swow/EventHandler.php
line: 15
---
# EventHandler

**命名空间**: `Hi\Http\Runtime\Swow`

**类型**: Class

**文件**: `src/Http/Runtime/Swow/EventHandler.php:15`

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
public function process(Swow\Psr7\Server\ServerConnection $connection): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `Swow\Psr7\Server\ServerConnection` | - |  |

**返回**: `void`

