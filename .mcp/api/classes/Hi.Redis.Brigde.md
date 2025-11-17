---
fqcn: Hi\Redis\Brigde
type: class
namespace: Hi\Redis
module: Redis
file: src/Redis/Brigde.php
line: 7
---
# Brigde

**命名空间**: `Hi\Redis`

**类型**: Class

**文件**: `src/Redis/Brigde.php:7`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$metricCollector` | `?Hi\Redis\MetricCollectorInterface` | protected | 'null' |  |
| `$manager` | `Hi\Redis\RedisProviderInterface` | protected | - |  |
| `$connection` | `string` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Redis\RedisProviderInterface $manager, string $connection, ?Hi\Redis\MetricCollectorInterface $metricCollector = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$manager` | `Hi\Redis\RedisProviderInterface` | - |  |
| `$connection` | `string` | - |  |
| `$metricCollector` | `?Hi\Redis\MetricCollectorInterface` | 'null' |  |

**返回**: `void`

#### `__serialize`

```php
public function __serialize(): array
```

**返回**: `array`

#### `__unserialize`

```php
public function __unserialize(array $data): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |

**返回**: `void`

#### `__call`

```php
public function __call(string $name, array $arguments): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$arguments` | `array` | - |  |

**返回**: `mixed`

#### `builtIn`

```php
public function builtIn(callable $callback): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |

**返回**: `mixed`

