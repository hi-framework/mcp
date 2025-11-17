---
fqcn: Hi\Runtime\Swoole\Signal
type: class
namespace: Hi\Runtime\Swoole
module: Runtime
file: src/Runtime/Swoole/Signal.php
line: 13
---
# Signal

**命名空间**: `Hi\Runtime\Swoole`

**类型**: Class

**文件**: `src/Runtime/Swoole/Signal.php:13`

Swoole signal handler
Use Swoole's Process::signal method to implement signal handling

## 继承关系

**实现**: `Hi\Runtime\SignalInterface`

**使用 Traits**: `Hi\Runtime\Swoole\ExtensionCheckTrait`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$callbacks` | `array` | private | [] |  |
| `$registeredSignals` | `array` | private | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct()
```

**返回**: `void`

#### `register`

```php
public function register(int $signal, callable $callback): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$signal` | `int` | - |  |
| `$callback` | `callable` | - |  |

**返回**: `void`

#### `unregister`

```php
public function unregister(int $signal, ?callable $callback = 'null'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$signal` | `int` | - |  |
| `$callback` | `?callable` | 'null' |  |

**返回**: `void`

#### `process`

```php
public function process(): void
```

**返回**: `void`

#### `isSupported`

```php
public function isSupported(int $signal): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$signal` | `int` | - |  |

**返回**: `bool`

#### `cleanup`

```php
public function cleanup(): void
```

**返回**: `void`

