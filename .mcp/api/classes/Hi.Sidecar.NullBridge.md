---
fqcn: Hi\Sidecar\NullBridge
type: class
namespace: Hi\Sidecar
module: Sidecar
file: src/Sidecar/NullBridge.php
line: 7
---
# NullBridge

**命名空间**: `Hi\Sidecar`

**类型**: Class

**文件**: `src/Sidecar/NullBridge.php:7`

## 继承关系

**实现**: `Hi\Sidecar\BridgeInterface`

## 方法

### Public 方法

#### `finalize`

```php
public function finalize(): void
```

**返回**: `void`

#### `appInit`

```php
public function appInit(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `appShutdown`

```php
public function appShutdown(): mixed
```

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

#### `counterRegister`

```php
public function counterRegister(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `counterDeal`

```php
public function counterDeal(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `gaugeRegister`

```php
public function gaugeRegister(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `gaugeDeal`

```php
public function gaugeDeal(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `histogramRegister`

```php
public function histogramRegister(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `histogramDeal`

```php
public function histogramDeal(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `summaryRegister`

```php
public function summaryRegister(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

#### `summaryDeal`

```php
public function summaryDeal(array $config): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `mixed`

