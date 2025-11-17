---
fqcn: Hi\Kernel\Composer\AbstractPackageScanner
type: class
namespace: Hi\Kernel\Composer
module: Kernel
file: src/Kernel/Composer/AbstractPackageScanner.php
line: 16
---
# AbstractPackageScanner

**命名空间**: `Hi\Kernel\Composer`

**类型**: Class

**文件**: `src/Kernel/Composer/AbstractPackageScanner.php:16`

**修饰符**: abstract

Abstract package scanner for discovering components in Composer packages

Provides common functionality for scanning packages, extracting configurations,
and creating metadata objects with consistent error handling.

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `HI_FRAMEWORK_KEY` | 'hi-framework' | protected |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$composerExtraReader` | `Hi\Kernel\Composer\ComposerExtraReaderInterface` | protected | - |  |
| `$directories` | `Hi\Kernel\DirectoriesInterface` | protected readonly | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\DirectoriesInterface $directories, Psr\Log\LoggerInterface $logger, ?Hi\Kernel\Composer\ComposerExtraReaderInterface $composerExtraReader = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `Hi\Kernel\DirectoriesInterface` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |
| `$composerExtraReader` | `?Hi\Kernel\Composer\ComposerExtraReaderInterface` | 'null' |  |

**返回**: `void`

### Protected 方法

#### `getComposerExtraReader`

```php
protected function getComposerExtraReader(): Hi\Kernel\Composer\ComposerExtraReaderInterface
```

Get the composer extra reader instance

**返回**: `Hi\Kernel\Composer\ComposerExtraReaderInterface`

#### `iteratePackagesWithConfig`

```php
protected function iteratePackagesWithConfig(string $configKey): Hi\Kernel\Composer\Generator
```

Iterate through packages that have the specified framework configuration

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$configKey` | `string` | - | The configuration key to look for (e.g., 'events', 'console', 'routes) |

**返回**: `Hi\Kernel\Composer\Generator` - string, package: array, config: array}>

#### `extractClassNames`

```php
protected function extractClassNames(array $config, string $key): array
```

Extract class names from configuration array

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - | Configuration array |
| `$key` | `string` | - | Key to extract classes from (e.g., 'events', 'listeners', 'commands') |

**返回**: `array` - Array of class names

#### `createMetadataSafely`

```php
protected function createMetadataSafely(callable $factory, string $className, string $packageName): mixed
```

Safely create metadata object with error handling

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$factory` | `callable` | - | Function that creates the metadata object |
| `$className` | `string` | - | Class name for error reporting |
| `$packageName` | `string` | - | Package name for error reporting |

**返回**: `mixed` - Created metadata object or null on failure

#### `validateClassExists`

```php
protected function validateClassExists(string $className, string $packageName): bool
```

Check if class exists and log warning if not

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | Class name to check |
| `$packageName` | `string` | - | Package name for error reporting |

**返回**: `bool` - True if class exists

#### `getReflectionClass`

```php
protected function getReflectionClass(string $className, string $packageName): ?Hi\Kernel\Composer\ReflectionClass
```

Get reflection class with error handling

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | Class name |
| `$packageName` | `string` | - | Package name for error reporting |

**返回**: `?Hi\Kernel\Composer\ReflectionClass` - Reflection class or null on failure

#### `getPackageInstallPath`

```php
protected function getPackageInstallPath(array $packageData): string
```

Get package installation path from package data

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$packageData` | `array` | - | Complete package data from composer |

**返回**: `string` - Package installation path or empty string if not found

#### `resolveAbsolutePaths`

```php
protected function resolveAbsolutePaths(array $config, string $packagePath): array
```

Resolve relative paths to absolute paths for attribute loaders

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - | Configuration section (routes, middlewares, events, listeners, etc.) |
| `$packagePath` | `string` | - | Base path of the package |

**返回**: `array` - array<string>, dirs: array<string>} Absolute paths for files and directories

