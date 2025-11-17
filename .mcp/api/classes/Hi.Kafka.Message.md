---
fqcn: Hi\Kafka\Message
type: class
namespace: Hi\Kafka
module: Kafka
file: src/Kafka/Message.php
line: 7
---
# Message

**命名空间**: `Hi\Kafka`

**类型**: Class

**文件**: `src/Kafka/Message.php:7`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$topic` | `string` | public readonly | - |  |
| `$partition` | `int` | public readonly | - |  |
| `$key` | `?string` | public readonly | - |  |
| `$value` | `?string` | public readonly | - |  |
| `$headers` | `array` | public readonly | - |  |
| `$offset` | `int` | public readonly | - |  |
| `$attrs` | `array` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $topic, int $partition, ?string $key, ?string $value, array $headers, int $offset, array $attrs)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$topic` | `string` | - |  |
| `$partition` | `int` | - |  |
| `$key` | `?string` | - |  |
| `$value` | `?string` | - |  |
| `$headers` | `array` | - |  |
| `$offset` | `int` | - |  |
| `$attrs` | `array` | - |  |

**返回**: `void`

#### `getTopic`

```php
public function getTopic(): string
```

**返回**: `string`

#### `getPartition`

```php
public function getPartition(): int
```

**返回**: `int`

#### `getKey`

```php
public function getKey(): ?string
```

**返回**: `?string`

#### `getValue`

```php
public function getValue(): ?string
```

**返回**: `?string`

#### `getHeaders`

```php
public function getHeaders(): array
```

**返回**: `array`

#### `getOffset`

```php
public function getOffset(): int
```

**返回**: `int`

#### `getAttrs`

```php
public function getAttrs(): array
```

**返回**: `array`

