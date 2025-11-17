---
fqcn: Hi\Kernel\Console\MultiStepProgress
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/ProgressHelper.php
line: 208
---
# MultiStepProgress

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/ProgressHelper.php:208`

Multi-step progress display

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$currentStep` | `int` | private | 0 |  |
| `$stepStatus` | `array` | private | [] |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | private readonly | - |  |
| `$steps` | `array` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\Console\OutputInterface $output, array $steps)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |
| `$steps` | `array` | - |  |

**返回**: `void`

#### `nextStep`

```php
public function nextStep(): self
```

Start the next step

**返回**: `self`

#### `completeStep`

```php
public function completeStep(): self
```

Complete the current step

**返回**: `self`

#### `failStep`

```php
public function failStep(string $error = ''): self
```

Mark current step as failed

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$error` | `string` | '' |  |

**返回**: `self`

#### `display`

```php
public function display(): self
```

Display the multi-step progress

**返回**: `self`

#### `getCompletionPercentage`

```php
public function getCompletionPercentage(): float
```

Get completion percentage

**返回**: `float`

#### `isCompleted`

```php
public function isCompleted(): bool
```

Check if all steps are completed

**返回**: `bool`

