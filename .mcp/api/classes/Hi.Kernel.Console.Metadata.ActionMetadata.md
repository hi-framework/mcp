---
fqcn: Hi\Kernel\Console\Metadata\ActionMetadata
type: class
namespace: Hi\Kernel\Console\Metadata
module: Kernel
file: src/Kernel/Console/Metadata/ActionMetadata.php
line: 12
---
# ActionMetadata

**命名空间**: `Hi\Kernel\Console\Metadata`

**类型**: Class

**文件**: `src/Kernel/Console/Metadata/ActionMetadata.php:12`

Action metadata class

Pure data structure for storing command action metadata

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | public readonly | - |  |
| `$method` | `Hi\Kernel\Console\Metadata\ReflectionMethod` | public readonly | - |  |
| `$desc` | `string` | public readonly | '' |  |
| `$schedule` | `string` | public readonly | '' |  |
| `$coroutine` | `bool` | public readonly | 'true' |  |
| `$replicas` | `string` | public readonly | '' |  |
| `$owner` | `string` | public readonly | '' |  |
| `$options` | `array` | public readonly | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, Hi\Kernel\Console\Metadata\ReflectionMethod $method, string $desc = '', string $schedule = '', bool $coroutine = 'true', string $replicas = '', string $owner = '', array $options = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Action name |
| `$method` | `Hi\Kernel\Console\Metadata\ReflectionMethod` | - | Method reflection object |
| `$desc` | `string` | '' | Action description |
| `$schedule` | `string` | '' | Scheduled task timing |
| `$coroutine` | `bool` | 'true' | Whether to run in coroutine |
| `$replicas` | `string` | '' | Deployment replica count |
| `$owner` | `string` | '' | Action owner |
| `$options` | `array` | [] | Option metadata array |

**返回**: `void`

#### `getOption`

```php
public function getOption(string $name): ?Hi\Kernel\Console\Metadata\OptionMetadata
```

Get option by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Kernel\Console\Metadata\OptionMetadata`

#### `getOptionByShortcut`

```php
public function getOptionByShortcut(string $shortcut): ?Hi\Kernel\Console\Metadata\OptionMetadata
```

Get option by shortcut

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$shortcut` | `string` | - |  |

**返回**: `?Hi\Kernel\Console\Metadata\OptionMetadata`

#### `hasOption`

```php
public function hasOption(string $name): bool
```

Check if option exists by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `getAllOptions`

```php
public function getAllOptions(): array
```

Get all option metadata

**返回**: `array` - OptionMetadata>

#### `getRequiredOptions`

```php
public function getRequiredOptions(): array
```

Get all required options

**返回**: `array` - OptionMetadata>

#### `getOptionalOptions`

```php
public function getOptionalOptions(): array
```

Get all optional options

**返回**: `array` - OptionMetadata>

#### `getOptionCount`

```php
public function getOptionCount(): int
```

Get option count

**返回**: `int`

#### `getOptionNames`

```php
public function getOptionNames(): array
```

Get all option names

**返回**: `array`

#### `isScheduled`

```php
public function isScheduled(): bool
```

Check if this is a scheduled task

**返回**: `bool`

#### `runInCoroutine`

```php
public function runInCoroutine(): bool
```

Check if coroutine is supported

**返回**: `bool`

