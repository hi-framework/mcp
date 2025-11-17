---
fqcn: Hi\Sidecar\Bridge
type: class
namespace: Hi\Sidecar
module: Sidecar
file: src/Sidecar/Bridge.php
line: 17
---
# Bridge

**命名空间**: `Hi\Sidecar`

**类型**: Class

**文件**: `src/Sidecar/Bridge.php:17`

## 继承关系

**实现**: `Hi\Sidecar\BridgeInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$pool` | `Hi\Sidecar\Connection\BridgePool` | protected | - |  |
| `$closed` | `bool` | protected | 'false' |  |
| `$retries` | `int` | protected | - |  |
| `$container` | `Psr\Container\ContainerInterface` | protected readonly | - |  |
| `$appConfig` | `Hi\Kernel\ConfigInterface` | protected readonly | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $poolConfig, Psr\Container\ContainerInterface $container, Hi\Kernel\ConfigInterface $appConfig, Psr\Log\LoggerInterface $logger)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$poolConfig` | `array` | - |  |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$appConfig` | `Hi\Kernel\ConfigInterface` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

#### `finalize`

```php
public function finalize(): void
```

**返回**: `void`

#### `call`

```php
public function call(string $method, mixed $payload, mixed $options = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$payload` | `mixed` | - |  |
| `$options` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `appShutdown`

```php
public function appShutdown(): mixed
```

**返回**: `mixed`

#### `appInit`

```php
public function appInit(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `consumerInit`

```php
public function consumerInit(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `consumerReceive`

```php
public function consumerReceive(string $connection, string $topic, int $size): mixed
```

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

### Protected 方法

#### `send`

```php
protected function send(string $method, mixed $payload, mixed $options = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$method` | `string` | - |  |
| `$payload` | `mixed` | - |  |
| `$options` | `mixed` | 'null' |  |

**返回**: `mixed`

