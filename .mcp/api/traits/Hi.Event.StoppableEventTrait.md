---
fqcn: Hi\Event\StoppableEventTrait
type: trait
namespace: Hi\Event
module: Event
file: src/Event/StoppableEventTrait.php
line: 13
---
# StoppableEventTrait

**命名空间**: `Hi\Event`

**类型**: Trait

**文件**: `src/Event/StoppableEventTrait.php:13`

Stoppable Event Trait

Provides reusable implementation of event propagation control
for classes that need to implement StoppableEventInterface

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$propagationStopped` | `bool` | private | 'false' |  |

## 方法

### Public 方法

#### `stopPropagation`

```php
public function stopPropagation(): void
```

Stop event propagation

**返回**: `void`

#### `isPropagationStopped`

```php
public function isPropagationStopped(): bool
```

Check if event propagation has been stopped

**返回**: `bool` - True if propagation is stopped, false otherwise

