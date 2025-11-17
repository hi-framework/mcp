---
fqcn: Hi\Database\Query\MySQL
type: class
namespace: Hi\Database\Query
module: Database
file: src/Database/Query/MySQL.php
line: 10
---
# MySQL

**命名空间**: `Hi\Database\Query`

**类型**: Class

**文件**: `src/Database/Query/MySQL.php:10`

## 继承关系

**继承**: `Hi\Database\Query\Query`

## 方法

### Public 方法

#### `select`

```php
public function select(array $columns = [], string $table = '', bool $readonly = 'false'): Hi\Database\Query\MySQL\Select
```

Create a new select query

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$columns` | `array` | [] | the columns to select |
| `$table` | `string` | '' |  |
| `$readonly` | `bool` | 'false' |  |

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

#### `transaction`

```php
public function transaction(string $name, callable $callback): mixed
```

执行闭包事务

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$callback` | `callable` | - |  |

**返回**: `mixed`

#### `beginTransaction`

```php
public function beginTransaction(): void
```

开始事务

**返回**: `void`

#### `commit`

```php
public function commit(): void
```

提交事务

**返回**: `void`

#### `rollback`

```php
public function rollback(): void
```

回滚事务

**返回**: `void`

