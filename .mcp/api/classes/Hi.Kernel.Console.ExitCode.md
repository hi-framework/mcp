---
fqcn: Hi\Kernel\Console\ExitCode
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/ExitCode.php
line: 7
---
# ExitCode

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/ExitCode.php:7`

**修饰符**: final

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `OK` | 0 | public | Pre-defined controller error codes. https://tldp.org/LDP/abs/html/exitcodes.html |
| `BAD_ACTION` | 1 | public |  |
| `BAD_ARGUMENT` | 2 | public |  |
| `FORBIDDEN` | 3 | public |  |
| `ERROR` | 4 | public |  |
| `UNAUTHORIZED` | 8 | public |  |
| `GENERAL_ERROR` | 1 | public |  |
| `MISUSE_OF_BUILTINS` | 2 | public |  |
| `CANNOT_EXECUTE` | 126 | public |  |
| `NOT_FOUND` | 127 | public |  |
| `INVALID_EXIT_ARGUMENT` | 128 | public |  |
| `TERMINATED_BY_CTRL_C` | 130 | public |  |
| `EXIT_OUT_OF_RANGE` | 255 | public |  |
| `USAGE` | 64 | public |  |
| `DATAERR` | 65 | public |  |
| `NOINPUT` | 66 | public |  |
| `NOUSER` | 67 | public |  |
| `NOHOST` | 68 | public |  |
| `UNAVAILABLE` | 69 | public |  |
| `SOFTWARE` | 70 | public |  |
| `OSERR` | 71 | public |  |
| `OSFILE` | 72 | public |  |
| `CANTCREAT` | 73 | public |  |
| `IOERR` | 74 | public |  |
| `TEMPFAIL` | 75 | public |  |
| `PROTOCOL` | 76 | public |  |
| `NOPERM` | 77 | public |  |
| `CONFIG` | 78 | public |  |

## 方法

### Public 方法

#### `isOk`

**标记**: static

```php
public static function isOk(int $code): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$code` | `int` | - |  |

**返回**: `bool`

#### `normalize`

**标记**: static

```php
public static function normalize(int $code): int
```

Normalize any integer to a valid 0-255 process exit code.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$code` | `int` | - |  |

**返回**: `int`

