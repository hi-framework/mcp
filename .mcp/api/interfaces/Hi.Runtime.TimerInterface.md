---
fqcn: Hi\Runtime\TimerInterface
type: interface
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/TimerInterface.php
line: 7
---
# TimerInterface

**命名空间**: `Hi\Runtime`

**类型**: Interface

**文件**: `src/Runtime/TimerInterface.php:7`

## 方法

### Public 方法

#### `tick`

```php
public function tick(float $time, callable $callback, mixed ...$arguments): int
```

Run timer every $time

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$time` | `float` | - | Seconds |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - |  |

**返回**: `int`

#### `after`

```php
public function after(float $time, callable $callback, mixed ...$arguments): int
```

Run timer after $time

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$time` | `float` | - | Seconds |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - |  |

**返回**: `int`

#### `clear`

```php
public function clear(int $id): void
```

Clear the timer by id

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$id` | `int` | - |  |

**返回**: `void`

#### `cleanup`

```php
public function cleanup(): void
```

Cleanup all timers
This method should be called when the application is shutting down

**返回**: `void`

