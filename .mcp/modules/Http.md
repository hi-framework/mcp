---
module: Http
namespaces: [Hi\Http, Hi\Http\Middleware, Hi\Http\Runtime\Swoole, Hi\Http\Runtime\Swow, Hi\Http\Runtime\Workerman, Hi\Http\Runtime, Hi\Http\Runtime\React, Hi\Http\Runtime\Builtin, Hi\Http\Message, Hi\Http\Loader, Hi\Http\Command, Hi\Http\Exception, Hi\Http\Client, Hi\Http\Client\Connection, Hi\Http\Client\Connection\Driver\Swoole, Hi\Http\Client\Connection\Driver\Curl, Hi\Http\Client\Exception, Hi\Http\Metadata, Hi\Http\Router\Traits, Hi\Http\Router]
class_count: 58
interface_count: 9
trait_count: 3
enum_count: 0
attribute_count: 0
---
# Http 模块

HTTP 请求/响应处理、路由系统、中间件管理

## 概览

- 类: 58
- 接口: 9
- Traits: 3
- 枚举: 0
- Attributes: 0

## 使用指南

- [Http 路由](../guides/components/http.md)
- [路由系统](../guides/http/routing.md)
- [Context](../guides/http/context.md)
- [中间件系统](../guides/http/middleware.md)
- [文件上传](../guides/http/file-upload.md)
- [HTTP状态码](../guides/http/status-code.md)
- [响应](../guides/http/response.md)
- [请求](../guides/http/request.md)
- [HTTP 客户端](../guides/http/client.md)

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
| [`MiddlewareInterface`](../api/interfaces/Hi.Http.Middleware.MiddlewareInterface.md) |  |
| [`HttpMetadataManagerInterface`](../api/interfaces/Hi.Http.HttpMetadataManagerInterface.md) | Http metadata manager interface |
| [`MetricCollectorInterface`](../api/interfaces/Hi.Http.MetricCollectorInterface.md) |  |
| [`EventHandlerInterface`](../api/interfaces/Hi.Http.Runtime.EventHandlerInterface.md) |  |
| [`VersatileResponseInterface`](../api/interfaces/Hi.Http.Message.VersatileResponseInterface.md) |  |
| [`HttpLoaderInterface`](../api/interfaces/Hi.Http.HttpLoaderInterface.md) | Http loader interface |
| [`RouterInterface`](../api/interfaces/Hi.Http.RouterInterface.md) |  |
| [`ApplicationInterface`](../api/interfaces/Hi.Http.ApplicationInterface.md) |  |
| [`ClientProviderInterface`](../api/interfaces/Hi.Http.Client.ClientProviderInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`Application`](../api/classes/Hi.Http.Application.md) |  |
| [`CorsDefaultMiddleware`](../api/classes/Hi.Http.Middleware.CorsDefaultMiddleware.md) | CORS Middleware. |
| [`ClosureWarpMiddleware`](../api/classes/Hi.Http.Middleware.ClosureWarpMiddleware.md) |  |
| [`EventHandler`](../api/classes/Hi.Http.Runtime.Swoole.EventHandler.md) |  |
| [`SwooleHttpServer`](../api/classes/Hi.Http.Runtime.Swoole.SwooleHttpServer.md) |  |
| [`ServerRequest`](../api/classes/Hi.Http.Runtime.Swoole.ServerRequest.md) |  |
| [`SwowHttpServer`](../api/classes/Hi.Http.Runtime.Swow.SwowHttpServer.md) |  |
| [`EventHandler`](../api/classes/Hi.Http.Runtime.Swow.EventHandler.md) |  |
| [`EventHandler`](../api/classes/Hi.Http.Runtime.Workerman.EventHandler.md) |  |
| [`WorkermanHttpServer`](../api/classes/Hi.Http.Runtime.Workerman.WorkermanHttpServer.md) |  |
| [`Worker`](../api/classes/Hi.Http.Runtime.Workerman.Worker.md) |  |
| [`ServerRequest`](../api/classes/Hi.Http.Runtime.Workerman.ServerRequest.md) |  |
| [`EventHandler`](../api/classes/Hi.Http.Runtime.React.EventHandler.md) |  |
| [`ReactHttpServer`](../api/classes/Hi.Http.Runtime.React.ReactHttpServer.md) |  |
| [`EventHandler`](../api/classes/Hi.Http.Runtime.Builtin.EventHandler.md) |  |
| [`BuiltinServer`](../api/classes/Hi.Http.Runtime.Builtin.BuiltinServer.md) |  |
| [`ServerRequest`](../api/classes/Hi.Http.Runtime.Builtin.ServerRequest.md) |  |
| [`Response`](../api/classes/Hi.Http.Message.Response.md) |  |
| [`Decoder`](../api/classes/Hi.Http.Message.Decoder.md) |  |
| [`Stream`](../api/classes/Hi.Http.Message.Stream.md) | `Psr\HttpMessage\StreamInterface` implementation. |
| [`Request`](../api/classes/Hi.Http.Message.Request.md) |  |
| [`AbstractServerRequest`](../api/classes/Hi.Http.Message.AbstractServerRequest.md) |  |
| [`Uri`](../api/classes/Hi.Http.Message.Uri.md) |  |
| [`UploadedFile`](../api/classes/Hi.Http.Message.UploadedFile.md) |  |
| [`FileResponse`](../api/classes/Hi.Http.Message.FileResponse.md) |  |
| [`Message`](../api/classes/Hi.Http.Message.Message.md) |  |
| [`Context`](../api/classes/Hi.Http.Context.md) |  |
| [`ComposerHttpLoader`](../api/classes/Hi.Http.Loader.ComposerHttpLoader.md) | Composer HTTP Loader |
| [`DefaultHttpLoader`](../api/classes/Hi.Http.Loader.DefaultHttpLoader.md) | Default HTTP Loader |
| [`HttpMetadataManager`](../api/classes/Hi.Http.HttpMetadataManager.md) | Http metadata manager |
| [`Pipeline`](../api/classes/Hi.Http.Pipeline.md) |  |
| [`Router`](../api/classes/Hi.Http.Router.md) |  |
| [`HttpServerCommand`](../api/classes/Hi.Http.Command.HttpServerCommand.md) |  |
| [`RouterException`](../api/classes/Hi.Http.Exception.RouterException.md) |  |
| [`HttpException`](../api/classes/Hi.Http.Exception.HttpException.md) |  |
| [`ClosureHandler`](../api/classes/Hi.Http.Exception.ClosureHandler.md) |  |
| [`TaskUncaughtException`](../api/classes/Hi.Http.Exception.TaskUncaughtException.md) |  |
| [`ClientManager`](../api/classes/Hi.Http.Client.ClientManager.md) |  |
| [`ClientPool`](../api/classes/Hi.Http.Client.Connection.ClientPool.md) |  |
| [`ClientConnectionConfig`](../api/classes/Hi.Http.Client.Connection.ClientConnectionConfig.md) |  |
| [`ConnectionConfig`](../api/classes/Hi.Http.Client.Connection.Driver.Swoole.ConnectionConfig.md) |  |
| [`SwooleConnection`](../api/classes/Hi.Http.Client.Connection.Driver.Swoole.SwooleConnection.md) |  |
| [`SwooleConnectionPool`](../api/classes/Hi.Http.Client.Connection.Driver.Swoole.SwooleConnectionPool.md) |  |
| [`CurlConnectionPool`](../api/classes/Hi.Http.Client.Connection.Driver.Curl.CurlConnectionPool.md) |  |
| [`ConnectionConfig`](../api/classes/Hi.Http.Client.Connection.Driver.Curl.ConnectionConfig.md) |  |
| [`CurlConnection`](../api/classes/Hi.Http.Client.Connection.Driver.Curl.CurlConnection.md) |  |
| [`CurlRequestFailedException`](../api/classes/Hi.Http.Client.Exception.CurlRequestFailedException.md) |  |
| [`ClientException`](../api/classes/Hi.Http.Client.Exception.ClientException.md) |  |
| [`ClientConfigInvalidException`](../api/classes/Hi.Http.Client.Exception.ClientConfigInvalidException.md) |  |
| [`SwooleRequestFailedException`](../api/classes/Hi.Http.Client.Exception.SwooleRequestFailedException.md) |  |
| [`ClientConfigNotFoundException`](../api/classes/Hi.Http.Client.Exception.ClientConfigNotFoundException.md) |  |
| [`MiddlewareMetadata`](../api/classes/Hi.Http.Metadata.MiddlewareMetadata.md) | Middleware metadata class |
| [`RouteMetadata`](../api/classes/Hi.Http.Metadata.RouteMetadata.md) | Route metadata class |
| [`ParameterMetadata`](../api/classes/Hi.Http.Metadata.ParameterMetadata.md) | HTTP Parameter Metadata Class |
| [`Extend`](../api/classes/Hi.Http.Router.Extend.md) |  |
| [`Route`](../api/classes/Hi.Http.Router.Route.md) | HTTP 路由处理器 |
| [`ParameterResolver`](../api/classes/Hi.Http.Router.ParameterResolver.md) | 路由处理器参数解析器 |
| [`HandlerFactory`](../api/classes/Hi.Http.Router.HandlerFactory.md) | Handler factory for creating route handlers |

### Traits

| 名称 | 描述 |
| --- | --- |
| [`GroupTrait`](../api/traits/Hi.Http.Router.Traits.GroupTrait.md) |  |
| [`MethodTrait`](../api/traits/Hi.Http.Router.Traits.MethodTrait.md) |  |
| [`NotFoundHandlerTrait`](../api/traits/Hi.Http.Router.Traits.NotFoundHandlerTrait.md) |  |

