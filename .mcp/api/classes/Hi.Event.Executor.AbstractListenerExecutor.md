---
fqcn: Hi\Event\Executor\AbstractListenerExecutor
type: class
namespace: Hi\Event\Executor
module: Event
file: src/Event/Executor/AbstractListenerExecutor.php
line: 15
---
# AbstractListenerExecutor

**命名空间**: `Hi\Event\Executor`

**类型**: Class

**文件**: `src/Event/Executor/AbstractListenerExecutor.php:15`

**修饰符**: abstract

Abstract base class for listener executors

Provides common functionality for resolving callables and sanitizing logs

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | protected readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Log\LoggerInterface $logger = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |

**返回**: `void`

### Protected 方法

#### `sanitizeStackTrace`

```php
protected function sanitizeStackTrace(array $trace): array
```

Sanitize stack trace for logging (remove sensitive information)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$trace` | `array` | - |  |

**返回**: `array`

#### `formatDuration`

```php
protected function formatDuration(float $durationMs): string
```

Format execution duration for logging

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$durationMs` | `float` | - |  |

**返回**: `string`

