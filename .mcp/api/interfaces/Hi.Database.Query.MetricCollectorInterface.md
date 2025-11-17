---
fqcn: Hi\Database\Query\MetricCollectorInterface
type: interface
namespace: Hi\Database\Query
module: Database
file: src/Database/Query/MetricCollectorInterface.php
line: 7
---
# MetricCollectorInterface

**命名空间**: `Hi\Database\Query`

**类型**: Interface

**文件**: `src/Database/Query/MetricCollectorInterface.php:7`

## 方法

### Public 方法

#### `collect`

```php
public function collect(string $connection, string $sql, array $bind, float $startTime, bool $error = 'false'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `string` | - | db connection |
| `$sql` | `string` | - | db command |
| `$bind` | `array` | - |  |
| `$startTime` | `float` | - | db command start time |
| `$error` | `bool` | 'false' |  |

**返回**: `void`

