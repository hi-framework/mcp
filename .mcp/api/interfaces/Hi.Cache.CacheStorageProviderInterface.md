---
fqcn: Hi\Cache\CacheStorageProviderInterface
type: interface
namespace: Hi\Cache
module: Cache
file: src/Cache/CacheStorageProviderInterface.php
line: 10
---
# CacheStorageProviderInterface

**命名空间**: `Hi\Cache`

**类型**: Interface

**文件**: `src/Cache/CacheStorageProviderInterface.php:10`

## 方法

### Public 方法

#### `storage`

```php
public function storage(string $name): Psr\SimpleCache\CacheInterface
```

Get a cache storage instance by name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Psr\SimpleCache\CacheInterface`

**抛出异常**:

- `StorageException`

