---
fqcn: Hi\Kernel\Directories
type: class
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/Directories.php
line: 7
---
# Directories

**命名空间**: `Hi\Kernel`

**类型**: Class

**文件**: `src/Kernel/Directories.php:7`

## 继承关系

**实现**: `Hi\Kernel\DirectoriesInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$directories` | `array` | private | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $directories = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | [] |  |

**返回**: `void`

#### `has`

```php
public function has(string $name): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `set`

```php
public function set(string $name, string $path): Hi\Kernel\DirectoriesInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$path` | `string` | - |  |

**返回**: `Hi\Kernel\DirectoriesInterface`

#### `get`

```php
public function get(string $name): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `string`

#### `getAll`

```php
public function getAll(): array
```

**返回**: `array`

#### `join`

```php
public function join(string $name, string ...$paths): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `...$paths` | `string` | - |  |

**返回**: `string`

#### `resolve`

```php
public function resolve(string $name, string $relativePath): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$relativePath` | `string` | - |  |

**返回**: `string`

#### `relative`

```php
public function relative(string $fromName, string $toName): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$fromName` | `string` | - |  |
| `$toName` | `string` | - |  |

**返回**: `string`

#### `template`

```php
public function template(string $template, array $variables = []): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$template` | `string` | - |  |
| `$variables` | `array` | [] |  |

**返回**: `string`

#### `alias`

```php
public function alias(string $aliasPath): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$aliasPath` | `string` | - |  |

**返回**: `string`

#### `normalize`

```php
public function normalize(string $path): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$path` | `string` | - |  |

**返回**: `string`

