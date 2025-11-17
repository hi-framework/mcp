---
fqcn: Hi\Attributes\Http\Middleware
type: class
namespace: Hi\Attributes\Http
module: Attributes
file: src/Attributes/Http/Middleware.php
line: 10
---
# Middleware

**命名空间**: `Hi\Attributes\Http`

**类型**: Class

**文件**: `src/Attributes/Http/Middleware.php:10`

HTTP middleware class attribute.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$alias` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $alias = '', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$alias` | `string` | '' | Alias of the middleware |
| `$desc` | `string` | '' | Description of the middleware |

**返回**: `void`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[Middleware]
class MyClass {}
```

