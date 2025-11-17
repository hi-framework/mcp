---
fqcn: Hi\Attributes\Http\Input
type: class
namespace: Hi\Attributes\Http
module: Attributes
file: src/Attributes/Http/Input.php
line: 10
---
# Input

**命名空间**: `Hi\Attributes\Http`

**类型**: Class

**文件**: `src/Attributes/Http/Input.php:10`

HTTP request input class attribute.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$validate` | `bool` | public readonly | 'false' |  |
| `$type` | `string` | public readonly | 'json' |  |
| `$desc` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(bool $validate = 'false', string $type = 'json', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$validate` | `bool` | 'false' | Auto validate input data |
| `$type` | `string` | 'json' | Support type see Hi\Http\Message\Decoder::decode() |
| `$desc` | `string` | '' | Input class description |

**返回**: `void`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[Input]
class MyClass {}
```

