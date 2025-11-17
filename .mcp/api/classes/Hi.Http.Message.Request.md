---
fqcn: Hi\Http\Message\Request
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/Request.php
line: 11
---
# Request

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/Request.php:11`

## 继承关系

**继承**: `Hi\Http\Message\Message`

**实现**: `Psr\Http\Message\RequestInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$uri` | `?Psr\Http\Message\UriInterface` | protected | 'null' |  |
| `$method` | `string` | protected | '' |  |
| `$requestTarget` | `?string` | protected | 'null' |  |
| `$originalUri` | `string` | private | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $method = 'GET', string|Psr\Http\Message\UriInterface $uri = '', array $headers = [], Psr\Http\Message\StreamInterface|string $body = '', string $protocol = '1.1')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | 'GET' |  |
| `$uri` | `string\|Psr\Http\Message\UriInterface` | '' |  |
| `$headers` | `array` | [] |  |
| `$body` | `Psr\Http\Message\StreamInterface\|string` | '' |  |
| `$protocol` | `string` | '1.1' |  |

**返回**: `void`

#### `getRequestTarget`

```php
public function getRequestTarget(): string
```

**返回**: `string`

#### `withRequestTarget`

```php
public function withRequestTarget(string $requestTarget): Psr\Http\Message\RequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$requestTarget` | `string` | - |  |

**返回**: `Psr\Http\Message\RequestInterface`

#### `getMethod`

```php
public function getMethod(): string
```

**返回**: `string`

#### `withMethod`

```php
public function withMethod(string $method): Psr\Http\Message\RequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |

**返回**: `Psr\Http\Message\RequestInterface`

#### `getUri`

```php
public function getUri(): Psr\Http\Message\UriInterface
```

**返回**: `Psr\Http\Message\UriInterface`

#### `withUri`

```php
public function withUri(Psr\Http\Message\UriInterface $uri, bool $preserveHost = 'false'): Psr\Http\Message\RequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$uri` | `Psr\Http\Message\UriInterface` | - |  |
| `$preserveHost` | `bool` | 'false' |  |

**返回**: `Psr\Http\Message\RequestInterface`

