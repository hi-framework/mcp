---
fqcn: Hi\Database\Query\Basic\Insert
type: class
namespace: Hi\Database\Query\Basic
module: Database
file: src/Database/Query/Basic/Insert.php
line: 10
---
# Insert

**命名空间**: `Hi\Database\Query\Basic`

**类型**: Class

**文件**: `src/Database/Query/Basic/Insert.php:10`

## 继承关系

**继承**: `Hi\Database\Query\Basic\DMLBuilder`

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

#### `lastId`

```php
public function lastId(): string
```

Executes the query and get the last insert id

**返回**: `string`

#### `into`

```php
public function into(string $into): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$into` | `string` | - |  |

**返回**: `self`

#### `setLastInsertIdNames`

```php
public function setLastInsertIdNames(array $last_insert_id_names): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$last_insert_id_names` | `array` | - |  |

**返回**: `void`

#### `getLastInsertIdName`

```php
public function getLastInsertIdName(string $col): ?string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$col` | `string` | - |  |

**返回**: `?string`

#### `addRows`

```php
public function addRows(array $rows): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$rows` | `array` | - |  |

**返回**: `self`

#### `addRow`

```php
public function addRow(array $cols = []): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cols` | `array` | [] |  |

**返回**: `self`

