---
fqcn: Hi\Event\EventMetadataManagerInterface
type: interface
namespace: Hi\Event
module: Event
file: src/Event/EventMetadataManagerInterface.php
line: 17
---
# EventMetadataManagerInterface

**命名空间**: `Hi\Event`

**类型**: Interface

**文件**: `src/Event/EventMetadataManagerInterface.php:17`

Event metadata manager interface

Defines the contract for managing event metadata and listeners
Provides unified interface for event system components

## 方法

### Public 方法

#### `registerEvent`

```php
public function registerEvent(Hi\Event\Metadata\EventMetadata $metadata): void
```

Register event metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Event\Metadata\EventMetadata` | - | Event metadata to register |

**返回**: `void`

**抛出异常**:

- `Exception\InvalidEventMetadataException` - When event name is empty

#### `registerEvents`

```php
public function registerEvents(array $events): void
```

Register multiple events

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$events` | `array` | - | Array of event metadata to register |

**返回**: `void`

#### `registerListener`

```php
public function registerListener(Hi\Event\Metadata\ListenerMetadata $metadata): void
```

Register listener metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Event\Metadata\ListenerMetadata` | - | Listener metadata to register |

**返回**: `void`

#### `registerListeners`

```php
public function registerListeners(array $listeners): void
```

Register multiple listeners

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$listeners` | `array` | - | Array of listener metadata to register |

**返回**: `void`

#### `findEvent`

```php
public function findEvent(string $name): ?Hi\Event\Metadata\EventMetadata
```

Find event by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Event name to search for |

**返回**: `?Hi\Event\Metadata\EventMetadata` - Event metadata if found, null otherwise

#### `hasEvent`

```php
public function hasEvent(string $name): bool
```

Check if event exists

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Event name to check |

**返回**: `bool` - True if event exists, false otherwise

#### `getAllEvents`

```php
public function getAllEvents(): Hi\Event\Generator
```

Get all events

**返回**: `Hi\Event\Generator` - EventMetadata> Generator yielding event name => event metadata

#### `findListeners`

```php
public function findListeners(string $eventType): array
```

Find listeners for specific event type

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - | Event type/class name to find listeners for |

**返回**: `array` - Array of listener metadata

#### `getAllListeners`

```php
public function getAllListeners(): Hi\Event\Generator
```

Get all listeners

**返回**: `Hi\Event\Generator` - ListenerMetadata[]> Generator yielding event type => listener metadata array

#### `addLoader`

```php
public function addLoader(Hi\Event\Loader\EventLoaderInterface $loader, int $priority = 0): static
```

Add event loader

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$loader` | `Hi\Event\Loader\EventLoaderInterface` | - | Event loader to add |
| `$priority` | `int` | 0 | Loader priority (lower = higher priority) |

**返回**: `static` - Returns self for method chaining

#### `clearCache`

```php
public function clearCache(): void
```

Clear all caches

**返回**: `void`

#### `removeEvent`

```php
public function removeEvent(string $name): bool
```

Remove event

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Event name to remove |

**返回**: `bool` - True if event was removed, false if not found

#### `loadAllEvents`

```php
public function loadAllEvents(): void
```

Force load all events

**返回**: `void`

#### `loadAllListeners`

```php
public function loadAllListeners(): void
```

Force load all listeners

**返回**: `void`

