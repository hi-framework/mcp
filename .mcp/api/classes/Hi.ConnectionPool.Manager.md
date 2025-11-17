---
fqcn: Hi\ConnectionPool\Manager
type: class
namespace: Hi\ConnectionPool
module: ConnectionPool
file: src/ConnectionPool/Manager.php
line: 10
---
# Manager

**命名空间**: `Hi\ConnectionPool`

**类型**: Class

**文件**: `src/ConnectionPool/Manager.php:10`

**修饰符**: abstract

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$pools` | `array` | protected | [] |  |
| `$container` | `Psr\Container\ContainerInterface` | protected readonly | - |  |
| `$configs` | `array` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Container\ContainerInterface $container, array $configs)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$configs` | `array` | - |  |

**返回**: `void`

#### `finalize`

```php
public function finalize(): void
```

**返回**: `void`

#### `getPool`

```php
public function getPool(string $name): Hi\ConnectionPool\PoolInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\PoolInterface`

#### `getConnection`

```php
public function getConnection(string $name): Hi\ConnectionPool\ConnectionInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Hi\ConnectionPool\ConnectionInterface`

### Protected 方法

#### `initialize`

**标记**: abstract

```php
abstract protected function initialize(string $name): void
```

Connection pool initialization by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `void`

