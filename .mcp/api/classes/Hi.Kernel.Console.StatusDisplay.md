---
fqcn: Hi\Kernel\Console\StatusDisplay
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/StatusDisplay.php
line: 10
---
# StatusDisplay

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/StatusDisplay.php:10`

Status display component for showing real-time status information

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$sections` | `array` | private | [] |  |
| `$isActive` | `bool` | private | 'false' |  |
| `$refreshInterval` | `int` | private | 1 |  |
| `$maxWidth` | `?int` | private | 'null' |  |
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

#### `start`

```php
public function start(): self
```

Start the status display

**返回**: `self`

#### `stop`

```php
public function stop(): self
```

Stop the status display

**返回**: `self`

#### `setSection`

```php
public function setSection(string $name, array $data): self
```

Add or update a status section

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$data` | `array` | - |  |

**返回**: `self`

#### `removeSection`

```php
public function removeSection(string $name): self
```

Remove a status section

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `self`

#### `setRefreshInterval`

```php
public function setRefreshInterval(int $seconds): self
```

Set refresh interval in seconds

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$seconds` | `int` | - |  |

**返回**: `self`

#### `setMaxWidth`

```php
public function setMaxWidth(int $width): self
```

Set maximum display width

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$width` | `int` | - |  |

**返回**: `self`

#### `refresh`

```php
public function refresh(): self
```

Refresh the display

**返回**: `self`

#### `addStatus`

```php
public function addStatus(string $label, string $value, string $section = 'General'): self
```

Add a simple status line

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$label` | `string` | - |  |
| `$value` | `string` | - |  |
| `$section` | `string` | 'General' |  |

**返回**: `self`

#### `addStatuses`

```php
public function addStatuses(array $statuses, string $section = 'General'): self
```

Add multiple status items at once

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$statuses` | `array` | - |  |
| `$section` | `string` | 'General' |  |

**返回**: `self`

#### `monitor`

```php
public function monitor(callable $dataProvider, ?callable $shouldStop = 'null'): self
```

Create a real-time monitoring display

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$dataProvider` | `callable` | - |  |
| `$shouldStop` | `?callable` | 'null' |  |

**返回**: `self`

