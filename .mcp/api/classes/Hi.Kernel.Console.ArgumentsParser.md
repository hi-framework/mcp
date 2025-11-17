---
fqcn: Hi\Kernel\Console\ArgumentsParser
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/ArgumentsParser.php
line: 11
---
# ArgumentsParser

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/ArgumentsParser.php:11`

Console input arguments parser.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$boolParamSet` | `array` | private | [] |  |
| `$parsedCommands` | `array` | private | [] |  |

## 方法

### Public 方法

#### `has`

```php
public function has(int|string $key): bool
```

Check if parsed parameters has param.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `int\|string` | - | The parameter's "key" |

**返回**: `bool`

#### `get`

```php
public function get(int|string $key, mixed $default = 'null'): mixed
```

Get value from parsed parameters.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `int\|string` | - | The parameter's "key" |
| `$default` | `mixed` | 'null' | A default value in case the key is not set |

**返回**: `mixed`

#### `getBoolean`

```php
public function getBoolean(string $key, bool $default = 'false'): bool
```

Get boolean from parsed parameters.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - | The parameter's "key" |
| `$default` | `bool` | 'false' | A default value in case the key is not set |

**返回**: `bool`

#### `parse`

```php
public function parse(array $argv = []): array
```

Parse console input.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$argv` | `array` | [] | Arguments to parse. Defaults to empty array |

**返回**: `array`

#### `getParsedCommands`

```php
public function getParsedCommands(): array
```

**返回**: `array`

### Protected 方法

#### `getCoalescingDefault`

```php
protected function getCoalescingDefault(string $value, bool $default): bool
```

Return either received parameter or default.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$value` | `string` | - | The parameter passed |
| `$default` | `bool` | - | A default value if the parameter is not set |

**返回**: `bool`

#### `getParamWithEqual`

```php
protected function getParamWithEqual(string $arg, int $eqPos): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$arg` | `string` | - | The argument passed |
| `$eqPos` | `int` | - | The position of where the equals sign is located |

**返回**: `array`

#### `handleArguments`

```php
protected function handleArguments(array $argv): array
```

Handle received parameters.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$argv` | `array` | - | The array with the arguments passed in the CLI |

**返回**: `array`

#### `parseAndMergeCommandWithEqualSign`

```php
protected function parseAndMergeCommandWithEqualSign(string $command): bool
```

Parse command `foo=bar`.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `string` | - |  |

**返回**: `bool`

#### `stripSlashes`

```php
protected function stripSlashes(string $argument): string
```

Delete dashes from param.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$argument` | `string` | - |  |

**返回**: `string`

