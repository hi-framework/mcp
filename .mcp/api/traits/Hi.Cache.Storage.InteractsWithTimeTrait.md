---
fqcn: Hi\Cache\Storage\InteractsWithTimeTrait
type: trait
namespace: Hi\Cache\Storage
module: Cache
file: src/Cache/Storage/InteractsWithTimeTrait.php
line: 7
---
# InteractsWithTimeTrait

**命名空间**: `Hi\Cache\Storage`

**类型**: Trait

**文件**: `src/Cache/Storage/InteractsWithTimeTrait.php:7`

## 方法

### Protected 方法

#### `now`

```php
protected function now(): Hi\Cache\Storage\DateTimeImmutable
```

Please note that this interface currently emulates the behavior of the
PSR-20 implementation and may be replaced by the `psr/clock`
implementation in future versions.

**返回**: `Hi\Cache\Storage\DateTimeImmutable`

#### `ttlToTimestamp`

```php
protected function ttlToTimestamp(null|int|Hi\Cache\Storage\DateInterval|Hi\Cache\Storage\DateTimeInterface $ttl = 'null'): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$ttl` | `null\|int\|Hi\Cache\Storage\DateInterval\|Hi\Cache\Storage\DateTimeInterface` | 'null' |  |

**返回**: `int`

