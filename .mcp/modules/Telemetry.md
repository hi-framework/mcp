---
module: Telemetry
namespaces: [Hi\Telemetry, Hi\Telemetry\Span]
class_count: 2
interface_count: 2
trait_count: 0
enum_count: 1
attribute_count: 0
---
# Telemetry 模块

遥测数据收集

## 概览

- 类: 2
- 接口: 2
- Traits: 0
- 枚举: 1
- Attributes: 0

## 使用指南

- [Telemetry 遥测](../guides/components/telemetry.md)

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
| [`TracerInterface`](../api/interfaces/Hi.Telemetry.TracerInterface.md) |  |
| [`SpanInterface`](../api/interfaces/Hi.Telemetry.SpanInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`Span`](../api/classes/Hi.Telemetry.Span.md) |  |
| [`Status`](../api/classes/Hi.Telemetry.Span.Status.md) |  |

### 枚举

| 名称 | 描述 |
| --- | --- |
| [`TraceKind`](../api/enums/Hi.Telemetry.TraceKind.md) |  |

