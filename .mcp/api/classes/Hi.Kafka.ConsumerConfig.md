---
fqcn: Hi\Kafka\ConsumerConfig
type: class
namespace: Hi\Kafka
module: Kafka
file: src/Kafka/ConsumerConfig.php
line: 10
---
# ConsumerConfig

**命名空间**: `Hi\Kafka`

**类型**: Class

**文件**: `src/Kafka/ConsumerConfig.php:10`

消费者配置

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$connection` | `string` | protected | - |  |
| `$topics` | `array` | protected | [] |  |
| `$autoCreateTopic` | `bool` | protected | 'true' |  |
| `$groupId` | `string` | protected | - |  |
| `$blockRebalanceOnPoll` | `bool` | protected | 'false' |  |
| `$consumeRegexp` | `bool` | protected | 'false' |  |
| `$offsetType` | `Hi\Kafka\ConsumeOffsetType` | protected | 'Hi\Kafka\ConsumeOffsetType::AtEnd' |  |
| `$offsetValue` | `int` | protected | 0 |  |

## 方法

### Public 方法

#### `setConnection`

```php
public function setConnection(string $connection): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `string` | - |  |

**返回**: `void`

#### `setTopic`

```php
public function setTopic(string $topic): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$topic` | `string` | - |  |

**返回**: `void`

#### `setAutoCreateTopic`

```php
public function setAutoCreateTopic(bool $autoCreateTopic): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$autoCreateTopic` | `bool` | - |  |

**返回**: `void`

#### `setGroupId`

```php
public function setGroupId(string $groupId): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$groupId` | `string` | - |  |

**返回**: `void`

#### `setBlockRebalanceOnPoll`

```php
public function setBlockRebalanceOnPoll(bool $blockRebalanceOnPoll): void
```

是否在轮询时阻止重新平衡

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$blockRebalanceOnPoll` | `bool` | - |  |

**返回**: `void`

#### `setConsumeRegexp`

```php
public function setConsumeRegexp(bool $consumeRegexp): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$consumeRegexp` | `bool` | - |  |

**返回**: `void`

#### `setOffset`

```php
public function setOffset(Hi\Kafka\ConsumeOffsetType $type, int $value = 0): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$type` | `Hi\Kafka\ConsumeOffsetType` | - |  |
| `$value` | `int` | 0 |  |

**返回**: `void`

#### `toArray`

```php
public function toArray(): array
```

**返回**: `array`

