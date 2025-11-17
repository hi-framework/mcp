---
fqcn: Hi\Kernel\DirectoriesInterface
type: interface
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/DirectoriesInterface.php
line: 9
---
# DirectoriesInterface

**命名空间**: `Hi\Kernel`

**类型**: Interface

**文件**: `src/Kernel/DirectoriesInterface.php:9`

## 方法

### Public 方法

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
public function set(string $name, string $path): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Directory alias, ie. "framework". |
| `$path` | `string` | - | directory path without ending slash |

**返回**: `self`

**抛出异常**:

- `DirectoryException`

#### `get`

```php
public function get(string $name): string
```

Get directory value.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `string`

**抛出异常**:

- `DirectoryException` - when no directory found

#### `getAll`

```php
public function getAll(): array
```

List all registered directories.

**返回**: `array` - string>

#### `join`

```php
public function join(string $name, string ...$paths): string
```

Join name and multiple path segments with directory.

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

Resolve a relative path based on a named directory.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | The directory name to use as base |
| `$relativePath` | `string` | - | The relative path to resolve |

**返回**: `string` - The resolved absolute path

**抛出异常**:

- `DirectoryException` - when directory not found

#### `relative`

```php
public function relative(string $fromName, string $toName): string
```

Calculate relative path from one directory to another.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$fromName` | `string` | - | The source directory name |
| `$toName` | `string` | - | The target directory name |

**返回**: `string` - The relative path from source to target

**抛出异常**:

- `DirectoryException` - when directories not found

#### `template`

```php
public function template(string $template, array $variables = []): string
```

Process path template with variable substitution.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$template` | `string` | - | Template string with {variable} placeholders |
| `$variables` | `array` | [] |  |

**返回**: `string` - Processed path with variables replaced

#### `alias`

```php
public function alias(string $aliasPath): string
```

Resolve alias path notation (@alias/path).

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$aliasPath` | `string` | - | Path with alias notation |

**返回**: `string` - Resolved path

**抛出异常**:

- `DirectoryException` - when alias not found

#### `normalize`

```php
public function normalize(string $path): string
```

Normalize a path by resolving relative segments and standardizing separators.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$path` | `string` | - | The path to normalize |

**返回**: `string` - The normalized path

