---
fqcn: Hi\Http\HttpMetadataManager
type: class
namespace: Hi\Http
module: Http
file: src/Http/HttpMetadataManager.php
line: 17
---
# HttpMetadataManager

**命名空间**: `Hi\Http`

**类型**: Class

**文件**: `src/Http/HttpMetadataManager.php:17`

Http metadata manager

Manages storage, lookup and on-demand loading of route and middleware metadata
Based on EventMetadataManager architecture pattern

## 继承关系

**实现**: `Hi\Http\HttpMetadataManagerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$routes` | `array` | private | [] |  |
| `$middlewares` | `array` | private | [] |  |
| `$loaders` | `array` | private | [] |  |
| `$routeLoadAttempts` | `array` | private | [] |  |
| `$middlewareLoadAttempts` | `array` | private | [] |  |
| `$loadersSorted` | `bool` | private | 'false' |  |
| `$loadedAllRoutes` | `bool` | private | 'false' |  |
| `$loadedAllMiddlewares` | `bool` | private | 'false' |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

#### `__destruct`

```php
public function __destruct()
```

**返回**: `void`

#### `registerRoute`

```php
public function registerRoute(Hi\Http\Metadata\RouteMetadata $metadata): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Http\Metadata\RouteMetadata` | - |  |

**返回**: `void`

#### `registerRoutes`

```php
public function registerRoutes(array $routes): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$routes` | `array` | - |  |

**返回**: `void`

#### `registerMiddleware`

```php
public function registerMiddleware(Hi\Http\Metadata\MiddlewareMetadata $metadata): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Http\Metadata\MiddlewareMetadata` | - |  |

**返回**: `void`

#### `registerMiddlewares`

```php
public function registerMiddlewares(array $middlewares): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middlewares` | `array` | - |  |

**返回**: `void`

#### `findRoute`

```php
public function findRoute(string $key): ?Hi\Http\Metadata\RouteMetadata
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `?Hi\Http\Metadata\RouteMetadata`

#### `getAllRoutes`

```php
public function getAllRoutes(): Hi\Http\Generator
```

**返回**: `Hi\Http\Generator`

#### `findMiddleware`

```php
public function findMiddleware(string $name): ?Hi\Http\Metadata\MiddlewareMetadata
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Http\Metadata\MiddlewareMetadata`

#### `getAllMiddlewares`

```php
public function getAllMiddlewares(): Hi\Http\Generator
```

**返回**: `Hi\Http\Generator`

#### `addLoader`

```php
public function addLoader(Hi\Http\HttpLoaderInterface $loader, int $priority = 0): static
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$loader` | `Hi\Http\HttpLoaderInterface` | - |  |
| `$priority` | `int` | 0 |  |

**返回**: `static`

#### `clear`

```php
public function clear(): void
```

**返回**: `void`

#### `loadAllRoutes`

```php
public function loadAllRoutes(): void
```

**返回**: `void`

#### `loadAllMiddlewares`

```php
public function loadAllMiddlewares(): void
```

**返回**: `void`

