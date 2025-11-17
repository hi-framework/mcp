---
fqcn: Hi\MCP\Cache\CacheInterface
type: interface
namespace: Hi\MCP\Cache
module: MCP
file: src/MCP/Cache/CacheInterface.php
line: 12
---
# CacheInterface

**命名空间**: `Hi\MCP\Cache`

**类型**: Interface

**文件**: `src/MCP/Cache/CacheInterface.php:12`

缓存接口

定义缓存的基本操作

## 方法

### Public 方法

#### `get`

```php
public function get(string $key): mixed
```

获取缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - | 缓存键 |

**返回**: `mixed` - 缓存值，不存在或已失效返回 null

#### `set`

```php
public function set(string $key, mixed $value, int $ttl = 0): void
```

设置缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - | 缓存键 |
| `$value` | `mixed` | - | 缓存值 |
| `$ttl` | `int` | 0 | 过期时间（秒），0 表示永不过期 |

**返回**: `void`

#### `has`

```php
public function has(string $key): bool
```

检查缓存是否存在且有效

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - | 缓存键 |

**返回**: `bool`

#### `delete`

```php
public function delete(string $key): void
```

删除缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - | 缓存键 |

**返回**: `void`

#### `clear`

```php
public function clear(): void
```

清空所有缓存

**返回**: `void`

