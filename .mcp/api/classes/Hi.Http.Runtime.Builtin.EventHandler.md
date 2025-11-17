---
fqcn: Hi\Http\Runtime\Builtin\EventHandler
type: class
namespace: Hi\Http\Runtime\Builtin
module: Http
file: src/Http/Runtime/Builtin/EventHandler.php
line: 13
---
# EventHandler

**命名空间**: `Hi\Http\Runtime\Builtin`

**类型**: Class

**文件**: `src/Http/Runtime/Builtin/EventHandler.php:13`

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
public function process(): void
```

**返回**: `void`

