---
fqcn: Hi\Runtime\AppRuntime
type: class
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/AppRuntime.php
line: 7
---
# AppRuntime

**命名空间**: `Hi\Runtime`

**类型**: Class

**文件**: `src/Runtime/AppRuntime.php:7`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$type` | `?Hi\Runtime\AppRuntimeTypeEnum` | private static | 'null' |  |
| `$coroutine` | `?Hi\Runtime\CoroutineInterface` | private static | 'null' |  |
| `$timer` | `?Hi\Runtime\TimerInterface` | private static | 'null' |  |
| `$channel` | `?Hi\Runtime\ChannelInterface` | private static | 'null' |  |
| `$signal` | `?Hi\Runtime\SignalInterface` | private static | 'null' |  |
| `$event` | `?Hi\Runtime\EventInterface` | private static | 'null' |  |

## 方法

### Public 方法

#### `getType`

**标记**: static

```php
public static function getType(): Hi\Runtime\AppRuntimeTypeEnum
```

Returns the app runtime type
Different type of app runtime can be supported

**返回**: `Hi\Runtime\AppRuntimeTypeEnum`

#### `timer`

**标记**: static

```php
public static function timer(): Hi\Runtime\TimerInterface
```

**返回**: `Hi\Runtime\TimerInterface`

#### `coroutine`

**标记**: static

```php
public static function coroutine(): Hi\Runtime\CoroutineInterface
```

Returns the app runtime coroutine
Different runtime type has different coroutine

**返回**: `Hi\Runtime\CoroutineInterface`

#### `channel`

**标记**: static

```php
public static function channel(): Hi\Runtime\ChannelInterface
```

**返回**: `Hi\Runtime\ChannelInterface`

#### `signal`

**标记**: static

```php
public static function signal(): Hi\Runtime\SignalInterface
```

**返回**: `Hi\Runtime\SignalInterface`

#### `event`

**标记**: static

```php
public static function event(): Hi\Runtime\EventInterface
```

**返回**: `Hi\Runtime\EventInterface`

#### `exit`

**标记**: static

```php
public static function exit(): void
```

**返回**: `void`

#### `wait`

**标记**: static

```php
public static function wait(): void
```

Wait for all coroutines to complete

**返回**: `void`

#### `shutdown`

**标记**: static

```php
public static function shutdown(): void
```

Graceful shutdown of the application
First wait for all coroutines to complete, then execute resource cleanup

**返回**: `void`

