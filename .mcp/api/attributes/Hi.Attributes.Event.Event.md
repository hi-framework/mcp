---
fqcn: Hi\Attributes\Event\Event
type: class
namespace: Hi\Attributes\Event
module: Attributes
file: src/Attributes/Event/Event.php
line: 13
---
# Event

**命名空间**: `Hi\Attributes\Event`

**类型**: Class

**文件**: `src/Attributes/Event/Event.php:13`

Event class attribute

Marks a class as an event with optional custom configuration
Used for declarative event class identification and configuration

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `?string` | public readonly | 'null' |  |
| `$stoppable` | `bool` | public readonly | 'false' |  |
| `$owner` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(?string $name = 'null', bool $stoppable = 'false', string $owner = '', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `?string` | 'null' | Custom event name (defaults to class name if not provided) |
| `$stoppable` | `bool` | 'false' | Whether event implements StoppableEventInterface |
| `$owner` | `string` | '' | Event owner/source |
| `$desc` | `string` | '' | Event description |

**返回**: `void`

#### `getName`

```php
public function getName(string $className): string
```

Get event name (use class name as fallback if not specified)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - |  |

**返回**: `string`

#### `isStoppable`

```php
public function isStoppable(): bool
```

Check if event is stoppable

**返回**: `bool`

#### `getOwner`

```php
public function getOwner(): string
```

Get event owner

**返回**: `string`

#### `getDescription`

```php
public function getDescription(): string
```

Get event description

**返回**: `string`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[Event]
class MyClass {}
```

