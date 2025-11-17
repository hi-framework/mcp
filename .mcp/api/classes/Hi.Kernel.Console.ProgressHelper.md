---
fqcn: Hi\Kernel\Console\ProgressHelper
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/ProgressHelper.php
line: 10
---
# ProgressHelper

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/ProgressHelper.php:10`

Helper class for creating and managing progress bars and status displays

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$output` | `Hi\Kernel\Console\OutputInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\Console\OutputInterface $output)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |

**返回**: `void`

#### `createProgressBar`

```php
public function createProgressBar(int $total = 100): Hi\Kernel\Console\ProgressBar
```

Create a simple progress bar

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$total` | `int` | 100 |  |

**返回**: `Hi\Kernel\Console\ProgressBar`

#### `createMinimalProgressBar`

```php
public function createMinimalProgressBar(int $total = 100): Hi\Kernel\Console\ProgressBar
```

Create a minimal progress bar

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$total` | `int` | 100 |  |

**返回**: `Hi\Kernel\Console\ProgressBar`

#### `createVerboseProgressBar`

```php
public function createVerboseProgressBar(int $total = 100): Hi\Kernel\Console\ProgressBar
```

Create a verbose progress bar

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$total` | `int` | 100 |  |

**返回**: `Hi\Kernel\Console\ProgressBar`

#### `createStatusDisplay`

```php
public function createStatusDisplay(): Hi\Kernel\Console\StatusDisplay
```

Create a status display

**返回**: `Hi\Kernel\Console\StatusDisplay`

#### `withProgressBar`

```php
public function withProgressBar(iterable $items, callable $callback, ?string $message = 'null'): array
```

Execute a task with a progress bar

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$items` | `iterable` | - |  |
| `$callback` | `callable` | - |  |
| `$message` | `?string` | 'null' |  |

**返回**: `array`

#### `withStatusMonitoring`

```php
public function withStatusMonitoring(callable $task, callable $statusProvider, int $refreshInterval = 1): mixed
```

Execute a task with status monitoring

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$task` | `callable` | - |  |
| `$statusProvider` | `callable` | - |  |
| `$refreshInterval` | `int` | 1 |  |

**返回**: `mixed`

#### `spinner`

```php
public function spinner(callable $task, string $message = 'Processing...'): mixed
```

Show a spinner for indeterminate tasks

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$task` | `callable` | - |  |
| `$message` | `string` | 'Processing...' |  |

**返回**: `mixed`

#### `createMultiStepProgress`

```php
public function createMultiStepProgress(array $steps): Hi\Kernel\Console\MultiStepProgress
```

Create a multi-step progress display

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$steps` | `array` | - |  |

**返回**: `Hi\Kernel\Console\MultiStepProgress`

#### `displayProgressTable`

```php
public function displayProgressTable(array $data, array $headers = []): void
```

Display a table with progress information

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |
| `$headers` | `array` | [] |  |

**返回**: `void`

