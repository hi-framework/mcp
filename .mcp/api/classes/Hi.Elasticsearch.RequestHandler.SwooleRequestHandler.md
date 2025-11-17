---
fqcn: Hi\Elasticsearch\RequestHandler\SwooleRequestHandler
type: class
namespace: Hi\Elasticsearch\RequestHandler
module: Elasticsearch
file: src/Elasticsearch/RequestHandler/SwooleRequestHandler.php
line: 15
---
# SwooleRequestHandler

**命名空间**: `Hi\Elasticsearch\RequestHandler`

**类型**: Class

**文件**: `src/Elasticsearch/RequestHandler/SwooleRequestHandler.php:15`

## 继承关系

**继承**: `Hi\Elasticsearch\RequestHandler`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$container` | `Spiral\Core\Container` | protected readonly | - |  |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $connectionName, array $config, Spiral\Core\Container $container, Hi\Exception\ExceptionHandlerInterface $exceptionHandler)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connectionName` | `string` | - |  |
| `$config` | `array` | - |  |
| `$container` | `Spiral\Core\Container` | - |  |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | - |  |

**返回**: `void`

#### `sendRequest`

```php
public function sendRequest(Psr\Http\Message\RequestInterface $request): Psr\Http\Message\ResponseInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Psr\Http\Message\RequestInterface` | - |  |

**返回**: `Psr\Http\Message\ResponseInterface`

