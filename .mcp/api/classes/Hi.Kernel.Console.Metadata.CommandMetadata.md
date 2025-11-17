---
fqcn: Hi\Kernel\Console\Metadata\CommandMetadata
type: class
namespace: Hi\Kernel\Console\Metadata
module: Kernel
file: src/Kernel/Console/Metadata/CommandMetadata.php
line: 12
---
# CommandMetadata

**命名空间**: `Hi\Kernel\Console\Metadata`

**类型**: Class

**文件**: `src/Kernel/Console/Metadata/CommandMetadata.php:12`

Command metadata class

Pure data structure for storing command metadata

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$actions` | `array` | private | [] |  |
| `$name` | `string` | public readonly | - |  |
| `$desc` | `string` | public readonly | - |  |
| `$object` | `object` | public readonly | - |  |
| `$overwrite` | `bool` | public readonly | 'false' |  |
| `$hidden` | `bool` | public readonly | 'false' |  |
| `$owner` | `string` | public readonly | '' |  |
| `$isBuiltin` | `bool` | public readonly | 'false' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, string $desc, object $object, bool $overwrite = 'false', bool $hidden = 'false', string $owner = '', bool $isBuiltin = 'false', array $actions = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Command name |
| `$desc` | `string` | - | Command description |
| `$object` | `object` | - |  |
| `$overwrite` | `bool` | 'false' | Whether to overwrite existing command |
| `$hidden` | `bool` | 'false' | Whether to hide command |
| `$owner` | `string` | '' | Command owner |
| `$isBuiltin` | `bool` | 'false' | Whether this is a builtin command |
| `$actions` | `array` | [] |  |

**返回**: `void`

#### `addAction`

```php
public function addAction(Hi\Kernel\Console\Metadata\ActionMetadata $action): void
```

Add action metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$action` | `Hi\Kernel\Console\Metadata\ActionMetadata` | - |  |

**返回**: `void`

#### `findAction`

```php
public function findAction(string $name): ?Hi\Kernel\Console\Metadata\ActionMetadata
```

Get action metadata by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Kernel\Console\Metadata\ActionMetadata`

#### `hasAction`

```php
public function hasAction(string $name): bool
```

Check if action exists by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `getActionCount`

```php
public function getActionCount(): int
```

Get action count

**返回**: `int`

#### `getAllActions`

```php
public function getAllActions(): array
```

Get all action metadata

**返回**: `array` - ActionMetadata>

