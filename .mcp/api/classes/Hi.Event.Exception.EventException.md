---
fqcn: Hi\Event\Exception\EventException
type: class
namespace: Hi\Event\Exception
module: Event
file: src/Event/Exception/EventException.php
line: 12
---
# EventException

**命名空间**: `Hi\Event\Exception`

**类型**: Class

**文件**: `src/Event/Exception/EventException.php:12`

Base event system exception

Base exception class for all event-related errors

## 继承关系

**继承**: `Hi\Event\Exception\Exception`

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $message = '', int $code = 0, ?Hi\Event\Exception\Throwable $previous = 'null')
```

Create exception with context

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `string` | '' | Exception message |
| `$code` | `int` | 0 | Exception code |
| `$previous` | `?Hi\Event\Exception\Throwable` | 'null' | Previous exception |

**返回**: `void`

#### `eventNotFound`

**标记**: static

```php
public static function eventNotFound(string $eventName): self
```

Create exception for event not found

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventName` | `string` | - |  |

**返回**: `self`

#### `listenerNotFound`

**标记**: static

```php
public static function listenerNotFound(string $listenerName): self
```

Create exception for listener not found

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$listenerName` | `string` | - |  |

**返回**: `self`

#### `invalidEventType`

**标记**: static

```php
public static function invalidEventType(string $type): self
```

Create exception for invalid event type

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$type` | `string` | - |  |

**返回**: `self`

#### `listenerExecutionFailed`

**标记**: static

```php
public static function listenerExecutionFailed(string $listenerName, Hi\Event\Exception\Throwable $previous): self
```

Create exception for listener execution failure

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$listenerName` | `string` | - |  |
| `$previous` | `Hi\Event\Exception\Throwable` | - |  |

**返回**: `self`

