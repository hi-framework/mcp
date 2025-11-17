---
fqcn: Hi\Http\Router\HandlerFactory
type: class
namespace: Hi\Http\Router
module: Http
file: src/Http/Router/HandlerFactory.php
line: 18
---
# HandlerFactory

**命名空间**: `Hi\Http\Router`

**类型**: Class

**文件**: `src/Http/Router/HandlerFactory.php:18`

Handler factory for creating route handlers

Creates dynamic callable handlers from route metadata using reflection

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$container` | `?Psr\Container\ContainerInterface` | private readonly | 'null' |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(?Psr\Container\ContainerInterface $container = 'null', Psr\Log\LoggerInterface $logger = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `?Psr\Container\ContainerInterface` | 'null' |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |

**返回**: `void`

#### `createHandlerFromMetadata`

```php
public function createHandlerFromMetadata(Hi\Http\Metadata\RouteMetadata $routeMetadata): ?callable
```

Create handler from route metadata using reflection information
Supports class methods, closures, functions, and other callable types

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$routeMetadata` | `Hi\Http\Metadata\RouteMetadata` | - |  |

**返回**: `?callable`

