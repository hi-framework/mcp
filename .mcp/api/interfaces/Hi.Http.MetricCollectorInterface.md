---
fqcn: Hi\Http\MetricCollectorInterface
type: interface
namespace: Hi\Http
module: Http
file: src/Http/MetricCollectorInterface.php
line: 10
---
# MetricCollectorInterface

**命名空间**: `Hi\Http`

**类型**: Interface

**文件**: `src/Http/MetricCollectorInterface.php:10`

## 方法

### Public 方法

#### `collect`

```php
public function collect(Psr\Http\Message\ServerRequestInterface $request, Psr\Http\Message\ResponseInterface $response, float $startTime): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Psr\Http\Message\ServerRequestInterface` | - |  |
| `$response` | `Psr\Http\Message\ResponseInterface` | - |  |
| `$startTime` | `float` | - | http request start time |

**返回**: `void`

