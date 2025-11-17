---
module: Cache
namespaces: [Hi\Cache, Hi\Cache\Storage, Hi\Cache\Exception]
class_count: 11
interface_count: 1
trait_count: 1
enum_count: 0
attribute_count: 0
---
# Cache 模块

多后端缓存系统

## 概览

- 类: 11
- 接口: 1
- Traits: 1
- 枚举: 0
- Attributes: 0

## 使用指南

- [缓存系统概述](../guides/cache/overview.md)
- [APCu 缓存](../guides/cache/apcu.md)
- [Redis 缓存](../guides/cache/redis.md)
- [文件缓存](../guides/cache/file.md)
- [共享内存缓存](../guides/cache/shared-memory.md)
- [进程内缓存](../guides/cache/process-memory.md)
- [Cache 缓存](../guides/components/cache.md)

## 核心概念

- [生命周期](../guides/concepts/lifecycle.md)
- [作用域(Scope)](../guides/concepts/scope.md)
- [服务容器](../guides/concepts/container-and-di.md)
- [注解](../guides/concepts/attributes.md)
- [运行时系统](../guides/concepts/runtime.md)

## API 参考

### 接口

| 名称 | 描述 |
| --- | --- |
| [`CacheStorageProviderInterface`](../api/interfaces/Hi.Cache.CacheStorageProviderInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`CacheManager`](../api/classes/Hi.Cache.CacheManager.md) |  |
| [`APCuStorage`](../api/classes/Hi.Cache.Storage.APCuStorage.md) |  |
| [`ArrayStorage`](../api/classes/Hi.Cache.Storage.ArrayStorage.md) |  |
| [`RedisStorage`](../api/classes/Hi.Cache.Storage.RedisStorage.md) |  |
| [`FileStorage`](../api/classes/Hi.Cache.Storage.FileStorage.md) |  |
| [`AbstractStorage`](../api/classes/Hi.Cache.Storage.AbstractStorage.md) | Abstract base class for all cache storage implementations. |
| [`CacheConfigMissException`](../api/classes/Hi.Cache.Exception.CacheConfigMissException.md) |  |
| [`InvalidArgumentException`](../api/classes/Hi.Cache.Exception.InvalidArgumentException.md) |  |
| [`InvalidExpireTimeException`](../api/classes/Hi.Cache.Exception.InvalidExpireTimeException.md) |  |
| [`CacheException`](../api/classes/Hi.Cache.Exception.CacheException.md) |  |
| [`StorageException`](../api/classes/Hi.Cache.Exception.StorageException.md) |  |

### Traits

| 名称 | 描述 |
| --- | --- |
| [`InteractsWithTimeTrait`](../api/traits/Hi.Cache.Storage.InteractsWithTimeTrait.md) |  |

