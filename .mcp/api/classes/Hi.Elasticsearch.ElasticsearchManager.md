---
fqcn: Hi\Elasticsearch\ElasticsearchManager
type: class
namespace: Hi\Elasticsearch
module: Elasticsearch
file: src/Elasticsearch/ElasticsearchManager.php
line: 15
---
# ElasticsearchManager

**命名空间**: `Hi\Elasticsearch`

**类型**: Class

**文件**: `src/Elasticsearch/ElasticsearchManager.php:15`

## 继承关系

**实现**: `Hi\Elasticsearch\ElasticsearchProviderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$instances` | `array` | protected | - |  |
| `$configs` | `array` | protected | - |  |
| `$container` | `Psr\Container\ContainerInterface` | protected readonly | - |  |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $configs, Psr\Container\ContainerInterface $container, Hi\Exception\ExceptionHandlerInterface $exceptionHandler)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$configs` | `array` | - |  |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | - |  |

**返回**: `void`

#### `getClient`

```php
public function getClient(string $name): Elastic\Elasticsearch\Client
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Elastic\Elasticsearch\Client`

### Protected 方法

#### `initClient`

```php
protected function initClient(string $name): Elastic\Elasticsearch\Client
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Elastic\Elasticsearch\Client`

#### `validateConfig`

```php
protected function validateConfig(array $config, string $name): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |
| `$name` | `string` | - |  |

**返回**: `void`

