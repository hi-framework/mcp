---
fqcn: Hi\Kernel\Logger\Formatter\ConsoleFormatter
type: class
namespace: Hi\Kernel\Logger\Formatter
module: Kernel
file: src/Kernel/Logger/Formatter/ConsoleFormatter.php
line: 12
---
# ConsoleFormatter

**命名空间**: `Hi\Kernel\Logger\Formatter`

**类型**: Class

**文件**: `src/Kernel/Logger/Formatter/ConsoleFormatter.php:12`

## 继承关系

**继承**: `Monolog\Formatter\NormalizerFormatter`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$themes` | `AlecRabbit\ConsoleColour\Themes` | protected | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(AlecRabbit\ConsoleColour\Themes $themes = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$themes` | `AlecRabbit\ConsoleColour\Themes` | '...' |  |

**返回**: `void`

#### `format`

```php
public function format(Monolog\LogRecord $record): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$record` | `Monolog\LogRecord` | - |  |

**返回**: `string`

