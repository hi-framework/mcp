---
fqcn: Hi\Runtime\Builtin\Signal
type: class
namespace: Hi\Runtime\Builtin
module: Runtime
file: src/Runtime/Builtin/Signal.php
line: 13
---
# Signal

**命名空间**: `Hi\Runtime\Builtin`

**类型**: Class

**文件**: `src/Runtime/Builtin/Signal.php:13`

Builtin signal handler
使用 PHP 的 pcntl 扩展实现信号处理

## 继承关系

**实现**: `Hi\Runtime\SignalInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$callbacks` | `array` | private | [] |  |
| `$registeredSignals` | `array` | private | [] |  |
| `$pcntlEnabled` | `bool` | private | - |  |

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

