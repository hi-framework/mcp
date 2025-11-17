---
fqcn: Hi\Kernel\Console\InputInterface
type: interface
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/InputInterface.php
line: 7
---
# InputInterface

**命名空间**: `Hi\Kernel\Console`

**类型**: Interface

**文件**: `src/Kernel/Console/InputInterface.php:7`

## 方法

### Public 方法

#### `getCommand`

```php
public function getCommand(string $default = 'help'): string
```

Return command name
If command is not found - return 'help'.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$default` | `string` | 'help' |  |

**返回**: `string`

#### `getAction`

```php
public function getAction(): string
```

Return action name.

**返回**: `string`

#### `getOption`

```php
public function getOption(string $key): mixed
```

Get value from parsed parameter by option name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `mixed`

#### `getOptionByShortcut`

```php
public function getOptionByShortcut(string $shortcut): mixed
```

Get value from parsed parameter by option shortcut (single character).

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$shortcut` | `string` | - |  |

**返回**: `mixed`

#### `read`

```php
public function read(string $prompt = ''): string
```

Read a line from command line input.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$prompt` | `string` | '' |  |

**返回**: `string`

