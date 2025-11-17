---
fqcn: Hi\Cache\Storage\FileStorage
type: class
namespace: Hi\Cache\Storage
module: Cache
file: src/Cache/Storage/FileStorage.php
line: 10
---
# FileStorage

**命名空间**: `Hi\Cache\Storage`

**类型**: Class

**文件**: `src/Cache/Storage/FileStorage.php:10`

## 继承关系

**继承**: `Hi\Cache\Storage\AbstractStorage`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$files` | `Spiral\Files\FilesInterface` | private readonly | - |  |
| `$path` | `string` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Spiral\Files\FilesInterface $files, string $path, ?int $ttl = 'null', string $prefix = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$files` | `Spiral\Files\FilesInterface` | - |  |
| `$path` | `string` | - |  |
| `$ttl` | `?int` | 'null' |  |
| `$prefix` | `string` | '' |  |

**返回**: `void`

#### `get`

```php
public function get(string $key, mixed $default = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$default` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `set`

```php
public function set(string $key, mixed $value, null|int|Hi\Cache\Storage\DateInterval|Hi\Cache\Storage\DateTimeInterface $ttl = 'null'): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$value` | `mixed` | - |  |
| `$ttl` | `null\|int\|Hi\Cache\Storage\DateInterval\|Hi\Cache\Storage\DateTimeInterface` | 'null' |  |

**返回**: `bool`

#### `delete`

```php
public function delete(string $key): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `bool`

#### `clear`

```php
public function clear(): bool
```

**返回**: `bool`

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

#### `has`

```php
public function has(string $key): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `bool`

### Protected 方法

#### `getPrefixDirectory`

```php
protected function getPrefixDirectory(): string
```

Get the directory path corresponding to the prefix.

**返回**: `string`

#### `makePath`

```php
protected function makePath(string $key): string
```

Make the full path for the given cache key.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `string`

#### `getPayload`

```php
protected function getPayload(string $key): array
```

Retrieve an item and expiry time from the cache by key.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `array`

#### `makeEmptyPayload`

```php
protected function makeEmptyPayload(): array
```

Make a default empty payload for the cache.

**返回**: `array`

