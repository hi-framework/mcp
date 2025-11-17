---
fqcn: Hi\Telemetry\TracerInterface
type: interface
namespace: Hi\Telemetry
module: Telemetry
file: src/Telemetry/TracerInterface.php
line: 7
---
# TracerInterface

**命名空间**: `Hi\Telemetry`

**类型**: Interface

**文件**: `src/Telemetry/TracerInterface.php:7`

## 方法

### Public 方法

#### `getContext`

```php
public function getContext(): array
```

Get current tracer context

**返回**: `array`

#### `trace`

```php
public function trace(string $name, callable $callback, array $attributes = [], bool $scoped = 'false', ?Hi\Telemetry\TraceKind $traceKind = 'null', ?int $startTime = 'null'): mixed
```

Trace a given callback

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$callback` | `callable` | - |  |
| `$attributes` | `array` | [] |  |
| `$scoped` | `bool` | 'false' |  |
| `$traceKind` | `?Hi\Telemetry\TraceKind` | 'null' |  |
| `$startTime` | `?int` | 'null' | start time in nanoseconds |

**返回**: `mixed`

**抛出异常**:

- `\Throwable`

