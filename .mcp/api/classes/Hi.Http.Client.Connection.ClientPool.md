---
fqcn: Hi\Http\Client\Connection\ClientPool
type: class
namespace: Hi\Http\Client\Connection
module: Http
file: src/Http/Client/Connection/ClientPool.php
line: 12
---
# ClientPool

**命名空间**: `Hi\Http\Client\Connection`

**类型**: Class

**文件**: `src/Http/Client/Connection/ClientPool.php:12`

**修饰符**: abstract

## 继承关系

**继承**: `Hi\ConnectionPool\Pool`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$config` | `Hi\Http\Client\Connection\ClientConnectionConfig` | protected | - |  |
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

#### `initConfig`

**标记**: abstract

```php
abstract protected function initConfig(array $config): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `void`

