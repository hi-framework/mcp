---
fqcn: Hi\Database\Query\ClickHouse\Select
type: class
namespace: Hi\Database\Query\ClickHouse
module: Database
file: src/Database/Query/ClickHouse/Select.php
line: 10
---
# Select

**命名空间**: `Hi\Database\Query\ClickHouse`

**类型**: Class

**文件**: `src/Database/Query/ClickHouse/Select.php:10`

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

