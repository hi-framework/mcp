---
fqcn: Hi\Kafka\AbstractProducer
type: class
namespace: Hi\Kafka
module: Kafka
file: src/Kafka/AbstractProducer.php
line: 9
---
# AbstractProducer

**命名空间**: `Hi\Kafka`

**类型**: Class

**文件**: `src/Kafka/AbstractProducer.php:9`

**修饰符**: abstract

## 继承关系

**继承**: `Hi\Kafka\AbstractQueue`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$key` | `string` | protected | '' |  |
| `$headers` | `array` | protected | [] |  |
| `$syncMode` | `bool` | protected | 'false' |  |
| `$data` | `mixed` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(mixed $data)
```

生产者构造方法

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `mixed` | - | 生产者数据 |

**返回**: `void`

#### `send`

```php
public function send(Hi\Sidecar\BridgeInterface $sideCarBridge): void
```

连接消息队列并批量发送消息

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sideCarBridge` | `Hi\Sidecar\BridgeInterface` | - |  |

**返回**: `void`

