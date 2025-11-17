---
fqcn: Hi\Kernel\Config
type: class
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/Config.php
line: 7
---
# Config

**命名空间**: `Hi\Kernel`

**类型**: Class

**文件**: `src/Kernel/Config.php:7`

## 继承关系

**实现**: `Hi\Kernel\ConfigInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$cache` | `array` | protected | [] | Simple cache |
| `$isLocked` | `bool` | protected | 'false' |  |
| `$data` | `array` | protected | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $data = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | [] |  |

**返回**: `void`

#### `lock`

```php
public function lock(): Hi\Kernel\ConfigInterface
```

**返回**: `Hi\Kernel\ConfigInterface`

#### `get`

```php
public function get(string $key, mixed $defaultValue = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$defaultValue` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `has`

```php
public function has(string $key): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `bool`

#### `set`

```php
public function set(string $key, mixed $value): Hi\Kernel\ConfigInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `Hi\Kernel\ConfigInterface`

#### `forget`

```php
public function forget(string $key): Hi\Kernel\ConfigInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `Hi\Kernel\ConfigInterface`

#### `getOrFail`

```php
public function getOrFail(string $key): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `mixed`

#### `toArray`

```php
public function toArray(): array
```

**返回**: `array`

#### `merge`

```php
public function merge(array $config): Hi\Kernel\ConfigInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `Hi\Kernel\ConfigInterface`

### Protected 方法

#### `clearRelatedCacheForSet`

```php
protected function clearRelatedCacheForSet(string $key): void
```

Clear cache entries related to a key for set operations.
This includes the key itself, any child keys, and any parent keys that might be affected.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `void`

#### `clearRelatedCache`

```php
protected function clearRelatedCache(string $key): void
```

Clear cache entries related to a key.
This includes the key itself and any child keys that start with the key prefix.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `void`

#### `arrayDeepMerge`

```php
protected function arrayDeepMerge(array $array1, array $array2): array
```

Deep merge two arrays.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$array1` | `array` | - |  |
| `$array2` | `array` | - |  |

**返回**: `array`

