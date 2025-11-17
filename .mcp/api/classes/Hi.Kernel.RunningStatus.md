---
fqcn: Hi\Kernel\RunningStatus
type: class
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/RunningStatus.php
line: 7
---
# RunningStatus

**命名空间**: `Hi\Kernel`

**类型**: Class

**文件**: `src/Kernel/RunningStatus.php:7`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$running` | `bool` | protected static | 'false' |  |

## 方法

### Public 方法

#### `setShuttingDown`

**标记**: static

```php
public static function setShuttingDown(): void
```

Set application is shutting down

**返回**: `void`

#### `isShuttingDown`

**标记**: static

```php
public static function isShuttingDown(): bool
```

Check application is shutting down

**返回**: `bool`

