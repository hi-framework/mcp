---
fqcn: Hi\Kafka\KafkaManager
type: class
namespace: Hi\Kafka
module: Kafka
file: src/Kafka/KafkaManager.php
line: 9
---
# KafkaManager

**命名空间**: `Hi\Kafka`

**类型**: Class

**文件**: `src/Kafka/KafkaManager.php:9`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$sideCarBridge` | `Hi\Sidecar\BridgeInterface` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Sidecar\BridgeInterface $sideCarBridge)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sideCarBridge` | `Hi\Sidecar\BridgeInterface` | - |  |

**返回**: `void`

#### `produce`

```php
public function produce(Hi\Kafka\AbstractProducer $producer): void
```

为命令行增加手动投递消息的能力

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$producer` | `Hi\Kafka\AbstractProducer` | - | 生产者类或主题实例(必须为枚举对象) |

**返回**: `void`

#### `consume`

```php
public function consume(?string $className = 'null'): void
```

启动消费者

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `?string` | 'null' | 消费者别名或类名 |

**返回**: `void`

