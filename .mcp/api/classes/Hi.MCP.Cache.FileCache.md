---
fqcn: Hi\MCP\Cache\FileCache
type: class
namespace: Hi\MCP\Cache
module: MCP
file: src/MCP/Cache/FileCache.php
line: 12
---
# FileCache

**命名空间**: `Hi\MCP\Cache`

**类型**: Class

**文件**: `src/MCP/Cache/FileCache.php:12`

文件系统缓存实现

将缓存数据存储为文件

## 继承关系

**实现**: `Hi\MCP\Cache\CacheInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$cachePath` | `string` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $cachePath)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cachePath` | `string` | - |  |

**返回**: `void`

#### `get`

```php
public function get(string $key): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `mixed`

#### `set`

```php
public function set(string $key, mixed $value, int $ttl = 0): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$value` | `mixed` | - |  |
| `$ttl` | `int` | 0 |  |

**返回**: `void`

#### `has`

```php
public function has(string $key): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `bool`

#### `delete`

```php
public function delete(string $key): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `void`

#### `clear`

```php
public function clear(): void
```

**返回**: `void`

