---
fqcn: Hi\Http\Message\AbstractServerRequest
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/AbstractServerRequest.php
line: 10
---
# AbstractServerRequest

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/AbstractServerRequest.php:10`

**修饰符**: abstract

## 继承关系

**继承**: `Hi\Http\Message\Request`

**实现**: `Psr\Http\Message\ServerRequestInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$parsedBody` | `mixed` | protected | 'null' |  |
| `$attributes` | `?array` | protected | 'null' |  |
| `$cookieParams` | `?array` | protected | 'null' |  |
| `$queryParams` | `?array` | protected | 'null' |  |
| `$uploadedFiles` | `?array` | protected | 'null' |  |

## 方法

### Public 方法

#### `withCookieParams`

```php
public function withCookieParams(array $cookies): Psr\Http\Message\ServerRequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cookies` | `array` | - |  |

**返回**: `Psr\Http\Message\ServerRequestInterface`

#### `withQueryParams`

```php
public function withQueryParams(array $query): Psr\Http\Message\ServerRequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$query` | `array` | - |  |

**返回**: `Psr\Http\Message\ServerRequestInterface`

#### `withUploadedFiles`

```php
public function withUploadedFiles(array $uploadedFiles): Psr\Http\Message\ServerRequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$uploadedFiles` | `array` | - |  |

**返回**: `Psr\Http\Message\ServerRequestInterface`

#### `withParsedBody`

```php
public function withParsedBody($data): Psr\Http\Message\ServerRequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `mixed` | - |  |

**返回**: `Psr\Http\Message\ServerRequestInterface`

#### `getAttributes`

```php
public function getAttributes(): array
```

**返回**: `array`

#### `getAttribute`

```php
public function getAttribute(string $name, $default = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$default` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `withAttribute`

```php
public function withAttribute(string $name, $value): Psr\Http\Message\ServerRequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `Psr\Http\Message\ServerRequestInterface`

#### `withoutAttribute`

```php
public function withoutAttribute(string $name): Psr\Http\Message\ServerRequestInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Psr\Http\Message\ServerRequestInterface`

