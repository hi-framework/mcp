---
fqcn: Hi\Http\RouterInterface
type: interface
namespace: Hi\Http
module: Http
file: src/Http/RouterInterface.php
line: 13
---
# RouterInterface

**命名空间**: `Hi\Http`

**类型**: Interface

**文件**: `src/Http/RouterInterface.php:13`

## 方法

### Public 方法

#### `get`

```php
public function get(string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register GET route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `post`

```php
public function post(string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register POST route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `put`

```php
public function put(string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register PUT route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `delete`

```php
public function delete(string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register DELETE route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `head`

```php
public function head(string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register HEAD route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `options`

```php
public function options(string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register OPTIONS route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `patch`

```php
public function patch(string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register PATCH route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `group`

```php
public function group(string $prefix, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

Register route group.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$prefix` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

#### `mount`

```php
public function mount(string $method, string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null', bool $override = 'true'): void
```

Register route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |
| `$override` | `bool` | 'true' | If true, when route already exists, it will be overridden |

**返回**: `void`

#### `setThrowHandler`

```php
public function setThrowHandler(callable|Hi\Exception\ExceptionHandlerInterface $handler): void
```

Set HTTP process throw handle.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `callable\|Hi\Exception\ExceptionHandlerInterface` | - |  |

**返回**: `void`

#### `setBackgroundContext`

```php
public function setBackgroundContext(Hi\Http\Context $class): void
```

Set route process context class.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$class` | `Hi\Http\Context` | - |  |

**返回**: `void`

#### `setNotFoundHandler`

```php
public function setNotFoundHandler(callable $handler): void
```

Register 404 handle.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `callable` | - |  |

**返回**: `void`

#### `appendMiddlewares`

```php
public function appendMiddlewares(array $middlewares): void
```

Append middlewares.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middlewares` | `array` | - |  |

**返回**: `void`

#### `getRoutes`

```php
public function getRoutes(): array
```

Get all routes.

**返回**: `array` - Route>

#### `boot`

```php
public function boot(bool $purge = 'true'): self
```

Boot before dispatch.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$purge` | `bool` | 'true' | If true, when loaded clear all routes |

**返回**: `self`

#### `dispatch`

```php
public function dispatch(string $method, string $pattern, Psr\Http\Message\ServerRequestInterface $request): Psr\Http\Message\ResponseInterface
```

Dispatch request and execute route.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$pattern` | `string` | - |  |
| `$request` | `Psr\Http\Message\ServerRequestInterface` | - |  |

**返回**: `Psr\Http\Message\ResponseInterface`

