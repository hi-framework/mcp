---
fqcn: Hi\Exception\ExceptionHandler
type: class
namespace: Hi\Exception
module: Exception
file: src/Exception/ExceptionHandler.php
line: 11
---
# ExceptionHandler

**命名空间**: `Hi\Exception`

**类型**: Class

**文件**: `src/Exception/ExceptionHandler.php:11`

## 继承关系

**实现**: `Hi\Exception\ExceptionHandlerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$reporters` | `array` | protected | [] |  |
| `$nonReportableExceptions` | `array` | protected | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct()
```

**返回**: `void`

#### `register`

```php
public function register(): void
```

**返回**: `void`

#### `handleGlobalException`

```php
public function handleGlobalException(Hi\Exception\Throwable $th): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Exception\Throwable` | - |  |

**返回**: `void`

#### `handle`

```php
public function handle(Hi\Exception\Throwable $th, mixed $context = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Exception\Throwable` | - |  |
| `$context` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `dontReport`

```php
public function dontReport(string $exception): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$exception` | `string` | - |  |

**返回**: `void`

#### `addReporter`

```php
public function addReporter(Hi\Exception\ExceptionReporterInterface|Hi\Exception\Closure $reporter): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$reporter` | `Hi\Exception\ExceptionReporterInterface\|Hi\Exception\Closure` | - |  |

**返回**: `void`

#### `resetReporters`

```php
public function resetReporters(): void
```

**返回**: `void`

#### `report`

```php
public function report(Hi\Exception\Throwable $th, mixed $context = 'null'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Exception\Throwable` | - |  |
| `$context` | `mixed` | 'null' |  |

**返回**: `void`

### Protected 方法

#### `handleError`

```php
protected function handleError(int $errno, string $errstr, string $errfile = '', int $errline = 0): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$errno` | `int` | - |  |
| `$errstr` | `string` | - |  |
| `$errfile` | `string` | '' |  |
| `$errline` | `int` | 0 |  |

**返回**: `bool`

#### `handleShutdown`

```php
protected function handleShutdown(): void
```

Handle php shutdown and search for fatal errors.

**返回**: `void`

#### `shouldNotReport`

```php
protected function shouldNotReport(Hi\Exception\Throwable $exception): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$exception` | `Hi\Exception\Throwable` | - |  |

**返回**: `bool`

#### `bootBasicReporters`

```php
protected function bootBasicReporters(): void
```

**返回**: `void`

