---
fqcn: Hi\Database\Query\ClickHouse
type: class
namespace: Hi\Database\Query
module: Database
file: src/Database/Query/ClickHouse.php
line: 9
---
# ClickHouse

**命名空间**: `Hi\Database\Query`

**类型**: Class

**文件**: `src/Database/Query/ClickHouse.php:9`

## 继承关系

**继承**: `Hi\Database\Query\Query`

## 方法

### Public 方法

#### `select`

```php
public function select(array $columns = [], string $table = ''): Hi\Database\Query\MySQL\Select
```

Create a new select query

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$columns` | `array` | [] | the columns to select |
| `$table` | `string` | '' |  |

**返回**: `Hi\Database\Query\MySQL\Select`

#### `insert`

```php
public function insert(string $table = ''): Hi\Database\Query\MySQL\Insert
```

Create a new insert query

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$table` | `string` | '' |  |

**返回**: `Hi\Database\Query\MySQL\Insert`

#### `delete`

```php
public function delete(string $table = ''): Hi\Database\Query\MySQL\Delete
```

Create a new delete query

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$table` | `string` | '' |  |

**返回**: `Hi\Database\Query\MySQL\Delete`

#### `update`

```php
public function update(string $table = ''): Hi\Database\Query\MySQL\Update
```

Create a new update query

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$table` | `string` | '' |  |

**返回**: `Hi\Database\Query\MySQL\Update`

