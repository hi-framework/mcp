---
fqcn: Hi\Redis\MetricCollectorInterface
type: interface
namespace: Hi\Redis
module: Redis
file: src/Redis/MetricCollectorInterface.php
line: 7
---
# MetricCollectorInterface

**命名空间**: `Hi\Redis`

**类型**: Interface

**文件**: `src/Redis/MetricCollectorInterface.php:7`

## 方法

### Public 方法

#### `collect`

```php
public function collect(string $connection, string $command, array $arguments, float $startTime, bool $error = 'false'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `string` | - | redis connection |
| `$command` | `string` | - | redis command |
| `$arguments` | `array` | - | redis key or arguments |
| `$startTime` | `float` | - | redis command start time |
| `$error` | `bool` | 'false' | redis command error |

**返回**: `void`

