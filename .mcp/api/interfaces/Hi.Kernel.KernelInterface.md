---
fqcn: Hi\Kernel\KernelInterface
type: interface
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/KernelInterface.php
line: 7
---
# KernelInterface

**命名空间**: `Hi\Kernel`

**类型**: Interface

**文件**: `src/Kernel/KernelInterface.php:7`

## 方法

### Public 方法

#### `load`

```php
public function load(?callable $booting = 'null'): self
```

Load application boot dependencies.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$booting` | `?callable` | 'null' |  |

**返回**: `self`

#### `bootstrap`

```php
public function bootstrap(array $argv = []): int
```

Bootstrap application.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$argv` | `array` | [] |  |

**返回**: `int` - Application exit code

