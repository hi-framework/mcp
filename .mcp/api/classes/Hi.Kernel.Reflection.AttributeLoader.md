---
fqcn: Hi\Kernel\Reflection\AttributeLoader
type: class
namespace: Hi\Kernel\Reflection
module: Kernel
file: src/Kernel/Reflection/AttributeLoader.php
line: 21
---
# AttributeLoader

**命名空间**: `Hi\Kernel\Reflection`

**类型**: Class

**文件**: `src/Kernel/Reflection/AttributeLoader.php:21`

**修饰符**: final

Generic attribute loader that uses generators for efficient memory usage

## 继承关系

**实现**: `Hi\Kernel\Reflection\AttributeLoaderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$reader` | `Spiral\Attributes\ReaderInterface` | private readonly | - |  |
| `$scanner` | `Hi\Kernel\Reflection\AttributeFileScanner` | private readonly | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\Reflection\AttributeFileScanner $scanner, Psr\Log\LoggerInterface $logger = '...', ?Spiral\Attributes\ReaderInterface $reader = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$scanner` | `Hi\Kernel\Reflection\AttributeFileScanner` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |
| `$reader` | `?Spiral\Attributes\ReaderInterface` | 'null' |  |

**返回**: `void`

#### `loadAttributes`

```php
public function loadAttributes(array $directories = [], array $files = [], ?string $attributeClass = 'null'): Hi\Kernel\Reflection\Generator
```

Load attributes from directories and files

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | [] |  |
| `$files` | `array` | [] |  |
| `$attributeClass` | `?string` | 'null' | Filter by specific attribute class |

**返回**: `Hi\Kernel\Reflection\Generator`

#### `loadClassAttributes`

```php
public function loadClassAttributes(array $directories = [], array $files = [], ?string $attributeClass = 'null'): Hi\Kernel\Reflection\Generator
```

Load class attributes

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | [] |  |
| `$files` | `array` | [] |  |
| `$attributeClass` | `?string` | 'null' |  |

**返回**: `Hi\Kernel\Reflection\Generator`

#### `loadMethodAttributes`

```php
public function loadMethodAttributes(array $directories = [], array $files = [], ?string $attributeClass = 'null'): Hi\Kernel\Reflection\Generator
```

Load method attributes

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | [] |  |
| `$files` | `array` | [] |  |
| `$attributeClass` | `?string` | 'null' |  |

**返回**: `Hi\Kernel\Reflection\Generator`

#### `loadPropertyAttributes`

```php
public function loadPropertyAttributes(array $directories = [], array $files = [], ?string $attributeClass = 'null'): Hi\Kernel\Reflection\Generator
```

Load property attributes

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | [] |  |
| `$files` | `array` | [] |  |
| `$attributeClass` | `?string` | 'null' |  |

**返回**: `Hi\Kernel\Reflection\Generator`

