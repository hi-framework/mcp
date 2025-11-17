---
fqcn: Hi\MCP\Server\McpServer
type: class
namespace: Hi\MCP\Server
module: MCP
file: src/MCP/Server/McpServer.php
line: 28
---
# McpServer

**命名空间**: `Hi\MCP\Server`

**类型**: Class

**文件**: `src/MCP/Server/McpServer.php:28`

MCP 服务器主类

负责处理 MCP 协议的所有请求和响应
实现 Model Context Protocol 规范

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$transport` | `Hi\MCP\Server\Transport\StdioTransport` | private | - |  |
| `$docProvider` | `Hi\MCP\Resources\DocumentationProvider` | private | - |  |
| `$apiProvider` | `Hi\MCP\Resources\ApiProvider` | private | - |  |
| `$initialized` | `bool` | private | 'false' |  |
| `$running` | `bool` | private | 'true' |  |
| `$signal` | `Hi\Runtime\SignalInterface` | private | - |  |
| `$capabilities` | `array` | private | [] |  |
| `$tools` | `array` | private | [] |  |
| `$frameworkPath` | `string` | private readonly | - |  |
| `$cachePath` | `string` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $frameworkPath, string $cachePath)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$frameworkPath` | `string` | - |  |
| `$cachePath` | `string` | - |  |

**返回**: `void`

#### `start`

```php
public function start(): void
```

启动 MCP 服务器

**返回**: `void`

