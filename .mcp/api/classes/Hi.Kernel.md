---
fqcn: Hi\Kernel
type: class
namespace: Hi
module: Hi
file: src/Kernel.php
line: 41
---
# Kernel

**命名空间**: `Hi`

**类型**: Class

**文件**: `src/Kernel.php:41`

Kernel class

The main kernel class that handles application initialization, service container management,
console environment setup, and application bootstrapping. It serves as the central entry point
for the framework and manages core services like exception handling, logging, and configuration.

## 继承关系

**实现**: `Hi\Kernel\KernelInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | protected | - |  |
| `$rootDirectory` | `string` | protected | - |  |
| `$container` | `Spiral\Core\Container` | protected | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $rootDirectory, Hi\Exception\ExceptionHandlerInterface $exceptionHandler = '...', bool $handleErrors = 'true', Spiral\Core\Container $container = '...', Hi\Kernel\Logger\LoggerFactoryInterface $loggerFactory = '...')
```

Kernel constructor

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$rootDirectory` | `string` | - | Root directory path for the application |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | '...' | Exception handler instance |
| `$handleErrors` | `bool` | 'true' | Whether to handle errors automatically |
| `$container` | `Spiral\Core\Container` | '...' | Dependency injection container |
| `$loggerFactory` | `Hi\Kernel\Logger\LoggerFactoryInterface` | '...' | Logger factory instance |

**返回**: `void`

#### `load`

```php
public function load(?callable $booting = 'null'): self
```

Load application

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$booting` | `?callable` | 'null' | Booting callback function to execute during loading |

**返回**: `self` - Returns current instance for method chaining

**抛出异常**:

- `\Throwable` - Thrown when booting callback execution fails

#### `bootstrap`

```php
public function bootstrap(array $argv = []): int
```

Bootstrap application

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$argv` | `array` | [] | Command line arguments array, defaults to empty array |

**返回**: `int` - Returns exit code

### Protected 方法

#### `prepareExceptionHandler`

```php
protected function prepareExceptionHandler(bool $handleErrors, Hi\Exception\ExceptionHandlerInterface $exceptionHandler): void
```

Prepare exception handler

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handleErrors` | `bool` | - | Whether to handle errors, registers handler when true |
| `$exceptionHandler` | `Hi\Exception\ExceptionHandlerInterface` | - | Exception handler instance |

**返回**: `void`

#### `initializeCoreServices`

```php
protected function initializeCoreServices(string $rootDirectory, Hi\Kernel\Logger\LoggerFactoryInterface $loggerFactory): void
```

Initialize core services

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$rootDirectory` | `string` | - | Root directory path |
| `$loggerFactory` | `Hi\Kernel\Logger\LoggerFactoryInterface` | - | Logger factory instance |

**返回**: `void`

#### `setupConsoleEnvironment`

```php
protected function setupConsoleEnvironment(array $argv): array
```

Setup console environment

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$argv` | `array` | - | Command line arguments array |

**返回**: `array` - Returns array containing input and output objects [InputInterface, OutputInterface]

#### `setupRuntimeBinding`

```php
protected function setupRuntimeBinding(): void
```

Setup runtime binding

**返回**: `void`

#### `generateLoggerScopeName`

```php
protected function generateLoggerScopeName(Hi\Kernel\Console\InputInterface $input): string
```

Generate logger scope name

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$input` | `Hi\Kernel\Console\InputInterface` | - | Input interface instance |

**返回**: `string` - Scope name in format 'command:command/action'

