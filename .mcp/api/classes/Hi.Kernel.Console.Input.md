---
fqcn: Hi\Kernel\Console\Input
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/Input.php
line: 7
---
# Input

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/Input.php:7`

## 继承关系

**实现**: `Hi\Kernel\Console\InputInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$parser` | `Hi\Kernel\Console\ArgumentsParser` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $argv)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$argv` | `array` | - |  |

**返回**: `void`

#### `getCommand`

```php
public function getCommand(string $default = 'help'): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$default` | `string` | 'help' |  |

**返回**: `string`

#### `getAction`

```php
public function getAction(): string
```

**返回**: `string`

#### `getOption`

```php
public function getOption(string $key): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `mixed`

#### `read`

```php
public function read(string $prompt = ''): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$prompt` | `string` | '' |  |

**返回**: `string`

#### `getOptionByShortcut`

```php
public function getOptionByShortcut(string $shortcut): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$shortcut` | `string` | - |  |

**返回**: `mixed`

