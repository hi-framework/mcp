---
fqcn: Hi\Database\Query\Traits\WhereTrait
type: trait
namespace: Hi\Database\Query\Traits
module: Database
file: src/Database/Query/Traits/WhereTrait.php
line: 7
---
# WhereTrait

**命名空间**: `Hi\Database\Query\Traits`

**类型**: Trait

**文件**: `src/Database/Query/Traits/WhereTrait.php:7`

## 方法

### Public 方法

#### `where`

```php
public function where(callable|string $cond, array $bind = []): self
```

Adds a WHERE condition to the query by AND.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cond` | `callable\|string` | - | the WHERE condition |
| `$bind` | `array` | [] | Values to be bound to placeholders |

**返回**: `self`

#### `orWhere`

```php
public function orWhere(callable|string $cond, array $bind = []): self
```

Adds a WHERE condition to the query by OR. If the condition has
?-placeholders, additional arguments to the method will be bound to
those placeholders sequentially.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cond` | `callable\|string` | - | the WHERE condition |
| `$bind` | `array` | [] | Values to be bound to placeholders |

**返回**: `self`

