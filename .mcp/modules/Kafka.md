---
module: Kafka
namespaces: [Hi\Kafka, Hi\Kafka\Exception]
class_count: 11
interface_count: 1
trait_count: 0
enum_count: 1
attribute_count: 0
---
# Kafka 模块

Kafka 消息队列集成

## 概览

- 类: 11
- 接口: 1
- Traits: 0
- 枚举: 1
- Attributes: 0

## 使用指南

- [Kafka 消息队列](../guides/components/kafka.md)
- [Kafka 集成](../guides/kafka/integration.md)
- [Kafka 消费者](../guides/kafka/consumer.md)
- [Kafka 生产者](../guides/kafka/producer.md)

## 核心概念

- [生命周期](../guides/concepts/lifecycle.md)
- [作用域(Scope)](../guides/concepts/scope.md)
- [服务容器](../guides/concepts/container-and-di.md)
- [注解](../guides/concepts/attributes.md)
- [运行时系统](../guides/concepts/runtime.md)

## API 参考

### 接口

| 名称 | 描述 |
| --- | --- |
| [`TopicInterface`](../api/interfaces/Hi.Kafka.TopicInterface.md) | Topic 接口 用于标记 Topic 枚举类型 |

### 类

| 名称 | 描述 |
| --- | --- |
| [`AbstractConsumer`](../api/classes/Hi.Kafka.AbstractConsumer.md) |  |
| [`ConnectionConfig`](../api/classes/Hi.Kafka.ConnectionConfig.md) | 消息队列配置 |
| [`AbstractQueue`](../api/classes/Hi.Kafka.AbstractQueue.md) | 队列基类 |
| [`KafkaManager`](../api/classes/Hi.Kafka.KafkaManager.md) |  |
| [`AbstractProducer`](../api/classes/Hi.Kafka.AbstractProducer.md) |  |
| [`KafkaConnectionConfigNotFoundException`](../api/classes/Hi.Kafka.Exception.KafkaConnectionConfigNotFoundException.md) |  |
| [`KafkaException`](../api/classes/Hi.Kafka.Exception.KafkaException.md) |  |
| [`KafkaConnectionNameUnsetException`](../api/classes/Hi.Kafka.Exception.KafkaConnectionNameUnsetException.md) |  |
| [`KafkaTopicNameUnsetException`](../api/classes/Hi.Kafka.Exception.KafkaTopicNameUnsetException.md) |  |
| [`Message`](../api/classes/Hi.Kafka.Message.md) |  |
| [`ConsumerConfig`](../api/classes/Hi.Kafka.ConsumerConfig.md) | 消费者配置 |

### 枚举

| 名称 | 描述 |
| --- | --- |
| [`ConsumeOffsetType`](../api/enums/Hi.Kafka.ConsumeOffsetType.md) | 消费者偏移量 |

