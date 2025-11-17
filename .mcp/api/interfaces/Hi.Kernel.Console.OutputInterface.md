---
fqcn: Hi\Kernel\Console\OutputInterface
type: interface
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/OutputInterface.php
line: 9
---
# OutputInterface

**命名空间**: `Hi\Kernel\Console`

**类型**: Interface

**文件**: `src/Kernel/Console/OutputInterface.php:9`

## 方法

### Public 方法

#### `writeln`

```php
public function writeln(string $text): self
```

Display text.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `newLine`

```php
public function newLine(int $count = 1): self
```

Add new line.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$count` | `int` | 1 |  |

**返回**: `self`

#### `writeError`

```php
public function writeError(string $text): self
```

Display error.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `writeWarning`

```php
public function writeWarning(string $text): self
```

Display warning.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `writeInRed`

```php
public function writeInRed(string $text): self
```

Display text in red.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `writeInGray`

```php
public function writeInGray(string $text): self
```

Display text in gray.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `writeInBlue`

```php
public function writeInBlue(string $text): self
```

Display text in blue.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `writeInBold`

```php
public function writeInBold(string $text): self
```

Display text in bold.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `displayErrorTips`

```php
public function displayErrorTips(string $text): self
```

Display error tips.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `displayHead`

```php
public function displayHead(string $description): self
```

Display command header.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$description` | `string` | - |  |

**返回**: `self`

#### `displayUsage`

```php
public function displayUsage(string $command, string $action = ''): self
```

Display command usage.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `string` | - |  |
| `$action` | `string` | '' |  |

**返回**: `self`

#### `displayExample`

```php
public function displayExample(string $command): self
```

Display command example.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `string` | - |  |

**返回**: `self`

#### `displayAvailable`

```php
public function displayAvailable(string $scope, array $data): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$scope` | `string` | - |  |
| `$data` | `array` | - |  |

**返回**: `self`

#### `displayTips`

```php
public function displayTips(string $text): self
```

Display tips.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `self`

#### `displayTable`

```php
public function displayTable(array $data, string $columnOneColor = 'blue', string $columnTwoColor = ''): self
```

Display table(multi column).

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |
| `$columnOneColor` | `string` | 'blue' |  |
| `$columnTwoColor` | `string` | '' |  |

**返回**: `self`

#### `getTheme`

```php
public function getTheme(): AlecRabbit\ConsoleColour\Themes
```

Get theme.

**返回**: `AlecRabbit\ConsoleColour\Themes`

#### `createProgressBar`

```php
public function createProgressBar(int $total = 100): Hi\Kernel\Console\ProgressBar
```

Create a progress bar.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$total` | `int` | 100 |  |

**返回**: `Hi\Kernel\Console\ProgressBar`

#### `createStatusDisplay`

```php
public function createStatusDisplay(): Hi\Kernel\Console\StatusDisplay
```

Create a status display.

**返回**: `Hi\Kernel\Console\StatusDisplay`

#### `getProgressHelper`

```php
public function getProgressHelper(): Hi\Kernel\Console\ProgressHelper
```

Get progress helper.

**返回**: `Hi\Kernel\Console\ProgressHelper`

#### `spinner`

```php
public function spinner(callable $task, string $message = 'Processing...'): mixed
```

Display a spinner with message.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$task` | `callable` | - |  |
| `$message` | `string` | 'Processing...' |  |

**返回**: `mixed`

#### `withProgressBar`

```php
public function withProgressBar(iterable $items, callable $callback, ?string $message = 'null'): array
```

Execute task with progress bar.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$items` | `iterable` | - |  |
| `$callback` | `callable` | - |  |
| `$message` | `?string` | 'null' |  |

**返回**: `array`

