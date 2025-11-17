---
fqcn: Hi\Runtime\ChannelInstanceInterface
type: interface
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/ChannelInstanceInterface.php
line: 7
---
# ChannelInstanceInterface

**命名空间**: `Hi\Runtime`

**类型**: Interface

**文件**: `src/Runtime/ChannelInstanceInterface.php:7`

## 方法

### Public 方法

#### `push`

```php
public function push(mixed $data, float $timeout = '...'): bool
```

Push data to the Channel

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `mixed` | - | The data to push |
| `$timeout` | `float` | '...' | The timeout in seconds, -1 means infinite wait, 0 means non-blocking |

**返回**: `bool` - true if the data was pushed successfully, false otherwise

**抛出异常**:

- `\RuntimeException` - When the Channel is closed

#### `pop`

```php
public function pop(float $timeout = '...'): mixed
```

Pop data from the Channel

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$timeout` | `float` | '...' | The timeout in seconds, -1 means infinite wait, 0 means non-blocking |

**返回**: `mixed` - The popped data, false if timeout or failed

**抛出异常**:

- `\RuntimeException` - When the Channel is closed

#### `tryPush`

```php
public function tryPush(mixed $data): bool
```

Try to push data to the Channel (non-blocking)

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$data` | `mixed` | - | The data to push |

**返回**: `bool` - true if the data was pushed successfully, false otherwise

#### `tryPop`

```php
public function tryPop(): mixed
```

Try to pop data from the Channel (non-blocking)

**返回**: `mixed` - The popped data, false if there is no data

#### `close`

```php
public function close(): bool
```

Close the Channel

**返回**: `bool` - true if the Channel was closed successfully, false otherwise

#### `isClosed`

```php
public function isClosed(): bool
```

Check if the Channel is closed

**返回**: `bool` - true if the Channel is closed, false otherwise

#### `getCapacity`

```php
public function getCapacity(): int
```

Get the capacity of the Channel

**返回**: `int` - The capacity of the Channel, 0 means unlimited

#### `getLength`

```php
public function getLength(): int
```

Get the number of items in the Channel

**返回**: `int` - The number of items in the Channel

#### `isEmpty`

```php
public function isEmpty(): bool
```

Check if the Channel is empty

**返回**: `bool` - true if the Channel is empty, false otherwise

#### `isFull`

```php
public function isFull(): bool
```

Check if the Channel is full

**返回**: `bool` - true if the Channel is full, false otherwise

#### `getStats`

```php
public function getStats(): array
```

Get the status information of the Channel

**返回**: `array` - int, capacity: int, length: int, closed: bool, empty: bool} The status information of the Channel

#### `clear`

```php
public function clear(): int
```

Clear all data in the Channel

**返回**: `int` - The number of items cleared

#### `getId`

```php
public function getId(): int
```

Get the ID of the Channel (for debugging and tracing)

**返回**: `int` - The unique identifier of the Channel

#### `getRawChannel`

```php
public function getRawChannel(): mixed
```

Get the raw Channel object

**返回**: `mixed` - The raw Channel object

