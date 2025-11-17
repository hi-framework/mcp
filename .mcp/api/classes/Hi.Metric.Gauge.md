---
fqcn: Hi\Metric\Gauge
type: class
namespace: Hi\Metric
module: Metric
file: src/Metric/Gauge.php
line: 9
---
# Gauge

**命名空间**: `Hi\Metric`

**类型**: Class

**文件**: `src/Metric/Gauge.php:9`

## 继承关系

**继承**: `Hi\Metric\Collector`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$gauge` | `Hi\Metric\Prometheus\Gauge` | private | - |  |

## 方法

### Public 方法

#### `set`

```php
public function set(float $value, array $labelValues = []): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$value` | `float` | - |  |
| `$labelValues` | `array` | [] |  |

**返回**: `void`

#### `inc`

```php
public function inc(array $labelValues = []): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$labelValues` | `array` | [] |  |

**返回**: `void`

#### `incBy`

```php
public function incBy(float $value, array $labelValues = []): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$value` | `float` | - |  |
| `$labelValues` | `array` | [] |  |

**返回**: `void`

#### `dec`

```php
public function dec(array $labelValues = []): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$labelValues` | `array` | [] |  |

**返回**: `void`

#### `decBy`

```php
public function decBy(float $value, array $labelValues = []): void
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

