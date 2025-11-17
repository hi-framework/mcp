---
fqcn: Hi\Event\Metadata\ListenerMetadata
type: class
namespace: Hi\Event\Metadata
module: Event
file: src/Event/Metadata/ListenerMetadata.php
line: 14
---
# ListenerMetadata

**命名空间**: `Hi\Event\Metadata`

**类型**: Class

**文件**: `src/Event/Metadata/ListenerMetadata.php:14`

Listener metadata class

Pure data structure for storing listener metadata
Immutable container for listener execution configuration
Stores pre-resolved callable for optimal runtime performance

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$eventTypes` | `array` | public readonly | - |  |
| `$callable` | `mixed` | public readonly | - |  |
| `$priority` | `int` | public readonly | 0 |  |
| `$async` | `bool` | public readonly | 'false' |  |
| `$retries` | `int` | public readonly | 0 |  |
| `$retryDelay` | `int` | public readonly | 1000 |  |
| `$enabled` | `bool` | public readonly | 'true' |  |
| `$name` | `string` | public readonly | '' |  |
| `$owner` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $eventTypes, mixed $callable, int $priority = 0, bool $async = 'false', int $retries = 0, int $retryDelay = 1000, bool $enabled = 'true', string $name = '', string $owner = '', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventTypes` | `array` | - | Supported event types |
| `$callable` | `mixed` | - | Pre-resolved listener callable (ready to execute) |
| `$priority` | `int` | 0 | Execution priority (higher = earlier) |
| `$async` | `bool` | 'false' | Whether to execute asynchronously |
| `$retries` | `int` | 0 | Maximum retry attempts for async execution |
| `$retryDelay` | `int` | 1000 | Retry delay in milliseconds |
| `$enabled` | `bool` | 'true' | Whether listener is enabled |
| `$name` | `string` | '' | Listener name/identifier |
| `$owner` | `string` | '' | Listener owner/source |
| `$desc` | `string` | '' | Listener description |

**返回**: `void`

#### `supportsEvent`

```php
public function supportsEvent(string $eventType): bool
```

Check if listener supports event type

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - |  |

**返回**: `bool`

#### `isAsync`

```php
public function isAsync(): bool
```

Check if listener is async

**返回**: `bool`

#### `isEnabled`

```php
public function isEnabled(): bool
```

Check if listener is enabled

**返回**: `bool`

#### `getPriority`

```php
public function getPriority(): int
```

Get listener priority

**返回**: `int`

#### `getCallable`

```php
public function getCallable(): callable
```

Get callable

**返回**: `callable`

#### `getEventTypes`

```php
public function getEventTypes(): array
```

Get supported event types

**返回**: `array`

#### `getRetryConfig`

```php
public function getRetryConfig(): array
```

Get retry configuration

**返回**: `array` - int, retry_delay: int}

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

