---
fqcn: Hi\Database\Transaction\Microtimer
type: class
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/Microtimer.php
line: 12
---
# Microtimer

**命名空间**: `Hi\Database\Transaction`

**类型**: Class

**文件**: `src/Database/Transaction/Microtimer.php:12`

微秒计时器实现类

提供高精度时间戳获取功能，用于事务时间测量和性能监控

## 继承关系

**实现**: `Hi\Database\Transaction\MicrotimerInterface`

## 方法

### Public 方法

#### `now`

```php
public function now(): float
```

获取当前微秒时间戳

**返回**: `float` - 当前微秒时间戳（浮点数，秒为单位，包含微秒精度）

