---
fqcn: Hi\Attributes\Console\Option
type: class
namespace: Hi\Attributes\Console
module: Attributes
file: src/Attributes/Console/Option.php
line: 15
---
# Option

**命名空间**: `Hi\Attributes\Console`

**类型**: Class

**文件**: `src/Attributes/Console/Option.php:15`

Console option attribute

Usage example:
```php
#[Option(name: '--name', shortcut: '-n', desc: 'Name', default: 'default', required: false)]
```

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | public readonly | - |  |
| `$shortcut` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |
| `$default` | `mixed` | public readonly | 'null' |  |
| `$required` | `bool` | public readonly | 'false' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, string $shortcut = '', string $desc = '', mixed $default = 'null', bool $required = 'false')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Option name |
| `$shortcut` | `string` | '' | Short name (single character) |
| `$desc` | `string` | '' | Option description |
| `$default` | `mixed` | 'null' | Default value |
| `$required` | `bool` | 'false' | Whether required |

**返回**: `void`

## Attribute 信息

**目标**: METHOD

**可重复**: 是

### 使用示例

```php
#[Option(name: '/example')]
class MyClass {}
```

