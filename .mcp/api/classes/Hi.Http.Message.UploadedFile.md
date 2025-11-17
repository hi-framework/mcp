---
fqcn: Hi\Http\Message\UploadedFile
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/UploadedFile.php
line: 10
---
# UploadedFile

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/UploadedFile.php:10`

## 继承关系

**实现**: `Psr\Http\Message\UploadedFileInterface`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `ERRORS` | [] | protected |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$stream` | `?Psr\Http\Message\StreamInterface` | protected | 'null' |  |
| `$file` | `?string` | protected | 'null' |  |
| `$isMoved` | `bool` | protected | 'false' |  |
| `$size` | `int` | protected | - |  |
| `$error` | `int` | protected | - |  |
| `$clientFilename` | `?string` | protected | 'null' |  |
| `$clientMediaType` | `?string` | protected | 'null' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(mixed $streamOrFile, int $size, int $error, ?string $clientFilename = 'null', ?string $clientMediaType = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$streamOrFile` | `mixed` | - |  |
| `$size` | `int` | - |  |
| `$error` | `int` | - |  |
| `$clientFilename` | `?string` | 'null' |  |
| `$clientMediaType` | `?string` | 'null' |  |

**返回**: `void`

#### `getStream`

```php
public function getStream(): Psr\Http\Message\StreamInterface
```

**返回**: `Psr\Http\Message\StreamInterface`

#### `moveTo`

```php
public function moveTo(string $targetPath): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$targetPath` | `string` | - |  |

**返回**: `void`

#### `getSize`

```php
public function getSize(): ?int
```

**返回**: `?int`

#### `getError`

```php
public function getError(): int
```

**返回**: `int`

#### `getClientFilename`

```php
public function getClientFilename(): ?string
```

**返回**: `?string`

#### `getClientMediaType`

```php
public function getClientMediaType(): ?string
```

**返回**: `?string`

