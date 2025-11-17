---
fqcn: Hi\Http\Middleware\ClosureWarpMiddleware
type: class
namespace: Hi\Http\Middleware
module: Http
file: src/Http/Middleware/ClosureWarpMiddleware.php
line: 10
---
# ClosureWarpMiddleware

**命名空间**: `Hi\Http\Middleware`

**类型**: Class

**文件**: `src/Http/Middleware/ClosureWarpMiddleware.php:10`

## 继承关系

**实现**: `Hi\Http\Middleware\MiddlewareInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$closure` | `mixed` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(callable $closure)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$closure` | `callable` | - |  |

**返回**: `void`

#### `handle`

```php
public function handle(Hi\Http\Context $context, callable $next): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Http\Context` | - |  |
| `$next` | `callable` | - |  |

**返回**: `mixed`

