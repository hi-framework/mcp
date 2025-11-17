---
module: Sidecar
namespaces: [Hi\Sidecar, Hi\Sidecar\Connection, Hi\Sidecar\Exception]
class_count: 9
interface_count: 1
trait_count: 0
enum_count: 0
attribute_count: 0
---
# Sidecar 模块

边车服务支持

## 概览

- 类: 9
- 接口: 1
- Traits: 0
- 枚举: 0
- Attributes: 0

## 使用指南

- [Sidecar 架构](../guides/sidecar/architecture.md)

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
| [`BridgeInterface`](../api/interfaces/Hi.Sidecar.BridgeInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`NullBridge`](../api/classes/Hi.Sidecar.NullBridge.md) |  |
| [`BridgePool`](../api/classes/Hi.Sidecar.Connection.BridgePool.md) |  |
| [`BridgeConnection`](../api/classes/Hi.Sidecar.Connection.BridgeConnection.md) |  |
| [`Bridge`](../api/classes/Hi.Sidecar.Bridge.md) |  |
| [`SidecarConfigException`](../api/classes/Hi.Sidecar.Exception.SidecarConfigException.md) |  |
| [`SidecarClosedException`](../api/classes/Hi.Sidecar.Exception.SidecarClosedException.md) |  |
| [`SidecarException`](../api/classes/Hi.Sidecar.Exception.SidecarException.md) |  |
| [`SidecarConnectException`](../api/classes/Hi.Sidecar.Exception.SidecarConnectException.md) |  |
| [`SidecarCallException`](../api/classes/Hi.Sidecar.Exception.SidecarCallException.md) |  |

