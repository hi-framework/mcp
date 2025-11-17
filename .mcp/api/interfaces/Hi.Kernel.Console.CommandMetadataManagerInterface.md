---
fqcn: Hi\Kernel\Console\CommandMetadataManagerInterface
type: interface
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/CommandMetadataManagerInterface.php
line: 14
---
# CommandMetadataManagerInterface

**命名空间**: `Hi\Kernel\Console`

**类型**: Interface

**文件**: `src/Kernel/Console/CommandMetadataManagerInterface.php:14`

Command metadata manager interface

Manages storage, lookup and lifecycle of all command metadata

## 方法

### Public 方法

#### `registerCommand`

```php
public function registerCommand(Hi\Kernel\Console\Metadata\CommandMetadata $metadata): void
```

Register command metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Kernel\Console\Metadata\CommandMetadata` | - | Command metadata |

**返回**: `void`

**抛出异常**:

- `\InvalidArgumentException` - When command name is empty or exists and overwrite not allowed

#### `registerCommands`

```php
public function registerCommands(array $commands): void
```

Register multiple command metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$commands` | `array` | - | Array of command metadata |

**返回**: `void`

#### `findCommand`

```php
public function findCommand(string $name): ?Hi\Kernel\Console\Metadata\CommandMetadata
```

Find command metadata by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Command name |

**返回**: `?Hi\Kernel\Console\Metadata\CommandMetadata` - Command metadata, null if not found

#### `hasCommand`

```php
public function hasCommand(string $name): bool
```

Check if command exists by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Command name |

**返回**: `bool` - True if exists, false otherwise

#### `addLoader`

```php
public function addLoader(Hi\Kernel\Console\CommandLoaderInterface $loader, int $priority = 0): static
```

Add command loader

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$loader` | `Hi\Kernel\Console\CommandLoaderInterface` | - | Command loader |
| `$priority` | `int` | 0 | Priority, higher number means higher priority |

**返回**: `static`

#### `clearCache`

```php
public function clearCache(): void
```

Clear all cached command metadata

**返回**: `void`

#### `removeCommand`

```php
public function removeCommand(string $name): bool
```

Remove command by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Command name |

**返回**: `bool` - True if successfully removed, false if command doesn't exist

#### `getVisibleCommands`

```php
public function getVisibleCommands(): Hi\Kernel\Console\Generator
```

Get all visible commands (non-hidden commands)

**返回**: `Hi\Kernel\Console\Generator` - CommandMetadata> Generator of command name => command metadata

#### `getAllCommands`

```php
public function getAllCommands(): Hi\Kernel\Console\Generator
```

Get all commands

**返回**: `Hi\Kernel\Console\Generator` - CommandMetadata> Generator of command name => command metadata

#### `loadAllCommands`

```php
public function loadAllCommands(): void
```

Force load all commands (for scenarios requiring complete command list)

**返回**: `void`

