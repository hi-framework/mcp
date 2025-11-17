---
fqcn: Hi\Kernel\Console\Output
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/Output.php
line: 10
---
# Output

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/Output.php:10`

## 继承关系

**实现**: `Hi\Kernel\Console\OutputInterface`

**使用 Traits**: `Hi\Kernel\Console\Traits\DisplayTrait`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$progressHelper` | `?Hi\Kernel\Console\ProgressHelper` | private | 'null' |  |
| `$theme` | `AlecRabbit\ConsoleColour\Themes` | public readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(AlecRabbit\ConsoleColour\Themes $theme = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$theme` | `AlecRabbit\ConsoleColour\Themes` | '...' |  |

**返回**: `void`

#### `writeln`

```php
public function writeln(string $text = ''): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | '' |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `newLine`

```php
public function newLine(int $count = 1): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$count` | `int` | 1 |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `writeError`

```php
public function writeError(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `writeWarning`

```php
public function writeWarning(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `writeInRed`

```php
public function writeInRed(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `writeInBold`

```php
public function writeInBold(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `writeInGray`

```php
public function writeInGray(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `writeInBlue`

```php
public function writeInBlue(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `displayErrorTips`

```php
public function displayErrorTips(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `displayHead`

```php
public function displayHead(string $description): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$description` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `displayUsage`

```php
public function displayUsage(string $command, string $action = ''): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `string` | - |  |
| `$action` | `string` | '' |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `displayExample`

```php
public function displayExample(string $command): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `displayAvailable`

```php
public function displayAvailable(string $scope, array $data): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$scope` | `string` | - |  |
| `$data` | `array` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `displayTips`

```php
public function displayTips(string $text): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$text` | `string` | - |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `displayTable`

```php
public function displayTable(array $data, string $columnOneColor = 'blue', string $columnTwoColor = ''): Hi\Kernel\Console\OutputInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `array` | - |  |
| `$columnOneColor` | `string` | 'blue' |  |
| `$columnTwoColor` | `string` | '' |  |

**返回**: `Hi\Kernel\Console\OutputInterface`

#### `getTheme`

```php
public function getTheme(): AlecRabbit\ConsoleColour\Themes
```

**返回**: `AlecRabbit\ConsoleColour\Themes`

#### `createProgressBar`

```php
public function createProgressBar(int $total = 100): Hi\Kernel\Console\ProgressBar
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$total` | `int` | 100 |  |

**返回**: `Hi\Kernel\Console\ProgressBar`

#### `createStatusDisplay`

```php
public function createStatusDisplay(): Hi\Kernel\Console\StatusDisplay
```

**返回**: `Hi\Kernel\Console\StatusDisplay`

#### `getProgressHelper`

```php
public function getProgressHelper(): Hi\Kernel\Console\ProgressHelper
```

**返回**: `Hi\Kernel\Console\ProgressHelper`

#### `spinner`

```php
public function spinner(callable $task, string $message = 'Processing...'): mixed
```

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

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$items` | `iterable` | - |  |
| `$callback` | `callable` | - |  |
| `$message` | `?string` | 'null' |  |

**返回**: `array`

