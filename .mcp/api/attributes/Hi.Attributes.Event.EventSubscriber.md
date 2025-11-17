---
fqcn: Hi\Attributes\Event\EventSubscriber
type: class
namespace: Hi\Attributes\Event
module: Attributes
file: src/Attributes/Event/EventSubscriber.php
line: 16
---
# EventSubscriber

**命名空间**: `Hi\Attributes\Event`

**类型**: Class

**文件**: `src/Attributes/Event/EventSubscriber.php:16`

Event subscriber attribute for marking subscriber classes

Used to mark classes as event subscribers for automatic discovery and registration.
Subscriber classes contain multiple listener methods and provide default configuration
that can be overridden by individual #[EventListener] method attributes.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
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
public function __construct(int $priority = 0, bool $async = 'false', int $retries = 0, int $retryDelay = 1000, bool $enabled = 'true', string $owner = '', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$priority` | `int` | 0 | Default priority for all listener methods in this subscriber |
| `$async` | `bool` | 'false' | Default async behavior for all listener methods in this subscriber |
| `$retries` | `int` | 0 | Default max retries for all listener methods in this subscriber |
| `$retryDelay` | `int` | 1000 | Default retry delay in milliseconds for all listener methods in this subscriber |
| `$enabled` | `bool` | 'true' | Default enabled status for all listener methods in this subscriber |
| `$owner` | `string` | '' | Default owner/source for all listener methods in this subscriber |
| `$desc` | `string` | '' | Default description for all listener methods in this subscriber |

**返回**: `void`

#### `getDefaultRetryConfig`

```php
public function getDefaultRetryConfig(): array
```

Get default retry configuration

**返回**: `array` - int, retryDelay: int}

#### `getOwner`

```php
public function getOwner(): string
```

Get default owner

**返回**: `string`

#### `getDescription`

```php
public function getDescription(): string
```

Get default description

**返回**: `string`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[EventSubscriber]
class MyClass {}
```

