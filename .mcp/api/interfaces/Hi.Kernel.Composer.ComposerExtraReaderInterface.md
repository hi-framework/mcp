---
fqcn: Hi\Kernel\Composer\ComposerExtraReaderInterface
type: interface
namespace: Hi\Kernel\Composer
module: Kernel
file: src/Kernel/Composer/ComposerExtraReaderInterface.php
line: 10
---
# ComposerExtraReaderInterface

**命名空间**: `Hi\Kernel\Composer`

**类型**: Interface

**文件**: `src/Kernel/Composer/ComposerExtraReaderInterface.php:10`

Interface for reading composer installed packages and accessing package "extra" data.

## 方法

### Public 方法

#### `getInstalledJsonPath`

```php
public function getInstalledJsonPath(): string
```

Return absolute path to composer installed.json

**返回**: `string`

#### `getRootComposerJsonPath`

```php
public function getRootComposerJsonPath(): string
```

Return absolute path to project root composer.json

**返回**: `string`

#### `getInstalledPackages`

```php
public function getInstalledPackages(): array
```

Load installed packages from composer on demand.

**返回**: `array` - array>

#### `iteratePackages`

```php
public function iteratePackages(): Hi\Kernel\Composer\Generator
```

Iterate all installed packages.

**返回**: `Hi\Kernel\Composer\Generator` - array>

#### `getRootComposerJson`

```php
public function getRootComposerJson(): array
```

Read root composer.json and return full decoded array.

**返回**: `array` - mixed>

#### `getRootExtra`

```php
public function getRootExtra(): array
```

Get root composer extra section.

**返回**: `array` - mixed>

#### `getRootExtraValue`

```php
public function getRootExtraValue(string $key, mixed $default = 'null'): mixed
```

Get specific key from root composer extra.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$default` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `getPackageName`

```php
public function getPackageName(array $package): string
```

Get package name or empty string.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$package` | `array` | - |  |

**返回**: `string`

#### `getPackageExtra`

```php
public function getPackageExtra(array $package): array
```

Get full extra array for a package.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$package` | `array` | - |  |

**返回**: `array` - mixed>

#### `getPackageExtraValue`

```php
public function getPackageExtraValue(array $package, string $key, mixed $default = 'null'): mixed
```

Get specific extra value by key from a package.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$package` | `array` | - |  |
| `$key` | `string` | - |  |
| `$default` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `getInstalledExtraByKey`

```php
public function getInstalledExtraByKey(string $key): array
```

Get values of specified extra key for all installed packages.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `array` - mixed>

