---
fqcn: Hi\Attributes\Event\EventListener
type: class
namespace: Hi\Attributes\Event
module: Attributes
file: src/Attributes/Event/EventListener.php
line: 15
---
# EventListener

**命名空间**: `Hi\Attributes\Event`

**类型**: Class

**文件**: `src/Attributes/Event/EventListener.php:15`

Event listener attribute for marking listener methods

Used to mark methods as event listeners for automatic discovery and registration
by the EventAttributeLoader component

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$event` | `string\|array` | public readonly | - |  |
| `$priority` | `int` | public readonly | 0 |  |
| `$async` | `bool` | public readonly | 'false' |  |
| `$retries` | `int` | public readonly | 0 |  |
| `$retryDelay` | `int` | public readonly | 1000 |  |
| `$enabled` | `bool` | public readonly | 'true' |  |
| `$owner` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string|array $event, int $priority = 0, bool $async = 'false', int $retries = 0, int $retryDelay = 1000, bool $enabled = 'true', string $owner = '', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$event` | `string\|array` | - | Event type(s) this listener handles |
| `$priority` | `int` | 0 | Listener priority (higher = executed first) |
| `$async` | `bool` | 'false' | Whether listener should execute asynchronously |
| `$retries` | `int` | 0 | Maximum retry attempts for failed execution |
| `$retryDelay` | `int` | 1000 | Delay between retries in milliseconds |
| `$enabled` | `bool` | 'true' | Whether listener is currently enabled |
| `$owner` | `string` | '' | Listener owner/source |
| `$desc` | `string` | '' | Listener description |

**返回**: `void`

#### `getEventTypes`

```php
public function getEventTypes(): array
```

Get event types as array

**返回**: `array`

#### `getRetryConfig`

```php
public function getRetryConfig(): array
```

Get retry configuration

**返回**: `array` - int, retryDelay: int}

#### `getOwner`

```php
public function getOwner(): string
```

Get listener owner

**返回**: `string`

#### `getDescription`

```php
public function getDescription(): string
```

Get listener description

**返回**: `string`

## Attribute 信息

**目标**: CLASS, METHOD

**可重复**: 否

### 使用示例

```php
#[EventListener(event: '/example')]
class MyClass {}
```

