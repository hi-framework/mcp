---
fqcn: Hi\Kafka\ConnectionConfig
type: class
namespace: Hi\Kafka
module: Kafka
file: src/Kafka/ConnectionConfig.php
line: 10
---
# ConnectionConfig

**命名空间**: `Hi\Kafka`

**类型**: Class

**文件**: `src/Kafka/ConnectionConfig.php:10`

消息队列配置

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$brokers` | `array` | public readonly | - |  |
| `$sasl` | `?array` | public readonly | 'null' |  |
| `$ssl` | `?array` | public readonly | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $brokers, ?array $sasl = 'null', ?array $ssl = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$brokers` | `array` | - |  |
| `$sasl` | `?array` | 'null' |  |
| `$ssl` | `?array` | 'null' |  |

**返回**: `void`

