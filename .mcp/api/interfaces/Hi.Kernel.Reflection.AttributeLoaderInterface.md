---
fqcn: Hi\Kernel\Reflection\AttributeLoaderInterface
type: interface
namespace: Hi\Kernel\Reflection
module: Kernel
file: src/Kernel/Reflection/AttributeLoaderInterface.php
line: 9
---
# AttributeLoaderInterface

**命名空间**: `Hi\Kernel\Reflection`

**类型**: Interface

**文件**: `src/Kernel/Reflection/AttributeLoaderInterface.php:9`

## 方法

### Public 方法

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

