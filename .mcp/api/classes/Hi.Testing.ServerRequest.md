---
fqcn: Hi\Testing\ServerRequest
type: class
namespace: Hi\Testing
module: Testing
file: src/Testing/ServerRequest.php
line: 11
---
# ServerRequest

**命名空间**: `Hi\Testing`

**类型**: Class

**文件**: `src/Testing/ServerRequest.php:11`

## 继承关系

**继承**: `Hi\Http\Message\AbstractServerRequest`

**实现**: `Psr\Http\Message\ServerRequestInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$serverParams` | `array` | protected | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $serverParams = [], array $uploadedFiles = [], array $cookieParams = [], array $queryParams = [], mixed $parsedBody = 'null', string $method = 'GET', $uri = '', array $headers = [], Psr\Http\Message\StreamInterface|string $body = '', string $protocol = '1.1')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$serverParams` | `array` | [] |  |
| `$uploadedFiles` | `array` | [] |  |
| `$cookieParams` | `array` | [] |  |
| `$queryParams` | `array` | [] |  |
| `$parsedBody` | `mixed` | 'null' |  |
| `$method` | `string` | 'GET' |  |
| `$uri` | `mixed` | '' |  |
| `$headers` | `array` | [] |  |
| `$body` | `Psr\Http\Message\StreamInterface\|string` | '' |  |
| `$protocol` | `string` | '1.1' |  |

**返回**: `void`

#### `getServerParams`

```php
public function getServerParams(): array
```

**返回**: `array`

#### `getCookieParams`

```php
public function getCookieParams(): array
```

**返回**: `array`

#### `getQueryParams`

```php
public function getQueryParams(): array
```

**返回**: `array`

#### `getUploadedFiles`

```php
public function getUploadedFiles(): array
```

**返回**: `array`

#### `getParsedBody`

```php
public function getParsedBody(): mixed
```

**返回**: `mixed`

