---
fqcn: Hi\Database\Connection\PDOConnectionConfig
type: class
namespace: Hi\Database\Connection
module: Database
file: src/Database/Connection/PDOConnectionConfig.php
line: 9
---
# PDOConnectionConfig

**命名空间**: `Hi\Database\Connection`

**类型**: Class

**文件**: `src/Database/Connection/PDOConnectionConfig.php:9`

**修饰符**: abstract

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$unixSocket` | `string` | public readonly | - |  |
| `$host` | `string` | public readonly | - |  |
| `$port` | `int` | public readonly | - |  |
| `$user` | `string` | public readonly | - |  |
| `$password` | `string` | public readonly | - |  |
| `$database` | `string` | public readonly | - |  |
| `$charset` | `string` | public readonly | - |  |
| `$options` | `array` | public readonly | - |  |
| `$lostRetries` | `int` | public readonly | - | Connect lost retries |
| `$lostRetryWaitTime` | `float` | public readonly | - | Connect reconnect wait time |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $config)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `void`

#### `dsn`

**标记**: abstract

```php
abstract public function dsn(): string
```

**返回**: `string`

#### `getDefaultOptions`

**标记**: abstract

```php
abstract public function getDefaultOptions(): array
```

**返回**: `array`

### Protected 方法

#### `valid`

```php
protected function valid(array $config): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `void`

**抛出异常**:

- `MySQLConfigInvalidException`

