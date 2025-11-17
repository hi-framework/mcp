---
fqcn: Hi\Kafka\AbstractQueue
type: class
namespace: Hi\Kafka
module: Kafka
file: src/Kafka/AbstractQueue.php
line: 13
---
# AbstractQueue

**命名空间**: `Hi\Kafka`

**类型**: Class

**文件**: `src/Kafka/AbstractQueue.php:13`

**修饰符**: abstract

队列基类

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$connection` | `string` | protected | - | 队列连接 |
| `$topic` | `Hi\Kafka\TopicInterface` | protected | - | Topic enum requires inheritance from TopicInterface enum |

## 方法

### Public 方法

#### `getConnection`

```php
public function getConnection(): string
```

返回连接名称

**返回**: `string`

#### `getTopic`

```php
public function getTopic(): string
```

返回 Topic 名称

**返回**: `string`

### Protected 方法

#### `bootstrap`

```php
protected function bootstrap(): void
```

消费者/生产者启动前置操作
进行其他服务的初始化或更改配置

**返回**: `void`

