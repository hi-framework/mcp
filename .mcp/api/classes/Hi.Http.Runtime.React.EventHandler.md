---
fqcn: Hi\Http\Runtime\React\EventHandler
type: class
namespace: Hi\Http\Runtime\React
module: Http
file: src/Http/Runtime/React/EventHandler.php
line: 15
---
# EventHandler

**命名空间**: `Hi\Http\Runtime\React`

**类型**: Class

**文件**: `src/Http/Runtime/React/EventHandler.php:15`

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
public function process(Psr\Http\Message\ServerRequestInterface $request): Psr\Http\Message\ResponseInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Psr\Http\Message\ServerRequestInterface` | - |  |

**返回**: `Psr\Http\Message\ResponseInterface`

