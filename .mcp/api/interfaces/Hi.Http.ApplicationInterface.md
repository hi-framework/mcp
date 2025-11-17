---
fqcn: Hi\Http\ApplicationInterface
type: interface
namespace: Hi\Http
module: Http
file: src/Http/ApplicationInterface.php
line: 9
---
# ApplicationInterface

**命名空间**: `Hi\Http`

**类型**: Interface

**文件**: `src/Http/ApplicationInterface.php:9`

## 方法

### Public 方法

#### `use`

```php
public function use(callable|string $middleware): self
```

Register global middleware.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middleware` | `callable\|string` | - |  |

**返回**: `self`

#### `uses`

```php
public function uses(array $middlewares): self
```

Register global middlewares.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middlewares` | `array` | - |  |

**返回**: `self`

#### `notFound`

```php
public function notFound(callable $handler): self
```

Set route not found handle.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `callable` | - |  |

**返回**: `self`

#### `throw`

```php
public function throw(callable $handler): self
```

Set HTTP process throw handle.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `callable` | - |  |

**返回**: `self`

#### `setBackgroundContext`

```php
public function setBackgroundContext(Hi\Http\Context $class): self
```

Set HTTP request context class.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$class` | `Hi\Http\Context` | - |  |

**返回**: `self`

#### `getRouter`

```php
public function getRouter(): Hi\Http\RouterInterface
```

Return current router.

**返回**: `Hi\Http\RouterInterface`

#### `setRuntime`

```php
public function setRuntime(Hi\Server\ServerInterface $server): self
```

Set runtime server.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$server` | `Hi\Server\ServerInterface` | - |  |

**返回**: `self`

#### `getRuntime`

```php
public function getRuntime(): Hi\Server\ServerInterface
```

Return runtime server.

**返回**: `Hi\Server\ServerInterface`

#### `listen`

```php
public function listen(int $port = 0, string $host = ''): void
```

Start HTTP server by specified port and host.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$port` | `int` | 0 |  |
| `$host` | `string` | '' |  |

**返回**: `void`

