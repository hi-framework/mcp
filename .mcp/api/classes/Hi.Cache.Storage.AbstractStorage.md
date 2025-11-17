---
fqcn: Hi\Cache\Storage\AbstractStorage
type: class
namespace: Hi\Cache\Storage
module: Cache
file: src/Cache/Storage/AbstractStorage.php
line: 13
---
# AbstractStorage

**命名空间**: `Hi\Cache\Storage`

**类型**: Class

**文件**: `src/Cache/Storage/AbstractStorage.php:13`

**修饰符**: abstract

Abstract base class for all cache storage implementations.

## 继承关系

**实现**: `Psr\SimpleCache\CacheInterface`

**使用 Traits**: `Hi\Cache\Storage\InteractsWithTimeTrait`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$defaultTtl` | `int` | protected | 86400 | Default TTL for cache items (1 day). |
| `$prefix` | `string` | protected | '' | Optional prefix for all cache keys to create namespace isolation. |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(?int $ttl = 'null', string $prefix = '')
```

Constructor.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$ttl` | `?int` | 'null' |  |
| `$prefix` | `string` | '' |  |

**返回**: `void`

#### `getMultiple`

```php
public function getMultiple(iterable $keys, mixed $default = 'null'): iterable
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$keys` | `iterable` | - |  |
| `$default` | `mixed` | 'null' |  |

**返回**: `iterable`

#### `setMultiple`

```php
public function setMultiple(iterable $values, null|int|Hi\Cache\Storage\DateInterval|Hi\Cache\Storage\DateTimeInterface $ttl = 'null'): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$values` | `iterable` | - |  |
| `$ttl` | `null\|int\|Hi\Cache\Storage\DateInterval\|Hi\Cache\Storage\DateTimeInterface` | 'null' |  |

**返回**: `bool`

#### `deleteMultiple`

```php
public function deleteMultiple(iterable $keys): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$keys` | `iterable` | - |  |

**返回**: `bool`

### Protected 方法

#### `getPrefixedKey`

```php
protected function getPrefixedKey(string $key): string
```

Get a namespaced version of the cache key.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `string`

#### `validateKey`

```php
protected function validateKey(string $key): void
```

Validates if a cache key is valid according to PSR-16.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `void`

**抛出异常**:

- `InvalidArgumentException` - When the key is invalid

