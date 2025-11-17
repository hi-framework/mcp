---
fqcn: Hi\Http\Middleware\CorsDefaultMiddleware
type: class
namespace: Hi\Http\Middleware
module: Http
file: src/Http/Middleware/CorsDefaultMiddleware.php
line: 16
---
# CorsDefaultMiddleware

**命名空间**: `Hi\Http\Middleware`

**类型**: Class

**文件**: `src/Http/Middleware/CorsDefaultMiddleware.php:16`

CORS Middleware.

## 继承关系

**实现**: `Hi\Http\Middleware\MiddlewareInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$allowedOrigins` | `array` | protected | [] | Allowed origins. |
| `$allowedHeaders` | `array` | protected | [] | Allowed headers. |
| `$allowedMethods` | `array` | protected | [] | Allowed methods. |
| `$allowedCredentials` | `array` | protected | [] | Allowed credentials. |
| `$exposedHeaders` | `array` | protected | [] | Exposed headers. |
| `$maxAge` | `int` | protected | 86400 | Grant policy cache max age. |

## 方法

### Public 方法

#### `handle`

```php
public function handle(Hi\Http\Context $context, callable $next): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `Hi\Http\Context` | - |  |
| `$next` | `callable` | - |  |

**返回**: `mixed`

### Protected 方法

#### `handleOptions`

```php
protected function handleOptions(Hi\Http\Context $ctx, string $origin): Hi\Http\Message\Response
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$ctx` | `Hi\Http\Context` | - |  |
| `$origin` | `string` | - |  |

**返回**: `Hi\Http\Message\Response`

#### `checkOriginAllowed`

```php
protected function checkOriginAllowed(string $origin): false|string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$origin` | `string` | - |  |

**返回**: `false|string`

#### `prepareAllowedHeaders`

```php
protected function prepareAllowedHeaders(): array
```

**返回**: `array`

#### `prepareAllowedMethods`

```php
protected function prepareAllowedMethods(): array
```

**返回**: `array`

#### `prepareAllowedCredentials`

```php
protected function prepareAllowedCredentials(): array
```

**返回**: `array`

#### `prepareExposedHeaders`

```php
protected function prepareExposedHeaders(): array
```

**返回**: `array`

#### `prepareMaxAge`

```php
protected function prepareMaxAge(): int
```

**返回**: `int`

