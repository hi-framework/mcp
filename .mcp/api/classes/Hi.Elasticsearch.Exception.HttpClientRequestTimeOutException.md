---
fqcn: Hi\Elasticsearch\Exception\HttpClientRequestTimeOutException
type: class
namespace: Hi\Elasticsearch\Exception
module: Elasticsearch
file: src/Elasticsearch/Exception/HttpClientRequestTimeOutException.php
line: 10
---
# HttpClientRequestTimeOutException

**命名空间**: `Hi\Elasticsearch\Exception`

**类型**: Class

**文件**: `src/Elasticsearch/Exception/HttpClientRequestTimeOutException.php:10`

## 继承关系

**继承**: `Hi\Elasticsearch\Exception\RuntimeException`

**实现**: `Psr\Http\Client\RequestExceptionInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$request` | `Psr\Http\Message\RequestInterface` | private | - |  |

## 方法

### Public 方法

#### `withRequest`

```php
public function withRequest(Psr\Http\Message\RequestInterface $request): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Psr\Http\Message\RequestInterface` | - |  |

**返回**: `self`

#### `getRequest`

```php
public function getRequest(): Psr\Http\Message\RequestInterface
```

**返回**: `Psr\Http\Message\RequestInterface`

