---
fqcn: Hi\Exception\Reporter\ConsoleReporter
type: class
namespace: Hi\Exception\Reporter
module: Exception
file: src/Exception/Reporter/ConsoleReporter.php
line: 11
---
# ConsoleReporter

**命名空间**: `Hi\Exception\Reporter`

**类型**: Class

**文件**: `src/Exception/Reporter/ConsoleReporter.php:11`

## 继承关系

**实现**: `Hi\Exception\ExceptionReporterInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$output` | `Hi\Kernel\Console\OutputInterface` | protected | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\Console\OutputInterface $output = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$output` | `Hi\Kernel\Console\OutputInterface` | '...' |  |

**返回**: `void`

#### `report`

```php
public function report(Hi\Exception\Reporter\Throwable $th, mixed $context = 'null'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Exception\Reporter\Throwable` | - |  |
| `$context` | `mixed` | 'null' |  |

**返回**: `void`

