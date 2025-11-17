---
fqcn: Hi\Event\Metadata\EventMetadata
type: class
namespace: Hi\Event\Metadata
module: Event
file: src/Event/Metadata/EventMetadata.php
line: 13
---
# EventMetadata

**命名空间**: `Hi\Event\Metadata`

**类型**: Class

**文件**: `src/Event/Metadata/EventMetadata.php:13`

Event metadata class

Pure data structure for storing event metadata
Immutable container following the CommandMetadata architecture pattern

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | public readonly | - |  |
| `$className` | `string` | public readonly | - |  |
| `$isStoppable` | `bool` | public readonly | 'false' |  |
| `$owner` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, string $className, bool $isStoppable = 'false', string $owner = '', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - | Event name |
| `$className` | `string` | - | Event class name |
| `$isStoppable` | `bool` | 'false' | Whether event implements StoppableEventInterface |
| `$owner` | `string` | '' | Event owner/source |
| `$desc` | `string` | '' | Event description |

**返回**: `void`

#### `isStoppable`

```php
public function isStoppable(): bool
```

Check if event is stoppable

**返回**: `bool`

#### `getName`

```php
public function getName(): string
```

Get event name

**返回**: `string`

#### `getClassName`

```php
public function getClassName(): string
```

Get event class name

**返回**: `string`

#### `getOwner`

```php
public function getOwner(): string
```

Get event owner

**返回**: `string`

