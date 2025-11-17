---
fqcn: Hi\Event\Loader\EventLoaderInterface
type: interface
namespace: Hi\Event\Loader
module: Event
file: src/Event/Loader/EventLoaderInterface.php
line: 16
---
# EventLoaderInterface

**命名空间**: `Hi\Event\Loader`

**类型**: Interface

**文件**: `src/Event/Loader/EventLoaderInterface.php:16`

Event loader interface

Unified loader contract for event system components
Based on CommandLoaderInterface architecture pattern

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

Get loader name

**返回**: `string`

#### `findEvent`

```php
public function findEvent(string $name): ?Hi\Event\Metadata\EventMetadata
```

Find event by name on-demand

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Event name |

**返回**: `?Hi\Event\Metadata\EventMetadata` - Event metadata, null if not found

#### `findAllEvents`

```php
public function findAllEvents(): Hi\Event\Loader\Generator|array
```

Get all events

**返回**: `Hi\Event\Loader\Generator|array` - EventMetadata>|array<string, EventMetadata> Event name => event metadata

#### `findListeners`

```php
public function findListeners(string $eventType): Hi\Event\Loader\Generator|array
```

Find listeners for specific event type

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - | Event type/class name |

**返回**: `Hi\Event\Loader\Generator|array` - Listener metadata array

#### `findAllListeners`

```php
public function findAllListeners(): Hi\Event\Loader\Generator|array
```

Get all listeners

**返回**: `Hi\Event\Loader\Generator|array` - All listener metadata

