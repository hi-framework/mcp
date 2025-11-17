---
fqcn: Hi\Http\Metadata\RouteMetadata
type: class
namespace: Hi\Http\Metadata
module: Http
file: src/Http/Metadata/RouteMetadata.php
line: 14
---
# RouteMetadata

**命名空间**: `Hi\Http\Metadata`

**类型**: Class

**文件**: `src/Http/Metadata/RouteMetadata.php:14`

Route metadata class

Pure data structure for storing route metadata with reflection information
Supports both class-method handlers and closure/function handlers
Immutable container following the Event module metadata pattern

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$method` | `string` | public readonly | - |  |
| `$pattern` | `string` | public readonly | - |  |
| `$handler` | `mixed` | public readonly | 'null' |  |
| `$classReflection` | `?Hi\Http\Metadata\ReflectionClass` | public readonly | 'null' |  |
| `$methodReflection` | `?Hi\Http\Metadata\ReflectionMethod` | public readonly | 'null' |  |
| `$functionReflection` | `?Hi\Http\Metadata\ReflectionFunction` | public readonly | 'null' |  |
| `$middlewares` | `array` | public readonly | [] |  |
| `$parameters` | `array` | public readonly | [] |  |
| `$auth` | `?bool` | public readonly | 'null' |  |
| `$cors` | `string` | public readonly | '' |  |
| `$priority` | `int` | public readonly | 0 |  |
| `$owner` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |
| `$attributes` | `array` | public readonly | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $method, string $pattern, mixed $handler = 'null', ?Hi\Http\Metadata\ReflectionClass $classReflection = 'null', ?Hi\Http\Metadata\ReflectionMethod $methodReflection = 'null', ?Hi\Http\Metadata\ReflectionFunction $functionReflection = 'null', array $middlewares = [], array $parameters = [], ?bool $auth = 'null', string $cors = '', int $priority = 0, string $owner = '', string $desc = '', array $attributes = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - | HTTP method |
| `$pattern` | `string` | - | URL pattern |
| `$handler` | `mixed` | 'null' | Callable handler (for closures/functions) |
| `$classReflection` | `?Hi\Http\Metadata\ReflectionClass` | 'null' | Class reflection information (for class methods) |
| `$methodReflection` | `?Hi\Http\Metadata\ReflectionMethod` | 'null' | Method reflection information (for class methods) |
| `$functionReflection` | `?Hi\Http\Metadata\ReflectionFunction` | 'null' | Function reflection information (for functions/closures) |
| `$middlewares` | `array` | [] | Middleware name list (referenced by name) |
| `$parameters` | `array` | [] |  |
| `$auth` | `?bool` | 'null' | Authentication requirement |
| `$cors` | `string` | '' | CORS support(middleware alias, empty means no CORS) |
| `$priority` | `int` | 0 | Priority |
| `$owner` | `string` | '' | Owner |
| `$desc` | `string` | '' | Description |
| `$attributes` | `array` | [] |  |

**返回**: `void`

#### `getRouteIndex`

```php
public function getRouteIndex(): string
```

Get route index for O(1) lookup

**返回**: `string`

#### `hasCallableHandler`

```php
public function hasCallableHandler(): bool
```

Check if this route uses a callable handler (closure/function)

**返回**: `bool`

#### `hasClassMethodHandler`

```php
public function hasClassMethodHandler(): bool
```

Check if this route uses a class method handler

**返回**: `bool`

#### `getParameterReflection`

```php
public function getParameterReflection(): Hi\Http\Metadata\ReflectionFunctionAbstract
```

Get the reflection for parameter analysis
Returns the appropriate reflection object based on handler type

**返回**: `Hi\Http\Metadata\ReflectionFunctionAbstract`

