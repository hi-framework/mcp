---
fqcn: Hi\Http\Message\Stream
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/Stream.php
line: 14
---
# Stream

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/Stream.php:14`

`Psr\HttpMessage\StreamInterface` implementation.

## 继承关系

**实现**: `Psr\Http\Message\StreamInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$resource` | `null\|resource` | protected | - |  |
| `$size` | `?int` | protected | 'null' |  |
| `$seekable` | `?bool` | protected | 'null' |  |
| `$readable` | `?bool` | protected | 'null' |  |
| `$writable` | `?bool` | protected | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(mixed $stream = 'php://memory', string $mode = 'w+b')
```

Init stream.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$stream` | `mixed` | 'php://memory' | String stream target or stream resource |
| `$mode` | `string` | 'w+b' | Stream resource operation mode |

**返回**: `void`

**抛出异常**:

- `\RuntimeException`
- `\InvalidArgumentException`

#### `__destruct`

```php
public function __destruct()
```

Destroy stream.

**返回**: `void`

#### `__toString`

```php
public function __toString(): string
```

**返回**: `string`

#### `close`

```php
public function close(): void
```

**返回**: `void`

#### `detach`

```php
public function detach()
```

**返回**: `void`

#### `getSize`

```php
public function getSize(): ?int
```

**返回**: `?int`

#### `tell`

```php
public function tell(): int
```

**返回**: `int`

#### `eof`

```php
public function eof(): bool
```

**返回**: `bool`

#### `isSeekable`

```php
public function isSeekable(): bool
```

**返回**: `bool`

#### `seek`

```php
public function seek(int $offset, int $whence = 'SEEK_SET'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `int` | - |  |
| `$whence` | `int` | 'SEEK_SET' |  |

**返回**: `void`

#### `rewind`

```php
public function rewind(): void
```

**返回**: `void`

#### `isWritable`

```php
public function isWritable(): bool
```

**返回**: `bool`

#### `write`

```php
public function write(string $string): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$string` | `string` | - |  |

**返回**: `int`

#### `isReadable`

```php
public function isReadable(): bool
```

**返回**: `bool`

#### `read`

```php
public function read(int $length): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$length` | `int` | - |  |

**返回**: `string`

#### `getContents`

```php
public function getContents(): string
```

**返回**: `string`

#### `getMetadata`

```php
public function getMetadata(?string $key = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `?string` | 'null' |  |

**返回**: `void`

