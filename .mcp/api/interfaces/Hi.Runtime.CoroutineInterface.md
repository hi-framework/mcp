---
fqcn: Hi\Runtime\CoroutineInterface
type: interface
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/CoroutineInterface.php
line: 7
---
# CoroutineInterface

**命名空间**: `Hi\Runtime`

**类型**: Interface

**文件**: `src/Runtime/CoroutineInterface.php:7`

## 方法

### Public 方法

#### `space`

```php
public function space(callable $callback, mixed ...$arguments): void
```

Create a new coroutine and run it

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - | the arguments to pass to the callback |

**返回**: `void`

#### `create`

```php
public function create(callable $callback, mixed ...$arguments): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - | the arguments to pass to the callback |

**返回**: `int`

#### `sleep`

```php
public function sleep(float $time): void
```

Sleep for $time seconds

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$time` | `float` | - |  |

**返回**: `void`

#### `defer`

```php
public function defer(callable $callback): void
```

Defer a callback to run at the end of the current coroutine

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |

**返回**: `void`

#### `context`

```php
public function context(): Hi\Runtime\ContextInterface
```

Get the current coroutine context

**返回**: `Hi\Runtime\ContextInterface`

#### `cleanup`

```php
public function cleanup(): void
```

Cleanup coroutine resources
This method should be called when the application is shutting down

**返回**: `void`

#### `wait`

```php
public function wait(int $timeout = 60): bool
```

Wait for all coroutines to complete

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$timeout` | `int` | 60 | Timeout in seconds |

**返回**: `bool` - True if all coroutines completed, false if timeout

