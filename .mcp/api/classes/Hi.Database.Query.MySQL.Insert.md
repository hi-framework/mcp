---
fqcn: Hi\Database\Query\MySQL\Insert
type: class
namespace: Hi\Database\Query\MySQL
module: Database
file: src/Database/Query/MySQL/Insert.php
line: 11
---
# Insert

**命名空间**: `Hi\Database\Query\MySQL`

**类型**: Class

**文件**: `src/Database/Query/MySQL/Insert.php:11`

## 继承关系

**继承**: `Hi\Database\Query\Basic\Insert`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$bridge` | `Hi\Database\Query\Bridge` | protected | - |  |
| `$builder` | `mixed` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Database\Query\Bridge $bridge, mixed $builder, string $table)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$bridge` | `Hi\Database\Query\Bridge` | - |  |
| `$builder` | `mixed` | - |  |
| `$table` | `string` | - |  |

**返回**: `void`

#### `orReplace`

```php
public function orReplace(bool $enable = 'true'): self
```

Use a REPLACE statement.
Matches similar orReplace() function for Sqlite

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `highPriority`

```php
public function highPriority(bool $enable = 'true'): self
```

Adds or removes HIGH_PRIORITY flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `lowPriority`

```php
public function lowPriority(bool $enable = 'true'): self
```

Adds or removes LOW_PRIORITY flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `ignore`

```php
public function ignore(bool $enable = 'true'): self
```

Adds or removes IGNORE flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `delayed`

```php
public function delayed(bool $enable = 'true'): self
```

Adds or removes DELAYED flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `onDuplicateKeyUpdateCol`

```php
public function onDuplicateKeyUpdateCol(string $col, ...$value): self
```

Sets one column value placeholder in ON DUPLICATE KEY UPDATE section;
if an optional second parameter is passed, that value is bound to the
placeholder.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$col` | `string` | - | the column name |
| `...$value` | `array` | - | optional: a value to bind to the placeholder |

**返回**: `self`

#### `onDuplicateKeyUpdateCols`

```php
public function onDuplicateKeyUpdateCols(array $cols): self
```

Sets multiple column value placeholders in ON DUPLICATE KEY UPDATE
section. If an element is a key-value pair, the key is treated as the
column name and the value is bound to that column.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cols` | `array` | - | a list of column names, optionally as key-value |

**返回**: `self`

#### `onDuplicateKeyUpdate`

```php
public function onDuplicateKeyUpdate(string $col, ?string $value): self
```

Sets a column value directly in ON DUPLICATE KEY UPDATE section; the
value will not be escaped, although fully-qualified identifiers in the
value will be quoted.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$col` | `string` | - | the column name |
| `$value` | `?string` | - | the column value expression |

**返回**: `self`

