---
fqcn: Hi\Kernel\Console\Metadata\OptionMetadata
type: class
namespace: Hi\Kernel\Console\Metadata
module: Kernel
file: src/Kernel/Console/Metadata/OptionMetadata.php
line: 12
---
# OptionMetadata

**命名空间**: `Hi\Kernel\Console\Metadata`

**类型**: Class

**文件**: `src/Kernel/Console/Metadata/OptionMetadata.php:12`

Option metadata class

Pure data structure for storing command line option metadata

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

