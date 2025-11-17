---
module: Event
namespaces: [Hi\Event, Hi\Event\Metrics, Hi\Event\Loader, Hi\Event\Executor, Hi\Event\Exception, Hi\Event\Metadata]
class_count: 15
interface_count: 3
trait_count: 1
enum_count: 0
attribute_count: 0
---
# Event 模块

事件系统

## 概览

- 类: 15
- 接口: 3
- Traits: 1
- 枚举: 0
- Attributes: 0

## 使用指南

- [Event 事件](../guides/components/event.md)

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
| [`MetricsCollectorInterface`](../api/interfaces/Hi.Event.Metrics.MetricsCollectorInterface.md) | Event Metrics Collector Interface |
| [`EventMetadataManagerInterface`](../api/interfaces/Hi.Event.EventMetadataManagerInterface.md) | Event metadata manager interface |
| [`EventLoaderInterface`](../api/interfaces/Hi.Event.Loader.EventLoaderInterface.md) | Event loader interface |

### 类

| 名称 | 描述 |
| --- | --- |
| [`StoppableEvent`](../api/classes/Hi.Event.StoppableEvent.md) | Base Stoppable Event |
| [`InMemoryMetricsCollector`](../api/classes/Hi.Event.Metrics.InMemoryMetricsCollector.md) | In-Memory Metrics Collector |
| [`NullMetricsCollector`](../api/classes/Hi.Event.Metrics.NullMetricsCollector.md) | Null Metrics Collector |
| [`ListenerProvider`](../api/classes/Hi.Event.ListenerProvider.md) | PSR-14 Listener Provider |
| [`EventMetadataManager`](../api/classes/Hi.Event.EventMetadataManager.md) | Event metadata manager |
| [`EventDispatcher`](../api/classes/Hi.Event.EventDispatcher.md) | PSR-14 Event Dispatcher |
| [`DefaultEventLoader`](../api/classes/Hi.Event.Loader.DefaultEventLoader.md) | Default Event Loader |
| [`ComposerEventLoader`](../api/classes/Hi.Event.Loader.ComposerEventLoader.md) | Composer Event Loader |
| [`SyncListenerExecutor`](../api/classes/Hi.Event.Executor.SyncListenerExecutor.md) | Synchronous Listener Executor |
| [`AsyncListenerExecutor`](../api/classes/Hi.Event.Executor.AsyncListenerExecutor.md) | Asynchronous Listener Executor |
| [`AbstractListenerExecutor`](../api/classes/Hi.Event.Executor.AbstractListenerExecutor.md) | Abstract base class for listener executors |
| [`InvalidEventMetadataException`](../api/classes/Hi.Event.Exception.InvalidEventMetadataException.md) | Invalid event metadata exception |
| [`EventException`](../api/classes/Hi.Event.Exception.EventException.md) | Base event system exception |
| [`EventMetadata`](../api/classes/Hi.Event.Metadata.EventMetadata.md) | Event metadata class |
| [`ListenerMetadata`](../api/classes/Hi.Event.Metadata.ListenerMetadata.md) | Listener metadata class |

### Traits

| 名称 | 描述 |
| --- | --- |
| [`StoppableEventTrait`](../api/traits/Hi.Event.StoppableEventTrait.md) | Stoppable Event Trait |

