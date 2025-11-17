---
fqcn: Hi\Sidecar\BridgeInterface
type: interface
namespace: Hi\Sidecar
module: Sidecar
file: src/Sidecar/BridgeInterface.php
line: 7
---
# BridgeInterface

**命名空间**: `Hi\Sidecar`

**类型**: Interface

**文件**: `src/Sidecar/BridgeInterface.php:7`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `AppConfigUninitialized` | 1000 | public |  |
| `AppClosed` | 1002 | public |  |

## 方法

### Public 方法

#### `appInit`

```php
public function appInit(array $config): mixed
```

Sidecar init(sync app config to sidecar)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `appShutdown`

```php
public function appShutdown(): mixed
```

Shutdown sidecar

**返回**: `mixed`

#### `consumerInit`

```php
public function consumerInit(array $config): mixed
```

Queue consumer init

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `consumerReceive`

```php
public function consumerReceive(string $connection, string $topic, int $size): mixed
```

Fetch message from queue

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `string` | - |  |
| `$topic` | `string` | - |  |
| `$size` | `int` | - |  |

**返回**: `mixed`

#### `consumerClose`

```php
public function consumerClose(string $connection, string $topic): mixed
```

Close queue consumer

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `string` | - |  |
| `$topic` | `string` | - |  |

**返回**: `mixed`

#### `produceMessage`

```php
public function produceMessage(string $connection, string $topic, string $value, string $key = '', array $headers = [], bool $syncMode = 'false'): mixed
```

Produce message

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$connection` | `string` | - |  |
| `$topic` | `string` | - |  |
| `$value` | `string` | - |  |
| `$key` | `string` | '' |  |
| `$headers` | `array` | [] |  |
| `$syncMode` | `bool` | 'false' |  |

**返回**: `mixed`

