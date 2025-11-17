---
fqcn: Hi\Http\Runtime\Builtin\ServerRequest
type: class
namespace: Hi\Http\Runtime\Builtin
module: Http
file: src/Http/Runtime/Builtin/ServerRequest.php
line: 16
---
# ServerRequest

**命名空间**: `Hi\Http\Runtime\Builtin`

**类型**: Class

**文件**: `src/Http/Runtime/Builtin/ServerRequest.php:16`

## 继承关系

**继承**: `Hi\Http\Message\AbstractServerRequest`

**实现**: `Psr\Http\Message\ServerRequestInterface`

## 方法

### Public 方法

#### `__construct`

```php
public function __construct()
```

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

### Protected 方法

#### `parseHeaders`

```php
protected function parseHeaders(): array
```

Parse the client header (from $_SERVER).

**返回**: `array`

