---
fqcn: Hi\Runtime\Swoole\ChannelInstance
type: class
namespace: Hi\Runtime\Swoole
module: Runtime
file: src/Runtime/Swoole/ChannelInstance.php
line: 14
---
# ChannelInstance

**命名空间**: `Hi\Runtime\Swoole`

**类型**: Class

**文件**: `src/Runtime/Swoole/ChannelInstance.php:14`

Swoole Channel instance implementation
Wraps Swoole\Coroutine\Channel to conform to the ChannelInstanceInterface interface

## 继承关系

**实现**: `Hi\Runtime\ChannelInstanceInterface`

**使用 Traits**: `Hi\Runtime\Swoole\ExtensionCheckTrait`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$channel` | `Swoole\Coroutine\Channel` | private | - |  |
| `$id` | `int` | private | - |  |
| `$nextId` | `int` | private static | 1 |  |
| `$isClosed` | `bool` | private | 'false' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(int $capacity = 0)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$capacity` | `int` | 0 |  |

**返回**: `void`

#### `push`

```php
public function push(mixed $data, float $timeout = '...'): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `mixed` | - |  |
| `$timeout` | `float` | '...' |  |

**返回**: `bool`

#### `pop`

```php
public function pop(float $timeout = '...'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$timeout` | `float` | '...' |  |

**返回**: `mixed`

#### `tryPush`

```php
public function tryPush(mixed $data): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `mixed` | - |  |

**返回**: `bool`

#### `tryPop`

```php
public function tryPop(): mixed
```

**返回**: `mixed`

#### `close`

```php
public function close(): bool
```

**返回**: `bool`

#### `isClosed`

```php
public function isClosed(): bool
```

**返回**: `bool`

#### `getCapacity`

```php
public function getCapacity(): int
```

**返回**: `int`

#### `getLength`

```php
public function getLength(): int
```

**返回**: `int`

#### `isEmpty`

```php
public function isEmpty(): bool
```

**返回**: `bool`

#### `isFull`

```php
public function isFull(): bool
```

**返回**: `bool`

#### `getStats`

```php
public function getStats(): array
```

**返回**: `array`

#### `clear`

```php
public function clear(): int
```

**返回**: `int`

#### `getId`

```php
public function getId(): int
```

**返回**: `int`

#### `getRawChannel`

```php
public function getRawChannel(): mixed
```

**返回**: `mixed`

