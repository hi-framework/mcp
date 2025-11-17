---
fqcn: Hi\Http\Router
type: class
namespace: Hi\Http
module: Http
file: src/Http/Router.php
line: 24
---
# Router

**命名空间**: `Hi\Http`

**类型**: Class

**文件**: `src/Http/Router.php:24`

## 继承关系

**实现**: `Hi\Http\RouterInterface`

**使用 Traits**: `Hi\Http\Router\Traits\GroupTrait`, `Hi\Http\Router\Traits\MethodTrait`, `Hi\Http\Router\Traits\NotFoundHandlerTrait`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `NOT_FOUND_INDEX` | 'INTERNAL:404' | protected |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$routes` | `array` | protected | [] |  |
| `$pipelines` | `array` | protected | [] |  |
| `$metadataManager` | `Hi\Http\HttpMetadataManagerInterface` | protected | - |  |
| `$parameterResolver` | `Hi\Http\Router\ParameterResolver` | protected | - |  |
| `$handlerFactory` | `Hi\Http\Router\HandlerFactory` | protected | - |  |
| `$context` | `Hi\Http\Context` | protected | '...' |  |
| `$middlewares` | `array` | protected | [] |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected | '...' |  |
| `$defaultResponse` | `Hi\Http\Message\VersatileResponseInterface` | protected | '...' |  |
| `$throwHandler` | `Hi\Exception\ExceptionHandlerInterface` | protected | '...' |  |
| `$metric` | `?Hi\Http\MetricCollectorInterface` | protected readonly | 'null' |  |
| `$validator` | `?Symfony\Component\Validator\Validator\ValidatorInterface` | protected readonly | 'null' |  |
| `$container` | `?Psr\Container\ContainerInterface` | protected readonly | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(?Hi\Http\HttpMetadataManagerInterface $metadataManager = 'null', Hi\Http\Context $context = '...', array $middlewares = [], Psr\Log\LoggerInterface $logger = '...', Hi\Http\Message\VersatileResponseInterface $defaultResponse = '...', Hi\Exception\ExceptionHandlerInterface $throwHandler = '...', ?Hi\Http\MetricCollectorInterface $metric = 'null', ?Symfony\Component\Validator\Validator\ValidatorInterface $validator = 'null', ?Psr\Container\ContainerInterface $container = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadataManager` | `?Hi\Http\HttpMetadataManagerInterface` | 'null' |  |
| `$context` | `Hi\Http\Context` | '...' |  |
| `$middlewares` | `array` | [] |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |
| `$defaultResponse` | `Hi\Http\Message\VersatileResponseInterface` | '...' |  |
| `$throwHandler` | `Hi\Exception\ExceptionHandlerInterface` | '...' |  |
| `$metric` | `?Hi\Http\MetricCollectorInterface` | 'null' |  |
| `$validator` | `?Symfony\Component\Validator\Validator\ValidatorInterface` | 'null' |  |
| `$container` | `?Psr\Container\ContainerInterface` | 'null' |  |

**返回**: `void`

#### `setBackgroundContext`

```php
public function setBackgroundContext(Hi\Http\Context $class): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$class` | `Hi\Http\Context` | - |  |

**返回**: `void`

#### `setThrowHandler`

```php
public function setThrowHandler(callable|Hi\Exception\ExceptionHandlerInterface $handler): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `callable\|Hi\Exception\ExceptionHandlerInterface` | - |  |

**返回**: `void`

#### `appendMiddlewares`

```php
public function appendMiddlewares(array $middlewares): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middlewares` | `array` | - |  |

**返回**: `void`

#### `getRoutes`

```php
public function getRoutes(): array
```

**返回**: `array`

#### `mount`

```php
public function mount(string $method, string $pattern, callable $handler, ?Hi\Http\Router\Extend $extend = 'null', bool $override = 'true'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$pattern` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |
| `$override` | `bool` | 'true' |  |

**返回**: `void`

#### `boot`

```php
public function boot(bool $purge = 'true'): Hi\Http\RouterInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$purge` | `bool` | 'true' |  |

**返回**: `Hi\Http\RouterInterface`

#### `dispatch`

```php
public function dispatch(string $method, string $pattern, Psr\Http\Message\ServerRequestInterface $request): Psr\Http\Message\ResponseInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$pattern` | `string` | - |  |
| `$request` | `Psr\Http\Message\ServerRequestInterface` | - |  |

**返回**: `Psr\Http\Message\ResponseInterface`

### Protected 方法

#### `joinIndex`

**标记**: static

```php
protected static function joinIndex(string $method, string $path): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$path` | `string` | - |  |

**返回**: `string`

#### `pipeization`

```php
protected function pipeization(): void
```

Covering route pipeline.

**返回**: `void`

#### `clearMemory`

```php
protected function clearMemory(): void
```

**返回**: `void`

