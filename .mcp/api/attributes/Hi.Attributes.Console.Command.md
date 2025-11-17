---
fqcn: Hi\Attributes\Console\Command
type: class
namespace: Hi\Attributes\Console
module: Attributes
file: src/Attributes/Console/Command.php
line: 19
---
# Command

**命名空间**: `Hi\Attributes\Console`

**类型**: Class

**文件**: `src/Attributes/Console/Command.php:19`

Console command attribute

Usage example:
```php
#[Command(name: 'hello', desc: 'Hello world')]
class HelloCommand
{
    // ...
}
```

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$reflection` | `Hi\Attributes\Console\ReflectionClass` | protected | - |  |
| `$name` | `string` | public | - |  |
| `$desc` | `string` | public | - |  |
| `$overwrite` | `bool` | public readonly | 'false' |  |
| `$hidden` | `bool` | public readonly | 'false' |  |
| `$owner` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, string $desc, bool $overwrite = 'false', bool $hidden = 'false', string $owner = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Command name |
| `$desc` | `string` | - | Command description |
| `$overwrite` | `bool` | 'false' | Overwrite existing command |
| `$hidden` | `bool` | 'false' | Hidden command |
| `$owner` | `string` | '' | Command owner |

**返回**: `void`

#### `getReflection`

```php
public function getReflection(): Hi\Attributes\Console\ReflectionClass
```

Get reflection class

**返回**: `Hi\Attributes\Console\ReflectionClass`

#### `setReflection`

```php
public function setReflection(Hi\Attributes\Console\ReflectionClass $reflection): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$reflection` | `Hi\Attributes\Console\ReflectionClass` | - |  |

**返回**: `void`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[Command(name: '/example', desc: '/example')]
class MyClass {}
```

