---
fqcn: Hi\Attributes\Http\Route
type: class
namespace: Hi\Attributes\Http
module: Attributes
file: src/Attributes/Http/Route.php
line: 10
---
# Route

**命名空间**: `Hi\Attributes\Http`

**类型**: Class

**文件**: `src/Attributes/Http/Route.php:10`

HTTP route class attribute.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$prefix` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |
| `$middlewares` | `array\|string` | public readonly | [] |  |
| `$auth` | `?bool` | public readonly | 'null' |  |
| `$cors` | `string` | public readonly | '' |  |
| `$owner` | `string` | public readonly | '' |  |
| `$priority` | `int` | public readonly | 0 |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $prefix = '', string $desc = '', array|string $middlewares = [], ?bool $auth = 'null', string $cors = '', string $owner = '', int $priority = 0)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$prefix` | `string` | '' | Routing prefix, all methods of this type will automatically add this prefix to the route |
| `$desc` | `string` | '' | Route description |
| `$middlewares` | `array\|string` | [] | Middlewares |
| `$auth` | `?bool` | 'null' | Need authentication |
| `$cors` | `string` | '' | Route cors policy(middleware alias) |
| `$owner` | `string` | '' | Route owner |
| `$priority` | `int` | 0 | Route priority for sorting, low priority routes will be sorted to the end of the route list |

**返回**: `void`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[Route]
class MyClass {}
```

