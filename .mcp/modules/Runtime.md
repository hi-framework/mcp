---
module: Runtime
namespaces: [Hi\Runtime, Hi\Runtime\Swoole, Hi\Runtime\Exception, Hi\Runtime\Builtin]
class_count: 21
interface_count: 8
trait_count: 1
enum_count: 1
attribute_count: 0
---
# Runtime 模块

运行时环境抽象

## 概览

- 类: 21
- 接口: 8
- Traits: 1
- 枚举: 1
- Attributes: 0

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
| [`EventInterface`](../api/interfaces/Hi.Runtime.EventInterface.md) |  |
| [`ContextInterface`](../api/interfaces/Hi.Runtime.ContextInterface.md) | Coroutine context interface |
| [`RetryInterface`](../api/interfaces/Hi.Runtime.RetryInterface.md) |  |
| [`TimerInterface`](../api/interfaces/Hi.Runtime.TimerInterface.md) |  |
| [`ChannelInstanceInterface`](../api/interfaces/Hi.Runtime.ChannelInstanceInterface.md) |  |
| [`CoroutineInterface`](../api/interfaces/Hi.Runtime.CoroutineInterface.md) |  |
| [`ChannelInterface`](../api/interfaces/Hi.Runtime.ChannelInterface.md) |  |
| [`SignalInterface`](../api/interfaces/Hi.Runtime.SignalInterface.md) | Signal handler interface Each extension needs to implement this interface to provide signal handling capabilities |

### 类

| 名称 | 描述 |
| --- | --- |
| [`Event`](../api/classes/Hi.Runtime.Swoole.Event.md) |  |
| [`Signal`](../api/classes/Hi.Runtime.Swoole.Signal.md) | Swoole signal handler Use Swoole's Process::signal method to implement signal handling |
| [`Coroutine`](../api/classes/Hi.Runtime.Swoole.Coroutine.md) |  |
| [`Timer`](../api/classes/Hi.Runtime.Swoole.Timer.md) |  |
| [`Context`](../api/classes/Hi.Runtime.Swoole.Context.md) | Swoole 协程上下文实现 |
| [`Channel`](../api/classes/Hi.Runtime.Swoole.Channel.md) |  |
| [`ChannelInstance`](../api/classes/Hi.Runtime.Swoole.ChannelInstance.md) | Swoole Channel instance implementation Wraps Swoole\Coroutine\Channel to conform to the ChannelInstanceInterface interface |
| [`Retry`](../api/classes/Hi.Runtime.Retry.md) |  |
| [`AppRuntime`](../api/classes/Hi.Runtime.AppRuntime.md) |  |
| [`RetryTimeoutException`](../api/classes/Hi.Runtime.Exception.RetryTimeoutException.md) |  |
| [`RuntimeException`](../api/classes/Hi.Runtime.Exception.RuntimeException.md) |  |
| [`ChannelException`](../api/classes/Hi.Runtime.Exception.ChannelException.md) |  |
| [`BuitinException`](../api/classes/Hi.Runtime.Exception.BuitinException.md) |  |
| [`SwooleException`](../api/classes/Hi.Runtime.Exception.SwooleException.md) |  |
| [`Event`](../api/classes/Hi.Runtime.Builtin.Event.md) |  |
| [`Signal`](../api/classes/Hi.Runtime.Builtin.Signal.md) | Builtin signal handler 使用 PHP 的 pcntl 扩展实现信号处理 |
| [`Coroutine`](../api/classes/Hi.Runtime.Builtin.Coroutine.md) |  |
| [`Timer`](../api/classes/Hi.Runtime.Builtin.Timer.md) |  |
| [`Context`](../api/classes/Hi.Runtime.Builtin.Context.md) | 内置运行时上下文实现 |
| [`Channel`](../api/classes/Hi.Runtime.Builtin.Channel.md) |  |
| [`ChannelInstance`](../api/classes/Hi.Runtime.Builtin.ChannelInstance.md) |  |

### Traits

| 名称 | 描述 |
| --- | --- |
| [`ExtensionCheckTrait`](../api/traits/Hi.Runtime.Swoole.ExtensionCheckTrait.md) |  |

### 枚举

| 名称 | 描述 |
| --- | --- |
| [`AppRuntimeTypeEnum`](../api/enums/Hi.Runtime.AppRuntimeTypeEnum.md) |  |

