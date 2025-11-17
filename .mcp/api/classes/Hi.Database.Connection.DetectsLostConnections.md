---
fqcn: Hi\Database\Connection\DetectsLostConnections
type: class
namespace: Hi\Database\Connection
module: Database
file: src/Database/Connection/DetectsLostConnections.php
line: 12
---
# DetectsLostConnections

**命名空间**: `Hi\Database\Connection`

**类型**: Class

**文件**: `src/Database/Connection/DetectsLostConnections.php:12`

Copy from https://github.com/swoole/library/blob/master/src/core/Database/DetectsLostConnections.php

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `ERROR_MESSAGES` | [] | private |  |

## 方法

### Public 方法

#### `causedByLostConnection`

**标记**: static

```php
public static function causedByLostConnection(Hi\Database\Connection\Throwable $e): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$e` | `Hi\Database\Connection\Throwable` | - |  |

**返回**: `bool`

