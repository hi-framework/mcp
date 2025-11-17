---
fqcn: Hi\Attributes\Console\Action
type: class
namespace: Hi\Attributes\Console
module: Attributes
file: src/Attributes/Console/Action.php
line: 19
---
# Action

**命名空间**: `Hi\Attributes\Console`

**类型**: Class

**文件**: `src/Attributes/Console/Action.php:19`

Console action attribute

Usage example:
```php
#[Action(name: 'hello', desc: 'Hello world')]
public function hello(): void
{
    // ...
}
```

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | public readonly | - |  |
| `$schedule` | `string` | public readonly | '' |  |
| `$coroutine` | `bool` | public readonly | 'true' |  |
| `$replicas` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |
| `$owner` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, string $schedule = '', bool $coroutine = 'true', string $replicas = '', string $desc = '', string $owner = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Name of action |
| `$schedule` | `string` | '' | Cronjob schedule |
| `$coroutine` | `bool` | 'true' | Run in coroutine |
| `$replicas` | `string` | '' | Generate corresponding deployment replicas count, empty means not generate |
| `$desc` | `string` | '' | Description |
| `$owner` | `string` | '' |  |

**返回**: `void`

## Attribute 信息

**目标**: METHOD

**可重复**: 否

### 使用示例

```php
#[Action(name: '/example')]
class MyClass {}
```

