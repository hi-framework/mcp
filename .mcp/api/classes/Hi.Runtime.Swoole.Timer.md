---
fqcn: Hi\Runtime\Swoole\Timer
type: class
namespace: Hi\Runtime\Swoole
module: Runtime
file: src/Runtime/Swoole/Timer.php
line: 9
---
# Timer

**命名空间**: `Hi\Runtime\Swoole`

**类型**: Class

**文件**: `src/Runtime/Swoole/Timer.php:9`

## 继承关系

**实现**: `Hi\Runtime\TimerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$timers` | `array` | protected | [] |  |

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

### Protected 方法

#### `convertTime`

```php
protected function convertTime(float $time): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$time` | `float` | - |  |

**返回**: `int`

