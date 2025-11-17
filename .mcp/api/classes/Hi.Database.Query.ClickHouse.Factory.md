---
fqcn: Hi\Database\Query\ClickHouse\Factory
type: class
namespace: Hi\Database\Query\ClickHouse
module: Database
file: src/Database/Query/ClickHouse/Factory.php
line: 10
---
# Factory

**命名空间**: `Hi\Database\Query\ClickHouse`

**类型**: Class

**文件**: `src/Database/Query/ClickHouse/Factory.php:10`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$builderFactory` | `?Aura\SqlQuery\QueryFactory` | private static | 'null' |  |

## 方法

### Public 方法

#### `newSelect`

**标记**: static

```php
public static function newSelect(): Aura\SqlQuery\Common\Select
```

**返回**: `Aura\SqlQuery\Common\Select`

#### `newInsert`

**标记**: static

```php
public static function newInsert(): Aura\SqlQuery\Common\Insert
```

**返回**: `Aura\SqlQuery\Common\Insert`

#### `newDelete`

**标记**: static

```php
public static function newDelete(): Aura\SqlQuery\Common\Delete
```

**返回**: `Aura\SqlQuery\Common\Delete`

#### `newUpdate`

**标记**: static

```php
public static function newUpdate(): Aura\SqlQuery\Common\Update
```

**返回**: `Aura\SqlQuery\Common\Update`

