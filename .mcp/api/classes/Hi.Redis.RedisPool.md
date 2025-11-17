---
fqcn: Hi\Redis\RedisPool
type: class
namespace: Hi\Redis
module: Redis
file: src/Redis/RedisPool.php
line: 15
---
# RedisPool

**命名空间**: `Hi\Redis`

**类型**: Class

**文件**: `src/Redis/RedisPool.php:15`

## 继承关系

**继承**: `Hi\ConnectionPool\Pool`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$config` | `Hi\Redis\ConnectionConfig` | protected | - |  |
| `$name` | `string` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, array $config, Psr\Log\LoggerInterface $logger, ?Hi\ConnectionPool\MetricCollectorInterface $collector = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$config` | `array` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |
| `$collector` | `?Hi\ConnectionPool\MetricCollectorInterface` | 'null' |  |

**返回**: `void`

#### `name`

```php
public function name(): string
```

**返回**: `string`

### Protected 方法

#### `createConnection`

```php
protected function createConnection(int $number): Hi\ConnectionPool\ConnectionInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$number` | `int` | - |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

