---
module: Redis
namespaces: [Hi\Redis, Hi\Redis\Exception]
class_count: 9
interface_count: 3
trait_count: 0
enum_count: 0
attribute_count: 0
---
# Redis 模块

Redis 客户端和连接池

## 概览

- 类: 9
- 接口: 3
- Traits: 0
- 枚举: 0
- Attributes: 0

## 使用指南

- [Redis 连接配置](../guides/redis/connection.md)
- [Redis 数据操作](../guides/redis/operations.md)
- [Redis 连接池](../guides/components/redis.md)

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
| [`MetricCollectorInterface`](../api/interfaces/Hi.Redis.MetricCollectorInterface.md) |  |
| [`RedisProviderInterface`](../api/interfaces/Hi.Redis.RedisProviderInterface.md) |  |
| [`RedisInterface`](../api/interfaces/Hi.Redis.RedisInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`ConnectionConfig`](../api/classes/Hi.Redis.ConnectionConfig.md) |  |
| [`RedisConnection`](../api/classes/Hi.Redis.RedisConnection.md) |  |
| [`RedisManager`](../api/classes/Hi.Redis.RedisManager.md) |  |
| [`Redis`](../api/classes/Hi.Redis.Redis.md) |  |
| [`RedisPool`](../api/classes/Hi.Redis.RedisPool.md) |  |
| [`RedisException`](../api/classes/Hi.Redis.Exception.RedisException.md) |  |
| [`RedisConfigInvalidException`](../api/classes/Hi.Redis.Exception.RedisConfigInvalidException.md) |  |
| [`RedisConfigNotFoundException`](../api/classes/Hi.Redis.Exception.RedisConfigNotFoundException.md) |  |
| [`Brigde`](../api/classes/Hi.Redis.Brigde.md) |  |

