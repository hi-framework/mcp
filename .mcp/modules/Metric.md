---
module: Metric
namespaces: [Hi\Metric, Hi\Metric\Adapter, Hi\Metric\Exception]
class_count: 10
interface_count: 0
trait_count: 0
enum_count: 0
attribute_count: 0
---
# Metric 模块

监控指标收集

## 概览

- 类: 10
- 接口: 0
- Traits: 0
- 枚举: 0
- Attributes: 0

## 使用指南

- [Metric 指标](../guides/components/metric.md)

## 核心概念

- [生命周期](../guides/concepts/lifecycle.md)
- [作用域(Scope)](../guides/concepts/scope.md)
- [服务容器](../guides/concepts/container-and-di.md)
- [注解](../guides/concepts/attributes.md)
- [运行时系统](../guides/concepts/runtime.md)

## API 参考

### 类

| 名称 | 描述 |
| --- | --- |
| [`Collector`](../api/classes/Hi.Metric.Collector.md) |  |
| [`Counter`](../api/classes/Hi.Metric.Counter.md) |  |
| [`RedisAdapter`](../api/classes/Hi.Metric.Adapter.RedisAdapter.md) |  |
| [`Histogram`](../api/classes/Hi.Metric.Histogram.md) |  |
| [`Gauge`](../api/classes/Hi.Metric.Gauge.md) |  |
| [`Summary`](../api/classes/Hi.Metric.Summary.md) |  |
| [`LoadException`](../api/classes/Hi.Metric.Exception.LoadException.md) |  |
| [`AttributeMetricLoadException`](../api/classes/Hi.Metric.Exception.AttributeMetricLoadException.md) |  |
| [`TargetAttributeMissingException`](../api/classes/Hi.Metric.Exception.TargetAttributeMissingException.md) |  |
| [`NotMetricClassException`](../api/classes/Hi.Metric.Exception.NotMetricClassException.md) |  |

