---
fqcn: Hi\MCP\Server\Protocol\JsonRpcMessage
type: class
namespace: Hi\MCP\Server\Protocol
module: MCP
file: src/MCP/Server/Protocol/JsonRpcMessage.php
line: 12
---
# JsonRpcMessage

**命名空间**: `Hi\MCP\Server\Protocol`

**类型**: Class

**文件**: `src/MCP/Server/Protocol/JsonRpcMessage.php:12`

JSON-RPC 消息构建器

提供创建符合 JSON-RPC 2.0 规范的消息的方法

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `ERROR_PARSE_ERROR` | '...' | public |  |
| `ERROR_INVALID_REQUEST` | '...' | public |  |
| `ERROR_METHOD_NOT_FOUND` | '...' | public |  |
| `ERROR_INVALID_PARAMS` | '...' | public |  |
| `ERROR_INTERNAL_ERROR` | '...' | public |  |

## 方法

### Public 方法

#### `success`

**标记**: static

```php
public static function success(int|string $id, mixed $result): array
```

创建成功响应

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$id` | `int\|string` | - | 请求 ID |
| `$result` | `mixed` | - | 结果数据 |

**返回**: `array` - mixed>

#### `error`

**标记**: static

```php
public static function error(int|string|null $id, int $code, string $message, mixed $data = 'null'): array
```

创建错误响应

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$id` | `int\|string\|null` | - | 请求 ID，可以为 null（解析错误时） |
| `$code` | `int` | - | 错误码 |
| `$message` | `string` | - | 错误消息 |
| `$data` | `mixed` | 'null' | 额外错误数据 |

**返回**: `array` - mixed>

#### `notification`

**标记**: static

```php
public static function notification(string $method, array $params = []): array
```

创建通知消息（无需响应）

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - | 方法名 |
| `$params` | `array` | [] |  |

**返回**: `array` - mixed>

