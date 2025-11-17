---
fqcn: Hi\Server\Config
type: class
namespace: Hi\Server
module: Server
file: src/Server/Config.php
line: 12
---
# Config

**命名空间**: `Hi\Server`

**类型**: Class

**文件**: `src/Server/Config.php:12`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `DEFAULT_HOST` | '0.0.0.0' | public |  |
| `DEFAULT_PORT` | 9527 | public |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$name` | `string` | public readonly | - |  |
| `$host` | `string` | public | - |  |
| `$port` | `int` | public | - |  |
| `$pidFile` | `string` | public readonly | - |  |
| `$logFile` | `string` | public readonly | - |  |
| `$swow` | `array` | public readonly | - |  |
| `$workerman` | `array` | public readonly | - |  |
| `$swoole` | `array` | public readonly | - |  |
| `$react` | `array` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $config = [])
```

Construct.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | [] |  |

**返回**: `void`

#### `processPort`

```php
public function processPort(int $value): int
```

Verify the port number.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$value` | `int` | - |  |

**返回**: `int`

**抛出异常**:

- `ServerException`

#### `defaultDirectory`

```php
public function defaultDirectory(): string
```

Return the default directory for the process
If pid_file or log_file is not specified.

**返回**: `string`

### Protected 方法

#### `defaultPidFile`

```php
protected function defaultPidFile(): string
```

Return actual pid file.

**返回**: `string`

#### `defaultLogFile`

```php
protected function defaultLogFile(): string
```

Return actual log file.

**返回**: `string`

