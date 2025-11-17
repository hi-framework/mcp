---
fqcn: Hi\Runtime\RetryInterface
type: interface
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/RetryInterface.php
line: 7
---
# RetryInterface

**命名空间**: `Hi\Runtime`

**类型**: Interface

**文件**: `src/Runtime/RetryInterface.php:7`

## 方法

### Public 方法

#### `do`

```php
public function do(int $times, float $timeout, callable $callback): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$times` | `int` | - | number of times to retry |
| `$timeout` | `float` | - | timeout in seconds |
| `$callback` | `callable` | - |  |

**返回**: `mixed`

#### `tryDo`

```php
public function tryDo(int $times, float $timeout, callable $callback): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$times` | `int` | - | number of times to retry |
| `$timeout` | `float` | - | timeout in seconds |
| `$callback` | `callable` | - |  |

**返回**: `mixed`

