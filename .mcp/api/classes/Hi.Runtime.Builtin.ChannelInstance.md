---
fqcn: Hi\Runtime\Builtin\ChannelInstance
type: class
namespace: Hi\Runtime\Builtin
module: Runtime
file: src/Runtime/Builtin/ChannelInstance.php
line: 10
---
# ChannelInstance

**命名空间**: `Hi\Runtime\Builtin`

**类型**: Class

**文件**: `src/Runtime/Builtin/ChannelInstance.php:10`

## 继承关系

**实现**: `Hi\Runtime\ChannelInstanceInterface`

## 方法

### Public 方法

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

