---
fqcn: Hi\Database\Transaction\MicrotimerInterface
type: interface
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/MicrotimerInterface.php
line: 12
---
# MicrotimerInterface

**命名空间**: `Hi\Database\Transaction`

**类型**: Interface

**文件**: `src/Database/Transaction/MicrotimerInterface.php:12`

微秒计时器接口

定义时间测量功能的契约，用于获取高精度时间戳

## 方法

### Public 方法

#### `now`

```php
public function now(): float
```

获取当前微秒时间戳

**返回**: `float` - 当前微秒时间戳（浮点数，秒为单位，包含微秒精度）

