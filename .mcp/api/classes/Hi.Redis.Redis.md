---
fqcn: Hi\Redis\Redis
type: class
namespace: Hi\Redis
module: Redis
file: src/Redis/Redis.php
line: 7
---
# Redis

**命名空间**: `Hi\Redis`

**类型**: Class

**文件**: `src/Redis/Redis.php:7`

## 继承关系

**实现**: `Hi\Redis\RedisInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$connection` | `string` | protected | - | Connection name |
| `$redis` | `Hi\Redis\Brigde` | protected | - |  |

## 方法

### Public 方法

#### `autowirePool`

```php
public function autowirePool(Hi\Redis\RedisProviderInterface $manager, ?Hi\Redis\MetricCollectorInterface $collector = 'null'): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$manager` | `Hi\Redis\RedisProviderInterface` | - |  |
| `$collector` | `?Hi\Redis\MetricCollectorInterface` | 'null' |  |

**返回**: `self`

#### `setBrigde`

```php
public function setBrigde(Hi\Redis\Brigde $redis): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$redis` | `Hi\Redis\Brigde` | - |  |

**返回**: `void`

