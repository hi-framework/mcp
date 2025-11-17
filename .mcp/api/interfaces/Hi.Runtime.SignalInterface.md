---
fqcn: Hi\Runtime\SignalInterface
type: interface
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/SignalInterface.php
line: 11
---
# SignalInterface

**命名空间**: `Hi\Runtime`

**类型**: Interface

**文件**: `src/Runtime/SignalInterface.php:11`

Signal handler interface
Each extension needs to implement this interface to provide signal handling capabilities

## 方法

### Public 方法

#### `register`

```php
public function register(int $signal, callable $callback): void
```

Register a signal handler

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$signal` | `int` | - | The signal number |
| `$callback` | `callable` | - | The callback function to handle the signal |

**返回**: `void`

#### `unregister`

```php
public function unregister(int $signal, ?callable $callback = 'null'): void
```

Remove a signal handler

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$signal` | `int` | - | The signal number |
| `$callback` | `?callable` | 'null' | The callback function to handle the signal |

**返回**: `void`

#### `process`

```php
public function process(): void
```

Process pending signals

**返回**: `void`

#### `isSupported`

```php
public function isSupported(int $signal): bool
```

Check if a signal is supported

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$signal` | `int` | - | The signal number |

**返回**: `bool` - true if the signal is supported, false otherwise

#### `cleanup`

```php
public function cleanup(): void
```

Cleanup all signal handlers
This method should be called when the application is shutting down

**返回**: `void`

