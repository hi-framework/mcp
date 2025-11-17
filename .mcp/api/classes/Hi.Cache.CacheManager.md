---
fqcn: Hi\Cache\CacheManager
type: class
namespace: Hi\Cache
module: Cache
file: src/Cache/CacheManager.php
line: 15
---
# CacheManager

**命名空间**: `Hi\Cache`

**类型**: Class

**文件**: `src/Cache/CacheManager.php:15`

## 继承关系

**实现**: `Hi\Cache\CacheStorageProviderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$storages` | `array` | private | [] |  |
| `$configs` | `array` | protected readonly | - |  |
| `$container` | `Psr\Container\ContainerInterface` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $configs, Psr\Container\ContainerInterface $container)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$configs` | `array` | - |  |
| `$container` | `Psr\Container\ContainerInterface` | - |  |

**返回**: `void`

#### `storage`

```php
public function storage(string $name): Psr\SimpleCache\CacheInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Psr\SimpleCache\CacheInterface`

#### `getOrCreateRedisPool`

```php
public function getOrCreateRedisPool(string $name, array $config): Hi\Redis\RedisPool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$config` | `array` | - |  |

**返回**: `Hi\Redis\RedisPool`

### Protected 方法

#### `initialize`

```php
protected function initialize(string $name): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `void`

#### `getStorageConfig`

```php
protected function getStorageConfig(string $name): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `array`

