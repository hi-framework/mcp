---
fqcn: Hi\Exception\ExceptionReporterInterface
type: interface
namespace: Hi\Exception
module: Exception
file: src/Exception/ExceptionReporterInterface.php
line: 7
---
# ExceptionReporterInterface

**命名空间**: `Hi\Exception`

**类型**: Interface

**文件**: `src/Exception/ExceptionReporterInterface.php:7`

## 方法

### Public 方法

#### `report`

```php
public function report(Hi\Exception\Throwable $th, mixed $context = 'null'): void
```

Report an exception.
Must not throw exception

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Exception\Throwable` | - |  |
| `$context` | `mixed` | 'null' |  |

**返回**: `void`

