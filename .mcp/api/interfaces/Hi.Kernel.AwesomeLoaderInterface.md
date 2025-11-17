---
fqcn: Hi\Kernel\AwesomeLoaderInterface
type: interface
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/AwesomeLoaderInterface.php
line: 9
---
# AwesomeLoaderInterface

**命名空间**: `Hi\Kernel`

**类型**: Interface

**文件**: `src/Kernel/AwesomeLoaderInterface.php:9`

## 方法

### Public 方法

#### `withDirectories`

```php
public function withDirectories(array $directories): self
```

Set directories to search attributes.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | - |  |

**返回**: `self`

#### `withFiles`

```php
public function withFiles(array $files): self
```

Set files to search attributes.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$files` | `array` | - |  |

**返回**: `self`

#### `tokenize`

```php
public function tokenize(): void
```

Parse all files in the directories, annalyze the class and interface with them use tokenizer
save the result in the storage

**返回**: `void`

#### `getClassCarriers`

```php
public function getClassCarriers(string $attribute, ?string $target = 'null'): Hi\Kernel\Generator
```

Get all attributes of the target class

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `string` | - | the class name of the attribute |
| `$target` | `?string` | 'null' | the class name of the target class |

**返回**: `Hi\Kernel\Generator`

#### `getMethodCarriers`

```php
public function getMethodCarriers(string $attribute, ?string $target = 'null'): Hi\Kernel\Generator
```

Get all attributes of the target class method

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `string` | - | the class name of the attribute |
| `$target` | `?string` | 'null' | the class name of the target class |

**返回**: `Hi\Kernel\Generator`

#### `getPropertyCarriers`

```php
public function getPropertyCarriers(string $attribute, ?string $target = 'null'): Hi\Kernel\Generator
```

Get all attributes of the target class property

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `string` | - | the class name of the attribute |
| `$target` | `?string` | 'null' | the class name of the target class |

**返回**: `Hi\Kernel\Generator`

