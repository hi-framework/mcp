---
fqcn: Hi\Kernel\Reflection\ReflectionFile
type: class
namespace: Hi\Kernel\Reflection
module: Kernel
file: src/Kernel/Reflection/ReflectionFile.php
line: 10
---
# ReflectionFile

**命名空间**: `Hi\Kernel\Reflection`

**类型**: Class

**文件**: `src/Kernel/Reflection/ReflectionFile.php:10`

**修饰符**: final

File reflections can fetch information about classes

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$classes` | `array` | private | [] | Classes declared in file. |
| `$interfaces` | `array` | private | [] | Interfaces declared in file. |
| `$filename` | `string` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $filename)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$filename` | `string` | - |  |

**返回**: `void`

#### `getFilename`

```php
public function getFilename(): string
```

Filename.

**返回**: `string`

#### `getClasses`

```php
public function getClasses(): array
```

List files that declared classes.

**返回**: `array`

#### `getInterfaces`

```php
public function getInterfaces(): array
```

List files that declared interfaces.

**返回**: `array`

#### `getDeclarations`

```php
public function getDeclarations(): array
```

**返回**: `array`

### Protected 方法

#### `locateDeclarations`

```php
protected function locateDeclarations(): void
```

Locate every class, interface definition.

**返回**: `void`

#### `nextPart`

```php
protected function nextPart(array $tokens, int $index): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$tokens` | `array` | - |  |
| `$index` | `int` | - |  |

**返回**: `string`

