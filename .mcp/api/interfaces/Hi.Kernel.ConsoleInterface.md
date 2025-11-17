---
fqcn: Hi\Kernel\ConsoleInterface
type: interface
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/ConsoleInterface.php
line: 11
---
# ConsoleInterface

**命名空间**: `Hi\Kernel`

**类型**: Interface

**文件**: `src/Kernel/ConsoleInterface.php:11`

## 方法

### Public 方法

#### `run`

```php
public function run(Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output): int
```

Run console command.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |

**返回**: `int`

#### `getCommandMetadataManager`

```php
public function getCommandMetadataManager(): Hi\Kernel\Console\CommandMetadataManagerInterface
```

Get the command metadata manager.

**返回**: `Hi\Kernel\Console\CommandMetadataManagerInterface`

