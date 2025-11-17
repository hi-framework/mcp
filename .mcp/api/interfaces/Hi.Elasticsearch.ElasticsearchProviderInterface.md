---
fqcn: Hi\Elasticsearch\ElasticsearchProviderInterface
type: interface
namespace: Hi\Elasticsearch
module: Elasticsearch
file: src/Elasticsearch/ElasticsearchProviderInterface.php
line: 9
---
# ElasticsearchProviderInterface

**命名空间**: `Hi\Elasticsearch`

**类型**: Interface

**文件**: `src/Elasticsearch/ElasticsearchProviderInterface.php:9`

## 方法

### Public 方法

#### `getClient`

```php
public function getClient(string $name): Elastic\Elasticsearch\Client
```

Get a elasticsearch client by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Elastic\Elasticsearch\Client`

