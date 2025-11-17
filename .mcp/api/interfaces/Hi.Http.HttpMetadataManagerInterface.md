---
fqcn: Hi\Http\HttpMetadataManagerInterface
type: interface
namespace: Hi\Http
module: Http
file: src/Http/HttpMetadataManagerInterface.php
line: 16
---
# HttpMetadataManagerInterface

**命名空间**: `Hi\Http`

**类型**: Interface

**文件**: `src/Http/HttpMetadataManagerInterface.php:16`

Http metadata manager interface

Defines the contract for managing HTTP route and middleware metadata
Provides unified interface for HTTP system components

## 方法

### Public 方法

#### `registerRoute`

```php
public function registerRoute(Hi\Http\Metadata\RouteMetadata $metadata): void
```

Register route metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Http\Metadata\RouteMetadata` | - | Route metadata to register |

**返回**: `void`

#### `registerRoutes`

```php
public function registerRoutes(array $routes): void
```

Register multiple routes

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$routes` | `array` | - | Array of route metadata to register |

**返回**: `void`

#### `registerMiddleware`

```php
public function registerMiddleware(Hi\Http\Metadata\MiddlewareMetadata $metadata): void
```

Register middleware metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Http\Metadata\MiddlewareMetadata` | - | Middleware metadata to register |

**返回**: `void`

#### `registerMiddlewares`

```php
public function registerMiddlewares(array $middlewares): void
```

Register multiple middlewares

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middlewares` | `array` | - | Array of middleware metadata to register |

**返回**: `void`

#### `findRoute`

```php
public function findRoute(string $key): ?Hi\Http\Metadata\RouteMetadata
```

Find route by method and pattern

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - | Index key |

**返回**: `?Hi\Http\Metadata\RouteMetadata` - Route metadata if found, null otherwise

#### `getAllRoutes`

```php
public function getAllRoutes(): Hi\Http\Generator
```

Get all routes

**返回**: `Hi\Http\Generator` - Generator yielding route metadata

#### `findMiddleware`

```php
public function findMiddleware(string $name): ?Hi\Http\Metadata\MiddlewareMetadata
```

Find middleware by name or alias

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Middleware name or alias to search for |

**返回**: `?Hi\Http\Metadata\MiddlewareMetadata` - Middleware metadata if found, null otherwise

#### `getAllMiddlewares`

```php
public function getAllMiddlewares(): Hi\Http\Generator
```

Get all middlewares

**返回**: `Hi\Http\Generator` - Generator yielding middleware metadata

#### `addLoader`

```php
public function addLoader(Hi\Http\HttpLoaderInterface $loader, int $priority = 0): static
```

Add HTTP loader

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$loader` | `Hi\Http\HttpLoaderInterface` | - | HTTP loader to add |
| `$priority` | `int` | 0 | Loader priority (lower = higher priority) |

**返回**: `static` - Returns self for method chaining

#### `clear`

```php
public function clear(): void
```

Clear all caches and metadata

**返回**: `void`

#### `loadAllRoutes`

```php
public function loadAllRoutes(): void
```

Force load all routes

**返回**: `void`

#### `loadAllMiddlewares`

```php
public function loadAllMiddlewares(): void
```

Force load all middlewares

**返回**: `void`

