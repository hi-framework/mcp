---
fqcn: Hi\ConnectionPool\MetricCollectorInterface
type: interface
namespace: Hi\ConnectionPool
module: ConnectionPool
file: src/ConnectionPool/MetricCollectorInterface.php
line: 7
---
# MetricCollectorInterface

**命名空间**: `Hi\ConnectionPool`

**类型**: Interface

**文件**: `src/ConnectionPool/MetricCollectorInterface.php:7`

## 方法

### Public 方法

#### `collect`

```php
public function collect(string $poolName, int $inUsingCount, int $idleCount, int $releasedCount): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$poolName` | `string` | - | the pool name |
| `$inUsingCount` | `int` | - | the number of connections in use |
| `$idleCount` | `int` | - | the number of idle connections |
| `$releasedCount` | `int` | - | the number of connections released |

**返回**: `void`

