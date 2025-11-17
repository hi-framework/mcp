---
fqcn: Hi\Kernel\Console\Command\AbstractCommand
type: class
namespace: Hi\Kernel\Console\Command
module: Kernel
file: src/Kernel/Console/Command/AbstractCommand.php
line: 7
---
# AbstractCommand

**命名空间**: `Hi\Kernel\Console\Command`

**类型**: Class

**文件**: `src/Kernel/Console/Command/AbstractCommand.php:7`

**修饰符**: abstract

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | protected | - | Command name |
| `$desc` | `string` | protected | - | Command description |
| `$actions` | `array` | protected | - | Command actions map |
| `$hidden` | `bool` | protected | 'false' | Whether the command is hidden |

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

Get command name

**返回**: `string`

#### `getDesc`

```php
public function getDesc(): string
```

Get command description

**返回**: `string`

#### `getActions`

```php
public function getActions(): array
```

Get command actions map

**返回**: `array`

#### `isHidden`

```php
public function isHidden(): bool
```

Whether the command is hidden

**返回**: `bool`

