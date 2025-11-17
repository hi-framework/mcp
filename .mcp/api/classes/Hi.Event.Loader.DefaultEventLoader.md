---
fqcn: Hi\Event\Loader\DefaultEventLoader
type: class
namespace: Hi\Event\Loader
module: Event
file: src/Event/Loader/DefaultEventLoader.php
line: 14
---
# DefaultEventLoader

**命名空间**: `Hi\Event\Loader`

**类型**: Class

**文件**: `src/Event/Loader/DefaultEventLoader.php:14`

Default Event Loader

Loads events and listeners from a default source

## 继承关系

**实现**: `Hi\Event\Loader\EventLoaderInterface`

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

**返回**: `string`

#### `findEvent`

```php
public function findEvent(string $name): ?Hi\Event\Metadata\EventMetadata
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Event\Metadata\EventMetadata`

#### `findAllEvents`

```php
public function findAllEvents(): Hi\Event\Loader\Generator|array
```

**返回**: `Hi\Event\Loader\Generator|array`

#### `findListeners`

```php
public function findListeners(string $eventType): Hi\Event\Loader\Generator|array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - |  |

**返回**: `Hi\Event\Loader\Generator|array`

#### `findAllListeners`

```php
public function findAllListeners(): Hi\Event\Loader\Generator|array
```

**返回**: `Hi\Event\Loader\Generator|array`

