---
module: Elasticsearch
namespaces: [Hi\Elasticsearch, Hi\Elasticsearch\RequestHandler, Hi\Elasticsearch\Exception]
class_count: 9
interface_count: 1
trait_count: 0
enum_count: 0
attribute_count: 0
---
# Elasticsearch 模块

Elasticsearch 搜索引擎客户端

## 概览

- 类: 9
- 接口: 1
- Traits: 0
- 枚举: 0
- Attributes: 0

## 使用指南

- [Elasticsearch 搜索](../guides/components/elasticsearch.md)
- [Elasticsearch 连接配置](../guides/elasticsearch/connection.md)
- [Elasticsearch 请求处理器](../guides/elasticsearch/request-handler.md)
- [Elasticsearch 查询操作](../guides/elasticsearch/query.md)

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
| [`ElasticsearchProviderInterface`](../api/interfaces/Hi.Elasticsearch.ElasticsearchProviderInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`Elasticsearch`](../api/classes/Hi.Elasticsearch.Elasticsearch.md) |  |
| [`CurlRequestHandler`](../api/classes/Hi.Elasticsearch.RequestHandler.CurlRequestHandler.md) |  |
| [`SwooleRequestHandler`](../api/classes/Hi.Elasticsearch.RequestHandler.SwooleRequestHandler.md) |  |
| [`ElasticsearchManager`](../api/classes/Hi.Elasticsearch.ElasticsearchManager.md) |  |
| [`ConnectionException`](../api/classes/Hi.Elasticsearch.Exception.ConnectionException.md) |  |
| [`ConfigException`](../api/classes/Hi.Elasticsearch.Exception.ConfigException.md) |  |
| [`HttpClientRequestTimeOutException`](../api/classes/Hi.Elasticsearch.Exception.HttpClientRequestTimeOutException.md) |  |
| [`ElasticsearchException`](../api/classes/Hi.Elasticsearch.Exception.ElasticsearchException.md) |  |
| [`RequestHandler`](../api/classes/Hi.Elasticsearch.RequestHandler.md) |  |

