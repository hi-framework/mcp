---
fqcn: Hi\Elasticsearch\Elasticsearch
type: class
namespace: Hi\Elasticsearch
module: Elasticsearch
file: src/Elasticsearch/Elasticsearch.php
line: 7
---
# Elasticsearch

**命名空间**: `Hi\Elasticsearch`

**类型**: Class

**文件**: `src/Elasticsearch/Elasticsearch.php:7`

**修饰符**: abstract

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$provider` | `Hi\Elasticsearch\ElasticsearchProviderInterface` | protected | - |  |
| `$connection` | `string` | protected | - | 连接名称 |
| `$index` | `string` | protected | - | 索引名称 |

## 方法

### Public 方法

#### `autowirePool`

```php
public function autowirePool(Hi\Elasticsearch\ElasticsearchProviderInterface $provider): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$provider` | `Hi\Elasticsearch\ElasticsearchProviderInterface` | - |  |

**返回**: `self`

#### `getIndex`

```php
public function getIndex(): string
```

返回索引名称

**返回**: `string`

#### `__call`

```php
public function __call(string $name, array $arguments)
```

需要动态调用的方法需要在此手动添加

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$arguments` | `array` | - |  |

**返回**: `mixed`

### Protected 方法

#### `run`

```php
protected function run(callable $callback): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |

**返回**: `mixed`

#### `setIndex`

```php
protected function setIndex(string $index): self
```

设置索引名称

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$index` | `string` | - |  |

**返回**: `self`

