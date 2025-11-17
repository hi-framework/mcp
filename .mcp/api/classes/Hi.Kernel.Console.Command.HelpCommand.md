---
fqcn: Hi\Kernel\Console\Command\HelpCommand
type: class
namespace: Hi\Kernel\Console\Command
module: Kernel
file: src/Kernel/Console/Command/HelpCommand.php
line: 14
---
# HelpCommand

**命名空间**: `Hi\Kernel\Console\Command`

**类型**: Class

**文件**: `src/Kernel/Console/Command/HelpCommand.php:14`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$description` | `string` | public readonly | '> Hi + Keep simple, keep reliable.' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $description = '> Hi
+ Keep simple, keep reliable.')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$description` | `string` | '> Hi + Keep simple, keep reliable.' |  |

**返回**: `void`

#### `command`

```php
public function command(Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output, Hi\Kernel\Console\CommandMetadataManagerInterface $metadataManager): int
```

Display help for command

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |
| `$metadataManager` | `Hi\Kernel\Console\CommandMetadataManagerInterface` | - |  |

**返回**: `int`

#### `action`

```php
public function action(Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output, Hi\Kernel\Console\Metadata\CommandMetadata $command): int
```

Display help for command action

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |
| `$command` | `Hi\Kernel\Console\Metadata\CommandMetadata` | - |  |

**返回**: `int`

#### `actionDetail`

```php
public function actionDetail(Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output, Hi\Kernel\Console\Metadata\CommandMetadata $command, Hi\Kernel\Console\Metadata\ActionMetadata $action): int
```

Display help for a specific action with its options

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |
| `$command` | `Hi\Kernel\Console\Metadata\CommandMetadata` | - |  |
| `$action` | `Hi\Kernel\Console\Metadata\ActionMetadata` | - |  |

**返回**: `int`

#### `notFound`

```php
public function notFound(Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output): int
```

Display not found help if command not found

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |

**返回**: `int`

