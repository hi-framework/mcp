---
fqcn: Hi\Runtime\Swoole\Coroutine
type: class
namespace: Hi\Runtime\Swoole
module: Runtime
file: src/Runtime/Swoole/Coroutine.php
line: 11
---
# Coroutine

**命名空间**: `Hi\Runtime\Swoole`

**类型**: Class

**文件**: `src/Runtime/Swoole/Coroutine.php:11`

## 继承关系

**实现**: `Hi\Runtime\CoroutineInterface`

**使用 Traits**: `Hi\Runtime\Swoole\ExtensionCheckTrait`

## 方法

### Public 方法

#### `__construct`

```php
public function __construct()
```

**返回**: `void`

#### `space`

```php
public function space(callable $callback, mixed ...$arguments): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - |  |

**返回**: `void`

#### `create`

```php
public function create(callable $callback, mixed ...$arguments): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |
| `...$arguments` | `mixed` | - |  |

**返回**: `int`

#### `sleep`

```php
public function sleep(float $time): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$time` | `float` | - |  |

**返回**: `void`

#### `defer`

```php
public function defer(callable $callback): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$callback` | `callable` | - |  |

**返回**: `void`

#### `context`

```php
public function context(): Hi\Runtime\ContextInterface
```

**返回**: `Hi\Runtime\ContextInterface`

#### `cleanup`

```php
public function cleanup(): void
```

**返回**: `void`

#### `wait`

```php
public function wait(int $timeout = 60): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$timeout` | `int` | 60 |  |

**返回**: `bool`

