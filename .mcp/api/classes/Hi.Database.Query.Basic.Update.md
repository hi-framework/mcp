---
fqcn: Hi\Database\Query\Basic\Update
type: class
namespace: Hi\Database\Query\Basic
module: Database
file: src/Database/Query/Basic/Update.php
line: 11
---
# Update

**命名空间**: `Hi\Database\Query\Basic`

**类型**: Class

**文件**: `src/Database/Query/Basic/Update.php:11`

## 继承关系

**继承**: `Hi\Database\Query\Basic\DMLBuilder`

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
public function __construct(Hi\Database\Query\Bridge $bridge, mixed $builder, string $table)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$bridge` | `Hi\Database\Query\Bridge` | - |  |
| `$builder` | `mixed` | - |  |
| `$table` | `string` | - |  |

**返回**: `void`

#### `table`

```php
public function table(string $table): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$table` | `string` | - |  |

**返回**: `self`

