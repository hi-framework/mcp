---
fqcn: Hi\Kernel\Console\CommandMetadataManager
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/CommandMetadataManager.php
line: 16
---
# CommandMetadataManager

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/CommandMetadataManager.php:16`

Command metadata manager

Manages storage, lookup and on-demand loading of command metadata

## 继承关系

**实现**: `Hi\Kernel\Console\CommandMetadataManagerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$commands` | `array` | private | [] |  |
| `$loaders` | `array` | private | [] |  |
| `$loadAttempts` | `array` | private | [] |  |
| `$loadersSorted` | `bool` | private | 'false' |  |
| `$loadedAllCommands` | `bool` | private | 'false' |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

#### `registerCommand`

```php
public function registerCommand(Hi\Kernel\Console\Metadata\CommandMetadata $metadata): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Kernel\Console\Metadata\CommandMetadata` | - |  |

**返回**: `void`

#### `registerCommands`

```php
public function registerCommands(array $commands): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$commands` | `array` | - |  |

**返回**: `void`

#### `findCommand`

```php
public function findCommand(string $name): ?Hi\Kernel\Console\Metadata\CommandMetadata
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Kernel\Console\Metadata\CommandMetadata`

#### `hasCommand`

```php
public function hasCommand(string $name): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `getAllCommands`

```php
public function getAllCommands(): Hi\Kernel\Console\Generator
```

**返回**: `Hi\Kernel\Console\Generator`

#### `getVisibleCommands`

```php
public function getVisibleCommands(): Hi\Kernel\Console\Generator
```

**返回**: `Hi\Kernel\Console\Generator`

#### `addLoader`

```php
public function addLoader(Hi\Kernel\Console\CommandLoaderInterface $loader, int $priority = 0): static
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$loader` | `Hi\Kernel\Console\CommandLoaderInterface` | - |  |
| `$priority` | `int` | 0 |  |

**返回**: `static`

#### `clearCache`

```php
public function clearCache(): void
```

**返回**: `void`

#### `removeCommand`

```php
public function removeCommand(string $name): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `loadAllCommands`

```php
public function loadAllCommands(): void
```

Force load all commands (for scenarios requiring complete command list)

**返回**: `void`

