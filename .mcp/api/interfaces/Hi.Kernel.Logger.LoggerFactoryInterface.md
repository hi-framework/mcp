---
fqcn: Hi\Kernel\Logger\LoggerFactoryInterface
type: interface
namespace: Hi\Kernel\Logger
module: Kernel
file: src/Kernel/Logger/LoggerFactoryInterface.php
line: 9
---
# LoggerFactoryInterface

**命名空间**: `Hi\Kernel\Logger`

**类型**: Interface

**文件**: `src/Kernel/Logger/LoggerFactoryInterface.php:9`

## 方法

### Public 方法

#### `has`

```php
public function has(string $channel): bool
```

Check if a logger instance exists for the specified channel.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$channel` | `string` | - |  |

**返回**: `bool`

#### `get`

```php
public function get(?string $channel = 'null', string $level = 'debug', bool $newLogger = 'true'): Psr\Log\LoggerInterface
```

Get a logger instance for the specified channel.
If no channel is specified, the default channel will be used.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$channel` | `?string` | 'null' |  |
| `$level` | `string` | 'debug' |  |
| `$newLogger` | `bool` | 'true' |  |

**返回**: `Psr\Log\LoggerInterface`

#### `set`

```php
public function set(string $channel, Psr\Log\LoggerInterface $logger): void
```

Set a logger instance for the specified channel.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$channel` | `string` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

