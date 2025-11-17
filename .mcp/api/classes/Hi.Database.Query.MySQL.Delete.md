---
fqcn: Hi\Database\Query\MySQL\Delete
type: class
namespace: Hi\Database\Query\MySQL
module: Database
file: src/Database/Query/MySQL/Delete.php
line: 11
---
# Delete

**命名空间**: `Hi\Database\Query\MySQL`

**类型**: Class

**文件**: `src/Database/Query/MySQL/Delete.php:11`

## 继承关系

**继承**: `Hi\Database\Query\Basic\Delete`

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

#### `quick`

```php
public function quick(bool $enable = 'true'): self
```

Adds or removes QUICK flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `orderBy`

```php
public function orderBy(array $spec): self
```

Adds a column order to the query.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `array` | - | the columns and direction to order by |

**返回**: `self`

