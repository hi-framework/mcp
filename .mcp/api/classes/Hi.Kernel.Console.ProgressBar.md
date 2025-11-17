---
fqcn: Hi\Kernel\Console\ProgressBar
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/ProgressBar.php
line: 10
---
# ProgressBar

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/ProgressBar.php:10`

Advanced progress bar component with multiple display formats

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `FORMAT_NORMAL` | 'normal' | public |  |
| `FORMAT_MINIMAL` | 'minimal' | public |  |
| `FORMAT_VERBOSE` | 'verbose' | public |  |
| `FORMAT_DEBUG` | 'debug' | public |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$current` | `int` | private | 0 |  |
| `$startTime` | `float` | private | - |  |
| `$finishTime` | `?float` | private | 'null' |  |
| `$format` | `string` | private | 'normal' |  |
| `$barWidth` | `int` | private | 50 |  |
| `$redrawEnabled` | `bool` | private | 'true' |  |
| `$messages` | `array` | private | [] |  |
| `$formats` | `array` | private | [] | Pre-defined format templates |
| `$output` | `Hi\Kernel\Console\OutputInterface` | private readonly | - |  |
| `$total` | `int` | private readonly | 100 |  |
| `$progressChar` | `string` | private readonly | '█' |  |
| `$emptyChar` | `string` | private readonly | '░' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\Console\OutputInterface $output, int $total = 100, string $progressChar = '█', string $emptyChar = '░')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |
| `$total` | `int` | 100 |  |
| `$progressChar` | `string` | '█' |  |
| `$emptyChar` | `string` | '░' |  |

**返回**: `void`

#### `advance`

```php
public function advance(int $step = 1): self
```

Advance the progress bar by a specified number of steps

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$step` | `int` | 1 |  |

**返回**: `self`

#### `setProgress`

```php
public function setProgress(int $current): self
```

Set the current progress to a specific value

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$current` | `int` | - |  |

**返回**: `self`

#### `setPercentage`

```php
public function setPercentage(float $percentage): self
```

Set the current progress as a percentage

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$percentage` | `float` | - |  |

**返回**: `self`

#### `display`

```php
public function display(): self
```

Display the progress bar

**返回**: `self`

#### `finish`

```php
public function finish(): self
```

Finish the progress bar

**返回**: `self`

#### `clear`

```php
public function clear(): self
```

Clear the progress bar

**返回**: `self`

#### `setFormat`

```php
public function setFormat(string $format): self
```

Set the display format

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$format` | `string` | - |  |

**返回**: `self`

#### `setFormatDefinition`

```php
public function setFormatDefinition(string $name, string $format): self
```

Set a custom format template

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$format` | `string` | - |  |

**返回**: `self`

#### `setBarWidth`

```php
public function setBarWidth(int $width): self
```

Set the bar width

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$width` | `int` | - |  |

**返回**: `self`

#### `setRedrawEnabled`

```php
public function setRedrawEnabled(bool $enabled): self
```

Enable or disable redrawing

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$enabled` | `bool` | - |  |

**返回**: `self`

#### `setMessage`

```php
public function setMessage(string $message, string $name = 'message'): self
```

Set a message to display

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `string` | - |  |
| `$name` | `string` | 'message' |  |

**返回**: `self`

#### `getPercentage`

```php
public function getPercentage(): float
```

Get current percentage

**返回**: `float`

#### `isFinished`

```php
public function isFinished(): bool
```

Check if the progress bar is finished

**返回**: `bool`

#### `getElapsedTime`

```php
public function getElapsedTime(): float
```

Get elapsed time

**返回**: `float`

#### `getEstimatedTime`

```php
public function getEstimatedTime(): ?float
```

Get estimated total time

**返回**: `?float`

#### `getRemainingTime`

```php
public function getRemainingTime(): ?float
```

Get estimated remaining time

**返回**: `?float`

