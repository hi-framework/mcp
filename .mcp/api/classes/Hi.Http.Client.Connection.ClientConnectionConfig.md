---
fqcn: Hi\Http\Client\Connection\ClientConnectionConfig
type: class
namespace: Hi\Http\Client\Connection
module: Http
file: src/Http/Client/Connection/ClientConnectionConfig.php
line: 12
---
# ClientConnectionConfig

**命名空间**: `Hi\Http\Client\Connection`

**类型**: Class

**文件**: `src/Http/Client/Connection/ClientConnectionConfig.php:12`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$host` | `string` | public readonly | - |  |
| `$port` | `int` | public readonly | - |  |
| `$ssl` | `bool` | public readonly | - |  |
| `$keepalive` | `bool` | public readonly | - |  |
| `$timeout` | `float` | public readonly | - |  |
| `$connectTimeout` | `float` | public readonly | - |  |
| `$writeTimeout` | `float` | public readonly | - |  |
| `$readTimeout` | `float` | public readonly | - |  |
| `$username` | `string` | public readonly | - |  |
| `$password` | `string` | public readonly | - |  |
| `$redirect` | `string` | public readonly | - |  |
| `$maxReconnectAttempts` | `int` | public readonly | - |  |
| `$reconnectDelay` | `float` | public readonly | - |  |
| `$followLocation` | `bool` | public readonly | - |  |
| `$maxRedirs` | `int` | public readonly | - |  |
| `$sslVerify` | `bool` | public readonly | - |  |
| `$sslCertFile` | `?string` | public readonly | - |  |
| `$sslKeyFile` | `?string` | public readonly | - |  |
| `$sslCaFile` | `?string` | public readonly | - |  |

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

#### `validate`

```php
public function validate(array $config): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `void`

