---
fqcn: Hi\Http\Application
type: class
namespace: Hi\Http
module: Http
file: src/Http/Application.php
line: 21
---
# Application

**命名空间**: `Hi\Http`

**类型**: Class

**文件**: `src/Http/Application.php:21`

## 继承关系

**实现**: `Hi\Http\ApplicationInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | protected | '...' |  |
| `$runtime` | `Hi\Server\ServerInterface` | protected | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Http\RouterInterface $router = '...', Hi\Server\ServerInterface $runtime = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | '...' |  |
| `$runtime` | `Hi\Server\ServerInterface` | '...' |  |

**返回**: `void`

#### `__call`

```php
public function __call(string $name, array $arguments): Hi\Http\ApplicationInterface
```

Dynamic proxy router, register routing rules.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$arguments` | `array` | - |  |

**返回**: `Hi\Http\ApplicationInterface`

#### `setRuntime`

```php
public function setRuntime(Hi\Server\ServerInterface $server): Hi\Http\ApplicationInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$server` | `Hi\Server\ServerInterface` | - |  |

**返回**: `Hi\Http\ApplicationInterface`

#### `getRuntime`

```php
public function getRuntime(): Hi\Server\ServerInterface
```

**返回**: `Hi\Server\ServerInterface`

#### `use`

```php
public function use(callable|string $middleware): Hi\Http\ApplicationInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middleware` | `callable\|string` | - |  |

**返回**: `Hi\Http\ApplicationInterface`

#### `uses`

```php
public function uses(array $middlewares): Hi\Http\ApplicationInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middlewares` | `array` | - |  |

**返回**: `Hi\Http\ApplicationInterface`

#### `notFound`

```php
public function notFound(callable $handler): Hi\Http\ApplicationInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `callable` | - |  |

**返回**: `Hi\Http\ApplicationInterface`

#### `throw`

```php
public function throw(callable $handler): Hi\Http\ApplicationInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `callable` | - |  |

**返回**: `Hi\Http\ApplicationInterface`

#### `setBackgroundContext`

```php
public function setBackgroundContext(Hi\Http\Context $class): Hi\Http\ApplicationInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$class` | `Hi\Http\Context` | - |  |

**返回**: `Hi\Http\ApplicationInterface`

#### `getRouter`

```php
public function getRouter(): Hi\Http\RouterInterface
```

**返回**: `Hi\Http\RouterInterface`

#### `listen`

```php
public function listen(int $port = 'Hi\Server\Config::DEFAULT_PORT', string $host = 'Hi\Server\Config::DEFAULT_HOST'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$port` | `int` | 'Hi\Server\Config::DEFAULT_PORT' |  |
| `$host` | `string` | 'Hi\Server\Config::DEFAULT_HOST' |  |

**返回**: `void`

