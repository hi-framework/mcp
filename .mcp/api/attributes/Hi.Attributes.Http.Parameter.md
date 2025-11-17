---
fqcn: Hi\Attributes\Http\Parameter
type: class
namespace: Hi\Attributes\Http
module: Attributes
file: src/Attributes/Http/Parameter.php
line: 10
---
# Parameter

**命名空间**: `Hi\Attributes\Http`

**类型**: Class

**文件**: `src/Attributes/Http/Parameter.php:10`

**修饰符**: abstract

HTTP request input parameter attribute.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$source` | `string` | public readonly | - |  |
| `$desc` | `string` | public readonly | '' |  |
| `$required` | `bool` | public readonly | 'false' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $source, string $desc = '', bool $required = 'false')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$source` | `string` | - | the source key of the parameter |
| `$desc` | `string` | '' | The description of the parameter |
| `$required` | `bool` | 'false' | Whether the parameter is required |

**返回**: `void`

#### `parseSource`

**标记**: abstract

```php
abstract public function parseSource(): array
```

Parse the source of the parameter.

**返回**: `array` - string, path: string[]}

## Attribute 信息

**目标**: PROPERTY

**可重复**: 否

### 使用示例

```php
#[Parameter(source: '/example')]
class MyClass {}
```

