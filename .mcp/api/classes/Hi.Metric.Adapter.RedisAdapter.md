---
fqcn: Hi\Metric\Adapter\RedisAdapter
type: class
namespace: Hi\Metric\Adapter
module: Metric
file: src/Metric/Adapter/RedisAdapter.php
line: 18
---
# RedisAdapter

**命名空间**: `Hi\Metric\Adapter`

**类型**: Class

**文件**: `src/Metric/Adapter/RedisAdapter.php:18`

## 继承关系

**实现**: `Prometheus\Storage\Adapter`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `PROMETHEUS_METRIC_KEYS_SUFFIX` | '_METRIC_KEYS' | public |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$prefix` | `string` | private static | 'PROMETHEUS_' |  |
| `$options` | `mixed[]` | private | [] |  |
| `$connection` | `string` | protected | 'prometheus' | Connection name |
| `$redis` | `Hi\Redis\Brigde` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Redis\RedisProviderInterface $manager)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$manager` | `Hi\Redis\RedisProviderInterface` | - |  |

**返回**: `void`

#### `setPrefix`

**标记**: static

```php
public static function setPrefix(string $prefix): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$prefix` | `string` | - |  |

**返回**: `void`

#### `flushRedis`

**标记**: deprecated

```php
public function flushRedis(): void
```

**返回**: `void`

**抛出异常**:

- `StorageException`

#### `wipeStorage`

```php
public function wipeStorage(): void
```

**返回**: `void`

#### `collect`

```php
public function collect(bool $sortMetrics = 'true'): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sortMetrics` | `bool` | 'true' |  |

**返回**: `array`

**抛出异常**:

- `StorageException`

#### `updateHistogram`

```php
public function updateHistogram(array $data): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |

**返回**: `void`

**抛出异常**:

- `StorageException`

#### `updateSummary`

```php
public function updateSummary(array $data): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |

**返回**: `void`

**抛出异常**:

- `StorageException`

#### `updateGauge`

```php
public function updateGauge(array $data): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |

**返回**: `void`

**抛出异常**:

- `StorageException`

#### `updateCounter`

```php
public function updateCounter(array $data): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |

**返回**: `void`

**抛出异常**:

- `StorageException`

