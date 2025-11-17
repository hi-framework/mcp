---
fqcn: Hi\Metric\Collector
type: class
namespace: Hi\Metric
module: Metric
file: src/Metric/Collector.php
line: 10
---
# Collector

**命名空间**: `Hi\Metric`

**类型**: Class

**文件**: `src/Metric/Collector.php:10`

**修饰符**: abstract

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | protected | - | Metric name |
| `$help` | `string` | protected | - | Metric help |
| `$labels` | `array` | protected | [] | Metric labels |
| `$namespace` | `string` | protected | '' | Metric namespace |
| `$inited` | `bool` | protected | 'false' | Init flag |
| `$logger` | `Psr\Log\LoggerInterface` | protected readonly | - |  |
| `$registry` | `Prometheus\RegistryInterface` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger, Prometheus\RegistryInterface $registry)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |
| `$registry` | `Prometheus\RegistryInterface` | - |  |

**返回**: `void`

### Protected 方法

#### `error`

```php
protected function error(string $type, string $action, string $name, Hi\Metric\Throwable $th): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$type` | `string` | - |  |
| `$action` | `string` | - |  |
| `$name` | `string` | - |  |
| `$th` | `Hi\Metric\Throwable` | - |  |

**返回**: `void`

