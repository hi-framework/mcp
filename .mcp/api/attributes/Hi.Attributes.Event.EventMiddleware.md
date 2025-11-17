---
fqcn: Hi\Attributes\Event\EventMiddleware
type: class
namespace: Hi\Attributes\Event
module: Attributes
file: src/Attributes/Event/EventMiddleware.php
line: 13
---
# EventMiddleware

**命名空间**: `Hi\Attributes\Event`

**类型**: Class

**文件**: `src/Attributes/Event/EventMiddleware.php:13`

Event middleware attribute

Used to mark event middleware classes, simplifying middleware configuration.
Supports priority, event filtering, conditional execution and other cross-cutting concerns.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$priority` | `int` | public readonly | 0 |  |
| `$enabled` | `bool` | public readonly | 'true' |  |
| `$metadata` | `array` | public readonly | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $priority = 0, bool $enabled = 'true', array $metadata = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$priority` | `int` | 0 | Middleware priority, higher values have higher priority and execute first |
| `$enabled` | `bool` | 'true' | Whether enabled |
| `$metadata` | `array` | [] | Middleware metadata |

**返回**: `void`

#### `toArray`

```php
public function toArray(): array
```

Get complete configuration array

**返回**: `array`

## Attribute 信息

**目标**: CLASS

**可重复**: 否

### 使用示例

```php
#[EventMiddleware]
class MyClass {}
```

