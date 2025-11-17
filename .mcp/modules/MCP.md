---
module: MCP
namespaces: [Hi\MCP\Analyzers, Hi\MCP\Tools, Hi\MCP\Cache, Hi\MCP\Resources, Hi\MCP\Server\Transport, Hi\MCP\Server, Hi\MCP\Server\Protocol, Hi\MCP\Command]
class_count: 16
interface_count: 2
trait_count: 0
enum_count: 0
attribute_count: 0
---
# MCP 模块

Model Context Protocol 实现

## 概览

- 类: 16
- 接口: 2
- Traits: 0
- 枚举: 0
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
| [`ToolInterface`](../api/interfaces/Hi.MCP.Tools.ToolInterface.md) | MCP 工具接口 |
| [`CacheInterface`](../api/interfaces/Hi.MCP.Cache.CacheInterface.md) | 缓存接口 |

### 类

| 名称 | 描述 |
| --- | --- |
| [`ApiExtractor`](../api/classes/Hi.MCP.Analyzers.ApiExtractor.md) | API 信息提取器 |
| [`PhpParser`](../api/classes/Hi.MCP.Analyzers.PhpParser.md) | PHP 代码解析器 |
| [`GetApiInfoTool`](../api/classes/Hi.MCP.Tools.GetApiInfoTool.md) | 获取 API 信息工具 |
| [`SearchDocTool`](../api/classes/Hi.MCP.Tools.SearchDocTool.md) | 搜索文档工具 |
| [`AbstractTool`](../api/classes/Hi.MCP.Tools.AbstractTool.md) | MCP 工具抽象基类 |
| [`ListModulesTool`](../api/classes/Hi.MCP.Tools.ListModulesTool.md) | 列出模块工具 |
| [`SearchApiTool`](../api/classes/Hi.MCP.Tools.SearchApiTool.md) | 搜索 API 工具 |
| [`FileCache`](../api/classes/Hi.MCP.Cache.FileCache.md) | 文件系统缓存实现 |
| [`ApiCache`](../api/classes/Hi.MCP.Cache.ApiCache.md) | API 缓存 |
| [`DocumentCache`](../api/classes/Hi.MCP.Cache.DocumentCache.md) | 文档缓存 |
| [`ApiProvider`](../api/classes/Hi.MCP.Resources.ApiProvider.md) | API 资源提供者 |
| [`DocumentationProvider`](../api/classes/Hi.MCP.Resources.DocumentationProvider.md) | 文档资源提供者 |
| [`StdioTransport`](../api/classes/Hi.MCP.Server.Transport.StdioTransport.md) | STDIO 传输层 |
| [`McpServer`](../api/classes/Hi.MCP.Server.McpServer.md) | MCP 服务器主类 |
| [`JsonRpcMessage`](../api/classes/Hi.MCP.Server.Protocol.JsonRpcMessage.md) | JSON-RPC 消息构建器 |
| [`MCPServerCommand`](../api/classes/Hi.MCP.Command.MCPServerCommand.md) | MCP (Model Context Protocol) 服务器命令基类 |

