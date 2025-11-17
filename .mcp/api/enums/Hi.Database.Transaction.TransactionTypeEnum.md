---
fqcn: Hi\Database\Transaction\TransactionTypeEnum
type: enum
namespace: Hi\Database\Transaction
module: Database
file: src/Database/Transaction/TransactionTypeEnum.php
line: 12
---
# TransactionTypeEnum

**命名空间**: `Hi\Database\Transaction`

**类型**: Enum

**文件**: `src/Database/Transaction/TransactionTypeEnum.php:12`

事务类型枚举

定义不同的事务管理方式，支持注解驱动、闭包和手动三种事务模式

## 方法

### Public 方法

#### `isAutoManaged`

```php
public function isAutoManaged(): bool
```

检查是否为自动管理事务

**返回**: `bool` - 是否为自动管理事务

#### `requiresExplicitCommit`

```php
public function requiresExplicitCommit(): bool
```

检查是否需要显式提交

**返回**: `bool` - 是否需要显式提交

