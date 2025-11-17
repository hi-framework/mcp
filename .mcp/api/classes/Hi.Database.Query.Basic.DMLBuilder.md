---
fqcn: Hi\Database\Query\Basic\DMLBuilder
type: class
namespace: Hi\Database\Query\Basic
module: Database
file: src/Database/Query/Basic/DMLBuilder.php
line: 9
---
# DMLBuilder

**命名空间**: `Hi\Database\Query\Basic`

**类型**: Class

**文件**: `src/Database/Query/Basic/DMLBuilder.php:9`

**修饰符**: abstract

## 继承关系

**继承**: `Hi\Database\Query\Basic\Builder`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$bridge` | `Hi\Database\Query\Bridge` | protected | - |  |

## 方法

### Public 方法

#### `col`

```php
public function col(string $col, ...$value): static
```

Sets one column value placeholder; if an optional second parameter is
passed, that value is bound to the placeholder.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$col` | `string` | - | the column name |
| `...$value` | `mixed[]` | - | optional: a value to bind to the placeholder |

**返回**: `static`

#### `cols`

```php
public function cols(array $cols): static
```

Sets multiple column value placeholders. If an element is a key-value
pair, the key is treated as the column name and the value is bound to
that column.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cols` | `array` | - | a list of column names, optionally as key-value |

**返回**: `static`

#### `set`

```php
public function set(string $col, ?string $value): static
```

Sets a column value directly; the value will not be escaped, although
fully-qualified identifiers in the value will be quoted.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$col` | `string` | - | the column name |
| `$value` | `?string` | - | the column value expression |

**返回**: `static`

#### `rowCount`

```php
public function rowCount(): int
```

Executes the query and returns the number of rows affected.

**返回**: `int`

