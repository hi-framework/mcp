---
fqcn: Hi\Attributes\Database\Cache
type: class
namespace: Hi\Attributes\Database
module: Attributes
file: src/Attributes/Database/Cache.php
line: 19
---
# Cache

**命名空间**: `Hi\Attributes\Database`

**类型**: Class

**文件**: `src/Attributes/Database/Cache.php:19`

Method result cache attribute

Usage example:
```php
#[Cache(ttl: 3600, connection: 'cache-a')]
public function foo(): void
{
    // ...
}
```

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$ttl` | `int` | public readonly | 600 |  |
| `$connection` | `string` | public readonly | 'default' |  |
| `$key` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $ttl = 600, string $connection = 'default', string $key = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$ttl` | `int` | 600 | TTL in seconds |
| `$connection` | `string` | 'default' | Cache connection name |
| `$key` | `string` | '' | Cache key name if has |

**返回**: `void`

## Attribute 信息

**目标**: METHOD

**可重复**: 否

### 使用示例

```php
#[Cache]
class MyClass {}
```

