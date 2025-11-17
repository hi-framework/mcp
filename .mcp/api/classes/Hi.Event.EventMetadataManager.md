---
fqcn: Hi\Event\EventMetadataManager
type: class
namespace: Hi\Event
module: Event
file: src/Event/EventMetadataManager.php
line: 19
---
# EventMetadataManager

**命名空间**: `Hi\Event`

**类型**: Class

**文件**: `src/Event/EventMetadataManager.php:19`

Event metadata manager

Manages storage, lookup and on-demand loading of event metadata and listeners
Based on CommandMetadataManager architecture pattern

## 继承关系

**实现**: `Hi\Event\EventMetadataManagerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$events` | `array` | private | [] |  |
| `$listeners` | `array` | private | [] |  |
| `$loaders` | `array` | private | [] |  |
| `$loadAttempts` | `array` | private | [] |  |
| `$listenerLoadAttempts` | `array` | private | [] |  |
| `$loadersSorted` | `bool` | private | 'false' |  |
| `$loadedAllEvents` | `bool` | private | 'false' |  |
| `$loadedAllListeners` | `bool` | private | 'false' |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

#### `registerEvent`

```php
public function registerEvent(Hi\Event\Metadata\EventMetadata $metadata): void
```

Register event metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Event\Metadata\EventMetadata` | - |  |

**返回**: `void`

#### `registerEvents`

```php
public function registerEvents(array $events): void
```

Register multiple events

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$events` | `array` | - |  |

**返回**: `void`

#### `registerListener`

```php
public function registerListener(Hi\Event\Metadata\ListenerMetadata $metadata): void
```

Register listener metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metadata` | `Hi\Event\Metadata\ListenerMetadata` | - |  |

**返回**: `void`

#### `registerListeners`

```php
public function registerListeners(array $listeners): void
```

Register multiple listeners

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$listeners` | `array` | - |  |

**返回**: `void`

#### `findEvent`

```php
public function findEvent(string $name): ?Hi\Event\Metadata\EventMetadata
```

Find event by name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Event\Metadata\EventMetadata`

#### `hasEvent`

```php
public function hasEvent(string $name): bool
```

Check if event exists

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `getAllEvents`

```php
public function getAllEvents(): Hi\Event\Generator
```

Get all events

**返回**: `Hi\Event\Generator` - EventMetadata>

#### `findListeners`

```php
public function findListeners(string $eventType): array
```

Find listeners for specific event type

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - |  |

**返回**: `array`

#### `getAllListeners`

```php
public function getAllListeners(): Hi\Event\Generator
```

Get all listeners

**返回**: `Hi\Event\Generator` - ListenerMetadata[]>

#### `addLoader`

```php
public function addLoader(Hi\Event\Loader\EventLoaderInterface $loader, int $priority = 0): static
```

Add event loader

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$loader` | `Hi\Event\Loader\EventLoaderInterface` | - |  |
| `$priority` | `int` | 0 |  |

**返回**: `static`

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
| `$name` | `string` | - |  |

**返回**: `bool`

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

