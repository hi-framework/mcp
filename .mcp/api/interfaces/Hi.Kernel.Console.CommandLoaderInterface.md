---
fqcn: Hi\Kernel\Console\CommandLoaderInterface
type: interface
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/CommandLoaderInterface.php
line: 14
---
# CommandLoaderInterface

**命名空间**: `Hi\Kernel\Console`

**类型**: Interface

**文件**: `src/Kernel/Console/CommandLoaderInterface.php:14`

Command loader interface

Simplified version focusing on core functionality

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

Get loader name

**返回**: `string`

#### `findCommand`

```php
public function findCommand(string $name): ?Hi\Kernel\Console\Metadata\CommandMetadata
```

Find command by name on-demand

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Command name |

**返回**: `?Hi\Kernel\Console\Metadata\CommandMetadata` - Command metadata, null if not found

#### `findAllCommands`

```php
public function findAllCommands(): Hi\Kernel\Console\Generator|array
```

Get all commands

**返回**: `Hi\Kernel\Console\Generator|array` - CommandMetadata>|array<string, CommandMetadata> Command name => command metadata

