---
fqcn: Hi\Database\Query\MySQL\Factory
type: class
namespace: Hi\Database\Query\MySQL
module: Database
file: src/Database/Query/MySQL/Factory.php
line: 10
---
# Factory

**命名空间**: `Hi\Database\Query\MySQL`

**类型**: Class

**文件**: `src/Database/Query/MySQL/Factory.php:10`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$builderFactory` | `?Aura\SqlQuery\QueryFactory` | private static | 'null' |  |

## 方法

### Public 方法

#### `newSelect`

**标记**: static

```php
public static function newSelect(): Aura\SqlQuery\MySQL\Select
```

**返回**: `Aura\SqlQuery\MySQL\Select`

#### `newInsert`

**标记**: static

```php
public static function newInsert(): Aura\SqlQuery\MySQL\Insert
```

**返回**: `Aura\SqlQuery\MySQL\Insert`

#### `newDelete`

**标记**: static

```php
public static function newDelete(): Aura\SqlQuery\MySQL\Delete
```

**返回**: `Aura\SqlQuery\MySQL\Delete`

#### `newUpdate`

**标记**: static

```php
public static function newUpdate(): Aura\SqlQuery\MySQL\Update
```

**返回**: `Aura\SqlQuery\MySQL\Update`

