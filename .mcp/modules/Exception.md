---
module: Exception
namespaces: [Hi\Exception\Reporter, Hi\Exception]
class_count: 2
interface_count: 2
trait_count: 0
enum_count: 0
attribute_count: 0
---
# Exception 模块

异常处理和错误报告

## 概览

- 类: 2
- 接口: 2
- Traits: 0
- 枚举: 0
- Attributes: 0

## 使用指南

- [错误报告](../guides/exception/reporting.md)
- [异常处理](../guides/exception/index.md)
- [日志记录](../guides/exception/logging.md)
- [异常系统](../guides/exception/system.md)
- [完整示例](../guides/exception/complete-example.md)

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
| [`ExceptionHandlerInterface`](../api/interfaces/Hi.Exception.ExceptionHandlerInterface.md) |  |
| [`ExceptionReporterInterface`](../api/interfaces/Hi.Exception.ExceptionReporterInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`ConsoleReporter`](../api/classes/Hi.Exception.Reporter.ConsoleReporter.md) |  |
| [`ExceptionHandler`](../api/classes/Hi.Exception.ExceptionHandler.md) |  |

