---
fqcn: Hi\Runtime\Retry
type: class
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/Retry.php
line: 9
---
# Retry

**命名空间**: `Hi\Runtime`

**类型**: Class

**文件**: `src/Runtime/Retry.php:9`

## 继承关系

**实现**: `Hi\Runtime\RetryInterface`

## 方法

### Public 方法

#### `do`

```php
public function do(int $times, float $timeout, callable $callback): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$times` | `int` | - |  |
| `$timeout` | `float` | - |  |
| `$callback` | `callable` | - |  |

**返回**: `mixed`

#### `tryDo`

```php
public function tryDo(int $times, float $timeout, callable $callback): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$times` | `int` | - |  |
| `$timeout` | `float` | - |  |
| `$callback` | `callable` | - |  |

**返回**: `mixed`

