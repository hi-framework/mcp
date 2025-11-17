---
fqcn: Hi\Attributes\Database\Transaction
type: class
namespace: Hi\Attributes\Database
module: Attributes
file: src/Attributes/Database/Transaction.php
line: 13
---
# Transaction

**命名空间**: `Hi\Attributes\Database`

**类型**: Class

**文件**: `src/Attributes/Database/Transaction.php:13`

**修饰符**: final

Transaction 属性

用于声明式事务管理的属性标记
可以应用在方法上，让方法自动在事务中执行

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | public readonly | - |  |
| `$enable` | `bool` | public readonly | 'true' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, bool $enable = 'true')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$enable` | `bool` | 'true' |  |

**返回**: `void`

## Attribute 信息

**目标**: METHOD

**可重复**: 否

### 使用示例

```php
#[Transaction(name: '/example')]
class MyClass {}
```

