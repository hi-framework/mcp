---
fqcn: Hi\Kernel\Reflection\AttributeFileScanner
type: class
namespace: Hi\Kernel\Reflection
module: Kernel
file: src/Kernel/Reflection/AttributeFileScanner.php
line: 15
---
# AttributeFileScanner

**命名空间**: `Hi\Kernel\Reflection`

**类型**: Class

**文件**: `src/Kernel/Reflection/AttributeFileScanner.php:15`

**修饰符**: final

Scans directories and files for PHP files that may contain attributes

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |

**返回**: `void`

#### `scanDirectories`

```php
public function scanDirectories(array $directories): Hi\Kernel\Reflection\Generator
```

Scan directories for PHP files

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | - |  |

**返回**: `Hi\Kernel\Reflection\Generator` - File paths

#### `validateFiles`

```php
public function validateFiles(array $files): Hi\Kernel\Reflection\Generator
```

Validate and filter files

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$files` | `array` | - |  |

**返回**: `Hi\Kernel\Reflection\Generator` - Valid file paths

#### `collectFiles`

```php
public function collectFiles(array $directories = [], array $files = []): Hi\Kernel\Reflection\Generator
```

Collect all files from directories and explicit files

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | [] |  |
| `$files` | `array` | [] |  |

**返回**: `Hi\Kernel\Reflection\Generator` - All valid file paths

