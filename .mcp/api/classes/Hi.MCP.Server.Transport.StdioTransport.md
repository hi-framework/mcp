---
fqcn: Hi\MCP\Server\Transport\StdioTransport
type: class
namespace: Hi\MCP\Server\Transport
module: MCP
file: src/MCP/Server/Transport/StdioTransport.php
line: 15
---
# StdioTransport

**命名空间**: `Hi\MCP\Server\Transport`

**类型**: Class

**文件**: `src/MCP/Server/Transport/StdioTransport.php:15`

STDIO 传输层

实现 MCP 协议的标准输入输出通信
- 从 STDIN 读取 JSON-RPC 请求
- 向 STDOUT 输出 JSON-RPC 响应
- 向 STDERR 输出日志（不干扰协议）

## 方法

### Public 方法

#### `readMessage`

```php
public function readMessage(): ?array
```

从 STDIN 读取一条消息

**返回**: `?array` - mixed>|null 返回解析后的 JSON 数据，失败返回 null

#### `writeMessage`

```php
public function writeMessage(array $message): void
```

向 STDOUT 写入一条消息

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `array` | - |  |

**返回**: `void`

#### `logError`

```php
public function logError(string $message): void
```

写入错误日志到 STDERR

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `string` | - |  |

**返回**: `void`

#### `logInfo`

```php
public function logInfo(string $message): void
```

写入信息日志到 STDERR

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `string` | - |  |

**返回**: `void`

#### `logWarning`

```php
public function logWarning(string $message): void
```

写入警告日志到 STDERR

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `string` | - |  |

**返回**: `void`

#### `logDebug`

```php
public function logDebug(string $message): void
```

写入调试日志到 STDERR

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `string` | - |  |

**返回**: `void`

