---
module: Attributes
namespaces: [Hi\Attributes\Database, Hi\Attributes, Hi\Attributes\Core, Hi\Attributes\Http, Hi\Attributes\Exception, Hi\Attributes\Event, Hi\Attributes\Console]
class_count: 36
interface_count: 0
trait_count: 0
enum_count: 0
attribute_count: 25
---
# Attributes 模块

PHP 8+ Attributes 集合

## 概览

- 类: 36
- 接口: 0
- Traits: 0
- 枚举: 0
- Attributes: 25

## 核心概念

- [生命周期](../guides/concepts/lifecycle.md)
- [作用域(Scope)](../guides/concepts/scope.md)
- [服务容器](../guides/concepts/container-and-di.md)
- [注解](../guides/concepts/attributes.md)
- [运行时系统](../guides/concepts/runtime.md)

## API 参考

### Attributes

| 名称 | 描述 |
| --- | --- |
| [`Transaction`](../api/attributes/Hi.Attributes.Database.Transaction.md) | Transaction 属性 |
| [`Cache`](../api/attributes/Hi.Attributes.Database.Cache.md) | Method result cache attribute |
| [`Bind`](../api/attributes/Hi.Attributes.Core.Bind.md) | Dependency bind attribute |
| [`Get`](../api/attributes/Hi.Attributes.Http.Get.md) | HTTP GET request route action attribute. |
| [`Post`](../api/attributes/Hi.Attributes.Http.Post.md) | HTTP POST request route action attribute. |
| [`Body`](../api/attributes/Hi.Attributes.Http.Body.md) | HTTP request input parameter attribute. |
| [`Put`](../api/attributes/Hi.Attributes.Http.Put.md) | HTTP PUT request route action attribute. |
| [`Header`](../api/attributes/Hi.Attributes.Http.Header.md) | HTTP request input parameter attribute. |
| [`Any`](../api/attributes/Hi.Attributes.Http.Any.md) | HTTP route action attribute Using it means supporting all HTTP request methods. |
| [`Patch`](../api/attributes/Hi.Attributes.Http.Patch.md) | HTTP PATCH request route action attribute. |
| [`Route`](../api/attributes/Hi.Attributes.Http.Route.md) | HTTP route class attribute. |
| [`Head`](../api/attributes/Hi.Attributes.Http.Head.md) | HTTP HEAD request route action attribute. |
| [`Options`](../api/attributes/Hi.Attributes.Http.Options.md) | HTTP OPTIONS request route action attribute. |
| [`Delete`](../api/attributes/Hi.Attributes.Http.Delete.md) | HTTP DELETE request route action attribute. |
| [`Input`](../api/attributes/Hi.Attributes.Http.Input.md) | HTTP request input class attribute. |
| [`Query`](../api/attributes/Hi.Attributes.Http.Query.md) | HTTP request input parameter attribute. |
| [`Middleware`](../api/attributes/Hi.Attributes.Http.Middleware.md) | HTTP middleware class attribute. |
| [`Parameter`](../api/attributes/Hi.Attributes.Http.Parameter.md) | HTTP request input parameter attribute. |
| [`Event`](../api/attributes/Hi.Attributes.Event.Event.md) | Event class attribute |
| [`EventListener`](../api/attributes/Hi.Attributes.Event.EventListener.md) | Event listener attribute for marking listener methods |
| [`EventSubscriber`](../api/attributes/Hi.Attributes.Event.EventSubscriber.md) | Event subscriber attribute for marking subscriber classes |
| [`EventMiddleware`](../api/attributes/Hi.Attributes.Event.EventMiddleware.md) | Event middleware attribute |
| [`Action`](../api/attributes/Hi.Attributes.Console.Action.md) | Console action attribute |
| [`Option`](../api/attributes/Hi.Attributes.Console.Option.md) | Console option attribute |
| [`Command`](../api/attributes/Hi.Attributes.Console.Command.md) | Console command attribute |

### 类

| 名称 | 描述 |
| --- | --- |
| [`Transaction`](../api/classes/Hi.Attributes.Database.Transaction.md) | Transaction 属性 |
| [`Cache`](../api/classes/Hi.Attributes.Database.Cache.md) | Method result cache attribute |
| [`AutowireBindLoader`](../api/classes/Hi.Attributes.AutowireBindLoader.md) |  |
| [`EventAttributeLoader`](../api/classes/Hi.Attributes.EventAttributeLoader.md) | Event attribute loader |
| [`Bind`](../api/classes/Hi.Attributes.Core.Bind.md) | Dependency bind attribute |
| [`AwesomeAttributeLoader`](../api/classes/Hi.Attributes.AwesomeAttributeLoader.md) |  |
| [`ConsoleAttributeLoader`](../api/classes/Hi.Attributes.ConsoleAttributeLoader.md) |  |
| [`Get`](../api/classes/Hi.Attributes.Http.Get.md) | HTTP GET request route action attribute. |
| [`Post`](../api/classes/Hi.Attributes.Http.Post.md) | HTTP POST request route action attribute. |
| [`Body`](../api/classes/Hi.Attributes.Http.Body.md) | HTTP request input parameter attribute. |
| [`Put`](../api/classes/Hi.Attributes.Http.Put.md) | HTTP PUT request route action attribute. |
| [`Header`](../api/classes/Hi.Attributes.Http.Header.md) | HTTP request input parameter attribute. |
| [`Any`](../api/classes/Hi.Attributes.Http.Any.md) | HTTP route action attribute Using it means supporting all HTTP request methods. |
| [`Patch`](../api/classes/Hi.Attributes.Http.Patch.md) | HTTP PATCH request route action attribute. |
| [`Route`](../api/classes/Hi.Attributes.Http.Route.md) | HTTP route class attribute. |
| [`Head`](../api/classes/Hi.Attributes.Http.Head.md) | HTTP HEAD request route action attribute. |
| [`Options`](../api/classes/Hi.Attributes.Http.Options.md) | HTTP OPTIONS request route action attribute. |
| [`Delete`](../api/classes/Hi.Attributes.Http.Delete.md) | HTTP DELETE request route action attribute. |
| [`Input`](../api/classes/Hi.Attributes.Http.Input.md) | HTTP request input class attribute. |
| [`Query`](../api/classes/Hi.Attributes.Http.Query.md) | HTTP request input parameter attribute. |
| [`Middleware`](../api/classes/Hi.Attributes.Http.Middleware.md) | HTTP middleware class attribute. |
| [`Parameter`](../api/classes/Hi.Attributes.Http.Parameter.md) | HTTP request input parameter attribute. |
| [`HttpAttributeLoader`](../api/classes/Hi.Attributes.HttpAttributeLoader.md) | Http attribute loader |
| [`DirectoriesInvalidException`](../api/classes/Hi.Attributes.Exception.DirectoriesInvalidException.md) |  |
| [`AttributeException`](../api/classes/Hi.Attributes.Exception.AttributeException.md) |  |
| [`AttributeParseException`](../api/classes/Hi.Attributes.Exception.AttributeParseException.md) |  |
| [`PrepareTokenizeException`](../api/classes/Hi.Attributes.Exception.PrepareTokenizeException.md) |  |
| [`ParameterResolveException`](../api/classes/Hi.Attributes.Exception.ParameterResolveException.md) |  |
| [`AttributeLoadException`](../api/classes/Hi.Attributes.Exception.AttributeLoadException.md) |  |
| [`Event`](../api/classes/Hi.Attributes.Event.Event.md) | Event class attribute |
| [`EventListener`](../api/classes/Hi.Attributes.Event.EventListener.md) | Event listener attribute for marking listener methods |
| [`EventSubscriber`](../api/classes/Hi.Attributes.Event.EventSubscriber.md) | Event subscriber attribute for marking subscriber classes |
| [`EventMiddleware`](../api/classes/Hi.Attributes.Event.EventMiddleware.md) | Event middleware attribute |
| [`Action`](../api/classes/Hi.Attributes.Console.Action.md) | Console action attribute |
| [`Option`](../api/classes/Hi.Attributes.Console.Option.md) | Console option attribute |
| [`Command`](../api/classes/Hi.Attributes.Console.Command.md) | Console command attribute |

