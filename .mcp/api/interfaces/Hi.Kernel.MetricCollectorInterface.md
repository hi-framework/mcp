---
fqcn: Hi\Kernel\MetricCollectorInterface
type: interface
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/MetricCollectorInterface.php
line: 9
---
# MetricCollectorInterface

**命名空间**: `Hi\Kernel`

**类型**: Interface

**文件**: `src/Kernel/MetricCollectorInterface.php:9`

## 方法

### Public 方法

#### `collect`

```php
public function collect(string $scopeName, int $exitCode, float $startTime, Hi\Kernel\Console\InputInterface $input): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$scopeName` | `string` | - |  |
| `$exitCode` | `int` | - | Process exit code |
| `$startTime` | `float` | - | Command start time, in milliseconds |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |

**返回**: `void`

