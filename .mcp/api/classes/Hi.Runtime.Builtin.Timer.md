---
fqcn: Hi\Runtime\Builtin\Timer
type: class
namespace: Hi\Runtime\Builtin
module: Runtime
file: src/Runtime/Builtin/Timer.php
line: 9
---
# Timer

**命名空间**: `Hi\Runtime\Builtin`

**类型**: Class

**文件**: `src/Runtime/Builtin/Timer.php:9`

## 继承关系

**实现**: `Hi\Runtime\TimerInterface`

## 方法

### Public 方法

#### `tick`

```php
public function tick(float $time, callable $callback, mixed ...$arguments): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$time` | `float` | - |  |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - |  |

**返回**: `int`

#### `after`

```php
public function after(float $time, callable $callback, mixed ...$arguments): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$time` | `float` | - |  |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - |  |

**返回**: `int`

#### `clear`

```php
public function clear(int $id): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$id` | `int` | - |  |

**返回**: `void`

#### `cleanup`

```php
public function cleanup(): void
```

**返回**: `void`

