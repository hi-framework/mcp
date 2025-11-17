---
module: ConnectionPool
namespaces: [Hi\ConnectionPool, Hi\ConnectionPool\Exception]
class_count: 5
interface_count: 3
trait_count: 0
enum_count: 0
attribute_count: 0
---
# ConnectionPool 模块

通用连接池管理

## 概览

- 类: 5
- 接口: 3
- Traits: 0
- 枚举: 0
- Attributes: 0

## 使用指南

- [连接池概述](../guides/connection-pool/overview.md)
- [连接池配置管理](../guides/connection-pool/configuration.md)

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
| [`ConnectionInterface`](../api/interfaces/Hi.ConnectionPool.ConnectionInterface.md) |  |
| [`PoolInterface`](../api/interfaces/Hi.ConnectionPool.PoolInterface.md) |  |
| [`MetricCollectorInterface`](../api/interfaces/Hi.ConnectionPool.MetricCollectorInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`Connection`](../api/classes/Hi.ConnectionPool.Connection.md) |  |
| [`Pool`](../api/classes/Hi.ConnectionPool.Pool.md) | Abstract connection pool implementation |
| [`Manager`](../api/classes/Hi.ConnectionPool.Manager.md) |  |
| [`ConnectionPoolException`](../api/classes/Hi.ConnectionPool.Exception.ConnectionPoolException.md) |  |
| [`GetConnectionTimeoutException`](../api/classes/Hi.ConnectionPool.Exception.GetConnectionTimeoutException.md) |  |

