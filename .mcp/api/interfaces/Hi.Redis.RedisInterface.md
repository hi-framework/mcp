---
fqcn: Hi\Redis\RedisInterface
type: interface
namespace: Hi\Redis
module: Redis
file: src/Redis/RedisInterface.php
line: 7
---
# RedisInterface

**命名空间**: `Hi\Redis`

**类型**: Interface

**文件**: `src/Redis/RedisInterface.php:7`

## 方法

### Public 方法

#### `autowirePool`

```php
public function autowirePool(Hi\Redis\RedisProviderInterface $manager, ?Hi\Redis\MetricCollectorInterface $collector = 'null'): self
```

Autowire redis pool

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$manager` | `Hi\Redis\RedisProviderInterface` | - |  |
| `$collector` | `?Hi\Redis\MetricCollectorInterface` | 'null' |  |

**返回**: `self`

