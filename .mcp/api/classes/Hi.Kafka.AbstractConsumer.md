---
fqcn: Hi\Kafka\AbstractConsumer
type: class
namespace: Hi\Kafka
module: Kafka
file: src/Kafka/AbstractConsumer.php
line: 10
---
# AbstractConsumer

**命名空间**: `Hi\Kafka`

**类型**: Class

**文件**: `src/Kafka/AbstractConsumer.php:10`

**修饰符**: abstract

## 继承关系

**继承**: `Hi\Kafka\AbstractQueue`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$config` | `Hi\Kafka\ConsumerConfig` | protected | - |  |
| `$closed` | `bool` | protected | 'false' |  |
| `$fetchSize` | `int` | protected | 1024 | 消息批量获取数量 |
| `$groupId` | `string` | protected | '' | 消费者名称(为空取服务名+类名) |

## 方法

### Public 方法

#### `execute`

```php
public function execute(Hi\Sidecar\BridgeInterface $sideCarBridge): void
```

创建消费者实例并执行消费

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sideCarBridge` | `Hi\Sidecar\BridgeInterface` | - |  |

**返回**: `void`

#### `close`

```php
public function close(): void
```

关闭消费者

**返回**: `void`

#### `consume`

**标记**: abstract

```php
abstract public function consume(?Hi\Kafka\Message $message): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `?Hi\Kafka\Message` | - |  |

**返回**: `void`

### Protected 方法

#### `initConfig`

```php
protected function initConfig(): self
```

**返回**: `self`

#### `flush`

```php
protected function flush(): void
```

Consumer is already closed.
Flush pending data

**返回**: `void`

