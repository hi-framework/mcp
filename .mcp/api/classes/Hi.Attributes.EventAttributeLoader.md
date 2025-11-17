---
fqcn: Hi\Attributes\EventAttributeLoader
type: class
namespace: Hi\Attributes
module: Attributes
file: src/Attributes/EventAttributeLoader.php
line: 24
---
# EventAttributeLoader

**命名空间**: `Hi\Attributes`

**类型**: Class

**文件**: `src/Attributes/EventAttributeLoader.php:24`

Event attribute loader

Simple and focused implementation for discovering event and listener definitions through PHP 8+ attributes.
Inherits AwesomeAttributeLoader to reuse reflection capabilities and follows Hi Framework patterns.

## 继承关系

**继承**: `Hi\Attributes\AwesomeAttributeLoader`

**实现**: `Hi\Event\Loader\EventLoaderInterface`

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
| `$name` | `string` | - |  |

**返回**: `?Hi\Event\Metadata\EventMetadata`

#### `findAllEvents`

```php
public function findAllEvents(): Hi\Attributes\Generator
```

Get all events

**返回**: `Hi\Attributes\Generator` - EventMetadata>

#### `findListeners`

```php
public function findListeners(string $eventType): Hi\Attributes\Generator
```

Find listeners for specific event type

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - |  |

**返回**: `Hi\Attributes\Generator`

#### `findAllListeners`

```php
public function findAllListeners(): Hi\Attributes\Generator
```

Get all listeners

**返回**: `Hi\Attributes\Generator`

### Protected 方法

#### `ensureTokenized`

```php
protected function ensureTokenized(): void
```

Ensure tokenization is complete

**返回**: `void`

