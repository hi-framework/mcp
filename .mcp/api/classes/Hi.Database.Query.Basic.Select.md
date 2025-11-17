---
fqcn: Hi\Database\Query\Basic\Select
type: class
namespace: Hi\Database\Query\Basic
module: Database
file: src/Database/Query/Basic/Select.php
line: 11
---
# Select

**命名空间**: `Hi\Database\Query\Basic`

**类型**: Class

**文件**: `src/Database/Query/Basic/Select.php:11`

## 继承关系

**继承**: `Hi\Database\Query\Basic\Builder`

**实现**: `Aura\SqlQuery\Common\SelectInterface`

**使用 Traits**: `Hi\Database\Query\Traits\WhereTrait`

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

#### `first`

```php
public function first(): array|false
```

Executes the query and fetch frist row from the database

**返回**: `array|false`

#### `count`

```php
public function count(string $key = 'total'): ?int
```

Get the total count of the query

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | 'total' |  |

**返回**: `?int`

#### `fetch`

```php
public function fetch(int $mode = 'PDO::FETCH_ASSOC'): mixed
```

Executes the query and fetch frist row from the database

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$mode` | `int` | 'PDO::FETCH_ASSOC' |  |

**返回**: `mixed`

#### `fetchAll`

```php
public function fetchAll(int $mode = 'PDO::FETCH_ASSOC'): mixed
```

Executes the query and fetch all rows from the database

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$mode` | `int` | 'PDO::FETCH_ASSOC' |  |

**返回**: `mixed`

#### `limit`

```php
public function limit(int $limit): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$limit` | `int` | - |  |

**返回**: `self`

#### `getLimit`

```php
public function getLimit(): int
```

**返回**: `int`

#### `offset`

```php
public function offset(int $offset): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `int` | - |  |

**返回**: `self`

#### `getOffset`

```php
public function getOffset(): int
```

**返回**: `int`

#### `orderBy`

```php
public function orderBy(array $spec): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `array` | - |  |

**返回**: `self`

#### `setPaging`

```php
public function setPaging(int $paging): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$paging` | `int` | - |  |

**返回**: `self`

#### `getPaging`

```php
public function getPaging(): int
```

**返回**: `int`

#### `forUpdate`

```php
public function forUpdate(bool $enable = 'true'): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' |  |

**返回**: `self`

#### `distinct`

```php
public function distinct(bool $enable = 'true'): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enable` | `bool` | 'true' |  |

**返回**: `self`

#### `isDistinct`

```php
public function isDistinct(): bool
```

**返回**: `bool`

#### `cols`

```php
public function cols(array $cols): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cols` | `array` | - |  |

**返回**: `self`

#### `removeCol`

```php
public function removeCol(string $alias): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$alias` | `string` | - |  |

**返回**: `bool`

#### `hasCol`

```php
public function hasCol(string $alias): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$alias` | `string` | - |  |

**返回**: `bool`

#### `hasCols`

```php
public function hasCols(): bool
```

**返回**: `bool`

#### `getCols`

```php
public function getCols(): array
```

**返回**: `array`

#### `from`

```php
public function from(string $spec): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `string` | - |  |

**返回**: `self`

#### `fromRaw`

```php
public function fromRaw(string $spec): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `string` | - |  |

**返回**: `self`

#### `fromSubSelect`

```php
public function fromSubSelect(string|Aura\SqlQuery\Common\SelectInterface $spec, string $name): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `string\|Aura\SqlQuery\Common\SelectInterface` | - |  |
| `$name` | `string` | - |  |

**返回**: `self`

#### `join`

```php
public function join(string $join, string $spec, ?string $cond = 'null', array $bind = []): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$join` | `string` | - |  |
| `$spec` | `string` | - |  |
| `$cond` | `?string` | 'null' |  |
| `$bind` | `array` | [] |  |

**返回**: `self`

#### `innerJoin`

```php
public function innerJoin(string $spec, ?string $cond = 'null', array $bind = []): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `string` | - |  |
| `$cond` | `?string` | 'null' |  |
| `$bind` | `array` | [] |  |

**返回**: `self`

#### `leftJoin`

```php
public function leftJoin(string $spec, ?string $cond = 'null', array $bind = []): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `string` | - |  |
| `$cond` | `?string` | 'null' |  |
| `$bind` | `array` | [] |  |

**返回**: `self`

#### `joinSubSelect`

```php
public function joinSubSelect(string $join, string|Aura\SqlQuery\Common\SelectInterface $spec, string $name, ?string $cond = 'null', array $bind = []): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$join` | `string` | - |  |
| `$spec` | `string\|Aura\SqlQuery\Common\SelectInterface` | - |  |
| `$name` | `string` | - |  |
| `$cond` | `?string` | 'null' |  |
| `$bind` | `array` | [] |  |

**返回**: `self`

#### `groupBy`

```php
public function groupBy(array $spec): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$spec` | `array` | - |  |

**返回**: `self`

#### `having`

```php
public function having(callable|string $cond, array $bind = []): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cond` | `callable\|string` | - |  |
| `$bind` | `array` | [] |  |

**返回**: `self`

#### `orHaving`

```php
public function orHaving(callable|string $cond, array $bind = []): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cond` | `callable\|string` | - |  |
| `$bind` | `array` | [] |  |

**返回**: `self`

#### `page`

```php
public function page(int $page): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$page` | `int` | - |  |

**返回**: `self`

#### `getPage`

```php
public function getPage(): int
```

**返回**: `int`

#### `union`

```php
public function union(): self
```

**返回**: `self`

#### `unionAll`

```php
public function unionAll(): self
```

**返回**: `self`

#### `reset`

```php
public function reset(): void
```

**返回**: `void`

#### `resetCols`

```php
public function resetCols(): self
```

**返回**: `self`

#### `resetTables`

```php
public function resetTables(): self
```

**返回**: `self`

#### `resetWhere`

```php
public function resetWhere(): self
```

**返回**: `self`

#### `resetGroupBy`

```php
public function resetGroupBy(): self
```

**返回**: `self`

#### `resetHaving`

```php
public function resetHaving(): self
```

**返回**: `self`

#### `resetOrderBy`

```php
public function resetOrderBy(): self
```

**返回**: `self`

#### `resetUnions`

```php
public function resetUnions(): self
```

**返回**: `self`

