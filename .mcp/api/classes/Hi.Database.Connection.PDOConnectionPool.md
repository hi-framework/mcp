---
fqcn: Hi\Database\Connection\PDOConnectionPool
type: class
namespace: Hi\Database\Connection
module: Database
file: src/Database/Connection/PDOConnectionPool.php
line: 15
---
# PDOConnectionPool

**命名空间**: `Hi\Database\Connection`

**类型**: Class

**文件**: `src/Database/Connection/PDOConnectionPool.php:15`

**修饰符**: abstract

## 继承关系

**继承**: `Hi\ConnectionPool\Pool`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$config` | `Hi\Database\Connection\PDOConnectionConfig` | protected | - |  |
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

