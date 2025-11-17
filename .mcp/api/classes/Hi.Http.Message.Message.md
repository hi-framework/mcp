---
fqcn: Hi\Http\Message\Message
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/Message.php
line: 10
---
# Message

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/Message.php:10`

**修饰符**: abstract

## 继承关系

**实现**: `Psr\Http\Message\MessageInterface`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `SupportedProtocolVersions` | [] | protected |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$body` | `?Psr\Http\Message\StreamInterface` | protected | 'null' |  |
| `$statusCode` | `int` | protected | 200 |  |
| `$reasonPhrase` | `string` | protected | 'OK' |  |
| `$protocol` | `string` | protected | '1.1' |  |
| `$headerNames` | `array` | protected | [] |  |
| `$headers` | `array` | protected | [] |  |

## 方法

### Public 方法

#### `getProtocolVersion`

```php
public function getProtocolVersion(): string
```

**返回**: `string`

#### `withProtocolVersion`

```php
public function withProtocolVersion(string $version): Psr\Http\Message\MessageInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$version` | `string` | - |  |

**返回**: `Psr\Http\Message\MessageInterface`

#### `getHeaders`

```php
public function getHeaders(): array
```

**返回**: `array`

#### `hasHeader`

```php
public function hasHeader(string $name): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `getHeader`

```php
public function getHeader(string $name): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `array`

#### `getHeaderLine`

```php
public function getHeaderLine(string $name): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `string`

#### `withHeader`

```php
public function withHeader(string $name, $value): Psr\Http\Message\MessageInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `Psr\Http\Message\MessageInterface`

#### `withAddedHeader`

```php
public function withAddedHeader(string $name, $value): Psr\Http\Message\MessageInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `Psr\Http\Message\MessageInterface`

#### `withoutHeader`

```php
public function withoutHeader(string $name): Psr\Http\Message\MessageInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `Psr\Http\Message\MessageInterface`

#### `getBody`

```php
public function getBody(): Psr\Http\Message\StreamInterface
```

**返回**: `Psr\Http\Message\StreamInterface`

#### `withBody`

```php
public function withBody(Psr\Http\Message\StreamInterface $body): Psr\Http\Message\MessageInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$body` | `Psr\Http\Message\StreamInterface` | - |  |

**返回**: `Psr\Http\Message\MessageInterface`

### Protected 方法

#### `registerHeaders`

```php
protected function registerHeaders(array $originalHeaders = []): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$originalHeaders` | `array` | [] |  |

**返回**: `void`

#### `normalizeHeaderName`

```php
protected function normalizeHeaderName(string $name): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `string`

#### `normalizeHeaderValue`

```php
protected function normalizeHeaderValue(mixed $value): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$value` | `mixed` | - |  |

**返回**: `array`

