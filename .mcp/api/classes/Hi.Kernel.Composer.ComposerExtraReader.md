---
fqcn: Hi\Kernel\Composer\ComposerExtraReader
type: class
namespace: Hi\Kernel\Composer
module: Kernel
file: src/Kernel/Composer/ComposerExtraReader.php
line: 10
---
# ComposerExtraReader

**命名空间**: `Hi\Kernel\Composer`

**类型**: Class

**文件**: `src/Kernel/Composer/ComposerExtraReader.php:10`

## 继承关系

**实现**: `Hi\Kernel\Composer\ComposerExtraReaderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$directories` | `Hi\Kernel\DirectoriesInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\DirectoriesInterface $directories)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `Hi\Kernel\DirectoriesInterface` | - |  |

**返回**: `void`

#### `getInstalledJsonPath`

```php
public function getInstalledJsonPath(): string
```

**返回**: `string`

#### `getRootComposerJsonPath`

```php
public function getRootComposerJsonPath(): string
```

**返回**: `string`

#### `getInstalledPackages`

```php
public function getInstalledPackages(): array
```

**返回**: `array`

#### `iteratePackages`

```php
public function iteratePackages(): Hi\Kernel\Composer\Generator
```

**返回**: `Hi\Kernel\Composer\Generator`

#### `getRootComposerJson`

```php
public function getRootComposerJson(): array
```

**返回**: `array`

#### `getRootExtra`

```php
public function getRootExtra(): array
```

**返回**: `array`

#### `getRootExtraValue`

```php
public function getRootExtraValue(string $key, mixed $default = 'null'): mixed
```

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

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$package` | `array` | - |  |

**返回**: `string`

#### `getPackageExtra`

```php
public function getPackageExtra(array $package): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$package` | `array` | - |  |

**返回**: `array`

#### `getPackageExtraValue`

```php
public function getPackageExtraValue(array $package, string $key, mixed $default = 'null'): mixed
```

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

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `array`

