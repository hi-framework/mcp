---
fqcn: Hi\Metric\Summary
type: class
namespace: Hi\Metric
module: Metric
file: src/Metric/Summary.php
line: 9
---
# Summary

**命名空间**: `Hi\Metric`

**类型**: Class

**文件**: `src/Metric/Summary.php:9`

## 继承关系

**继承**: `Hi\Metric\Collector`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$quantiles` | `array` | protected | - |  |
| `$maxAge` | `int` | protected | 3600 |  |
| `$summary` | `Hi\Metric\Prometheus\Summary` | private | - |  |

## 方法

### Public 方法

#### `observe`

```php
public function observe(float $value, array $labelValues = []): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$value` | `float` | - |  |
| `$labelValues` | `array` | [] |  |

**返回**: `void`

### Protected 方法

#### `send`

```php
protected function send(string $type, float $value, array $labelValues): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$type` | `string` | - |  |
| `$value` | `float` | - |  |
| `$labelValues` | `array` | - |  |

**返回**: `void`

