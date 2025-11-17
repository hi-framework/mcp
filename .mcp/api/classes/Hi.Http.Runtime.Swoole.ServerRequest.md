---
fqcn: Hi\Http\Runtime\Swoole\ServerRequest
type: class
namespace: Hi\Http\Runtime\Swoole
module: Http
file: src/Http/Runtime/Swoole/ServerRequest.php
line: 15
---
# ServerRequest

**命名空间**: `Hi\Http\Runtime\Swoole`

**类型**: Class

**文件**: `src/Http/Runtime/Swoole/ServerRequest.php:15`

## 继承关系

**继承**: `Hi\Http\Message\AbstractServerRequest`

**实现**: `Psr\Http\Message\ServerRequestInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$request` | `Swoole\Http\Request` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Swoole\Http\Request $request)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Swoole\Http\Request` | - |  |

**返回**: `void`

#### `getMethod`

```php
public function getMethod(): string
```

**返回**: `string`

#### `getUri`

```php
public function getUri(): Psr\Http\Message\UriInterface
```

**返回**: `Psr\Http\Message\UriInterface`

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

#### `getBody`

```php
public function getBody(): Psr\Http\Message\StreamInterface
```

**返回**: `Psr\Http\Message\StreamInterface`

#### `getParsedBody`

```php
public function getParsedBody(): null|array|object
```

**返回**: `null|array|object`

