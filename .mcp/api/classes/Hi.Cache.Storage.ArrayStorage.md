---
fqcn: Hi\Cache\Storage\ArrayStorage
type: class
namespace: Hi\Cache\Storage
module: Cache
file: src/Cache/Storage/ArrayStorage.php
line: 9
---
# ArrayStorage

**命名空间**: `Hi\Cache\Storage`

**类型**: Class

**文件**: `src/Cache/Storage/ArrayStorage.php:9`

## 继承关系

**继承**: `Hi\Cache\Storage\AbstractStorage`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$storage` | `array` | protected | [] | The array of stored values. |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(?int $ttl = 'null', string $prefix = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
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

#### `checkExpired`

```php
protected function checkExpired(string $key): bool
```

Check and delete the key if it is expired.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `bool`

