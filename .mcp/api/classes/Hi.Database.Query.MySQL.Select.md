---
fqcn: Hi\Database\Query\MySQL\Select
type: class
namespace: Hi\Database\Query\MySQL
module: Database
file: src/Database/Query/MySQL/Select.php
line: 11
---
# Select

**命名空间**: `Hi\Database\Query\MySQL`

**类型**: Class

**文件**: `src/Database/Query/MySQL/Select.php:11`

## 继承关系

**继承**: `Hi\Database\Query\Basic\Select`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$bridge` | `Hi\Database\Query\Bridge` | protected | - |  |
| `$builder` | `mixed` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Database\Query\Bridge $bridge, mixed $builder, string $table, array $columns = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$bridge` | `Hi\Database\Query\Bridge` | - |  |
| `$builder` | `mixed` | - |  |
| `$table` | `string` | - |  |
| `$columns` | `array` | [] |  |

**返回**: `void`

#### `calcFoundRows`

```php
public function calcFoundRows(bool $enable = 'true'): self
```

Adds or removes SQL_CALC_FOUND_ROWS flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `cache`

```php
public function cache(bool $enable = 'true'): self
```

Adds or removes SQL_CACHE flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `noCache`

```php
public function noCache(bool $enable = 'true'): self
```

Adds or removes SQL_NO_CACHE flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `straightJoin`

```php
public function straightJoin(bool $enable = 'true'): self
```

Adds or removes STRAIGHT_JOIN flag.

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

#### `smallResult`

```php
public function smallResult(bool $enable = 'true'): self
```

Adds or removes SQL_SMALL_RESULT flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `bigResult`

```php
public function bigResult(bool $enable = 'true'): self
```

Adds or removes SQL_BIG_RESULT flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

#### `bufferResult`

```php
public function bufferResult(bool $enable = 'true'): self
```

Adds or removes SQL_BUFFER_RESULT flag.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' | set or unset flag (default true) |

**返回**: `self`

