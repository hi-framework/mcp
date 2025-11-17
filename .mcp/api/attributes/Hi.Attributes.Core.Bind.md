---
fqcn: Hi\Attributes\Core\Bind
type: class
namespace: Hi\Attributes\Core
module: Attributes
file: src/Attributes/Core/Bind.php
line: 19
---
# Bind

**命名空间**: `Hi\Attributes\Core`

**类型**: Class

**文件**: `src/Attributes/Core/Bind.php:19`

Dependency bind attribute

Usage example:
```php
#[Bind(use: App\Kernel::class)]
interface FooInterface
{
    // ...
}
```

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$use` | `string` | public readonly | - |  |
| `$singleton` | `bool` | public readonly | 'true' |  |
| `$env` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $use, bool $singleton = 'true', string $env = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$use` | `string` | - |  |
| `$singleton` | `bool` | 'true' | Bind singleton or not |
| `$env` | `string` | '' | Can automatically select the implementation class based on the environment |

**返回**: `void`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[Bind(use: '/example')]
class MyClass {}
```

