---
fqcn: Hi\Http\Message\Response
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/Response.php
line: 10
---
# Response

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/Response.php:10`

## 继承关系

**继承**: `Hi\Http\Message\Message`

**实现**: `Hi\Http\Message\VersatileResponseInterface`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `Phrases` | [] | protected | Map of standard HTTP status code and reason phrases. |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Http\Message\StreamInterface|string $body = '', int $statusCode = 200, array $headers = [], string $protocol = '1.1', string $reasonPhrase = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$body` | `Psr\Http\Message\StreamInterface\|string` | '' |  |
| `$statusCode` | `int` | 200 |  |
| `$headers` | `array` | [] |  |
| `$protocol` | `string` | '1.1' |  |
| `$reasonPhrase` | `string` | '' |  |

**返回**: `void`

#### `getStatusCode`

```php
public function getStatusCode(): int
```

**返回**: `int`

#### `withStatus`

```php
public function withStatus(int $code, string $reasonPhrase = ''): Psr\Http\Message\ResponseInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$code` | `int` | - |  |
| `$reasonPhrase` | `string` | '' |  |

**返回**: `Psr\Http\Message\ResponseInterface`

#### `getReasonPhrase`

```php
public function getReasonPhrase(): string
```

**返回**: `string`

#### `writeBody`

```php
public function writeBody(mixed $body): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$body` | `mixed` | - |  |

**返回**: `self`

