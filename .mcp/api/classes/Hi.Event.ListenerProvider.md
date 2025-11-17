---
fqcn: Hi\Event\ListenerProvider
type: class
namespace: Hi\Event
module: Event
file: src/Event/ListenerProvider.php
line: 16
---
# ListenerProvider

**命名空间**: `Hi\Event`

**类型**: Class

**文件**: `src/Event/ListenerProvider.php:16`

PSR-14 Listener Provider

Bridges EventMetadataManager to provide PSR-14 compliant listener iteration
Returns listeners in priority order (high priority first)

## 继承关系

**实现**: `Psr\EventDispatcher\ListenerProviderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$metadataManager` | `Hi\Event\EventMetadataManagerInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Event\EventMetadataManagerInterface $metadataManager)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadataManager` | `Hi\Event\EventMetadataManagerInterface` | - |  |

**返回**: `void`

#### `getListenersForEvent`

```php
public function getListenersForEvent(object $event): iterable
```

Get listeners for event

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$event` | `object` | - | Event instance |

**返回**: `iterable` - Callable listeners sorted by priority

#### `getListenerMetadataForEventType`

```php
public function getListenerMetadataForEventType(string $eventType): array
```

Get all listeners for event type (internal use)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - | Event class name |

**返回**: `array` - Listener metadata sorted by priority

#### `hasListeners`

```php
public function hasListeners(object $event): bool
```

Check if event has listeners

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$event` | `object` | - | Event instance |

**返回**: `bool` - True if event has at least one enabled listener

#### `getListenerCount`

```php
public function getListenerCount(object $event): int
```

Get listener count for event

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$event` | `object` | - | Event instance |

**返回**: `int` - Number of enabled listeners

