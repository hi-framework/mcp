---
fqcn: Hi\Kernel\Console
type: class
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/Console.php
line: 40
---
# Console

**命名空间**: `Hi\Kernel`

**类型**: Class

**文件**: `src/Kernel/Console.php:40`

Console Command Executor

This is the core console component of the framework, responsible for parsing and executing command-line instructions.
Supports command execution in coroutine environments with complete lifecycle management and error handling.

Key Features:
- Command parsing and routing: Parse commands and actions based on input parameters
- Help system: Automatically generate command help information
- Coroutine support: Safely execute commands in coroutine environments
- Lifecycle management: Provide boot and shutdown callbacks
- Exception handling: Unified exception capture and reporting
- Performance monitoring: Optional metrics collection
- Resource cleanup: Automatically clean up coroutine, event, and timer resources

## 继承关系

**实现**: `Hi\Kernel\ConsoleInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$exitCode` | `int` | private | 0 |  |
| `$running` | `bool` | private static | 'true' |  |
| `$container` | `Spiral\Core\Container` | private readonly | - |  |
| `$metadataManager` | `Hi\Kernel\Console\CommandMetadataManagerInterface` | private readonly | - |  |
| `$coroutine` | `Hi\Runtime\CoroutineInterface` | private readonly | - |  |
| `$event` | `Hi\Runtime\EventInterface` | private readonly | - |  |
| `$timer` | `Hi\Runtime\TimerInterface` | private readonly | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | - |  |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | private readonly | - |  |
| `$collector` | `?Hi\Kernel\MetricCollectorInterface` | private readonly | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Spiral\Core\Container $container, Hi\Kernel\Console\CommandMetadataManagerInterface $metadataManager, Hi\Runtime\CoroutineInterface $coroutine, Hi\Runtime\EventInterface $event, Hi\Runtime\TimerInterface $timer, Psr\Log\LoggerInterface $logger, Hi\Exception\ExceptionHandlerInterface $exceptionHandler, ?Hi\Kernel\MetricCollectorInterface $collector = 'null')
```

Console Command Executor Constructor

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Spiral\Core\Container` | - | Dependency injection container for resolving command handlers |
| `$metadataManager` | `Hi\Kernel\Console\CommandMetadataManagerInterface` | - | Command metadata manager responsible for command registration and lookup |
| `$coroutine` | `Hi\Runtime\CoroutineInterface` | - | Coroutine manager providing coroutine execution environment |
| `$event` | `Hi\Runtime\EventInterface` | - | Event manager for handling asynchronous events |
| `$timer` | `Hi\Runtime\TimerInterface` | - | Timer manager for handling scheduled tasks |
| `$logger` | `Psr\Log\LoggerInterface` | - | Logger for recording execution logs |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | - | Exception handler for unified exception processing |
| `$collector` | `?Hi\Kernel\MetricCollectorInterface` | 'null' | Optional metrics collector for performance monitoring |

**返回**: `void`

#### `resolveCommandAndAction`

```php
public function resolveCommandAndAction(Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output): ?array
```

Resolve command and action

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - | Input interface containing command parameters |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - | Output interface for displaying information |

**返回**: `?array` - ActionMetadata}|null Returns command and action metadata, null if parsing fails

#### `run`

```php
public function run(Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output): int
```

Execute console command

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - | Input interface containing command parameters |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - | Output interface for displaying information |

**返回**: `int` - Exit code (0 for success, non-zero for error)

#### `isRunning`

**标记**: static

```php
public static function isRunning(): bool
```

Check if console is currently running

**返回**: `bool` - True if console is running, false otherwise

#### `getCommandMetadataManager`

```php
public function getCommandMetadataManager(): Hi\Kernel\Console\CommandMetadataManagerInterface
```

Get the command metadata manager

**返回**: `Hi\Kernel\Console\CommandMetadataManagerInterface` - The command metadata manager instance

### Protected 方法

#### `dispatch`

```php
protected function dispatch(Hi\Kernel\Console\DispatcherInterface $dispatcher, Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output): void
```

Dispatch command execution

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$dispatcher` | `Hi\Kernel\Console\DispatcherInterface` | - | Command dispatcher |
| `$input` | `Hi\Kernel\Console\InputInterface` | - | Input interface |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - | Output interface |

**返回**: `void`

#### `createHelpCommand`

```php
protected function createHelpCommand(): Hi\Kernel\Console\Command\HelpCommand
```

Create help command instance

**返回**: `Hi\Kernel\Console\Command\HelpCommand` - New help command instance

#### `createDispatcher`

```php
protected function createDispatcher($command, $action): Hi\Kernel\Console\Dispatcher
```

Create command dispatcher

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `mixed` | - | Command metadata |
| `$action` | `mixed` | - | Action metadata |

**返回**: `Hi\Kernel\Console\Dispatcher` - New dispatcher instance

