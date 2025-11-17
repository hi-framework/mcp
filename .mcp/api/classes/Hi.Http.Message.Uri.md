---
fqcn: Hi\Http\Message\Uri
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/Uri.php
line: 9
---
# Uri

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/Uri.php:9`

## 继承关系

**实现**: `Psr\Http\Message\UriInterface`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `SCHEMES` | [] | protected |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$scheme` | `string` | protected | '' |  |
| `$userInfo` | `string` | protected | '' |  |
| `$host` | `string` | protected | '' |  |
| `$port` | `?int` | protected | 'null' |  |
| `$path` | `string` | protected | '' |  |
| `$query` | `string` | protected | '' |  |
| `$fragment` | `string` | protected | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $uri = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$uri` | `string` | '' |  |

**返回**: `void`

#### `__toString`

```php
public function __toString(): string
```

**返回**: `string`

#### `getScheme`

```php
public function getScheme(): string
```

**返回**: `string`

#### `getAuthority`

```php
public function getAuthority(): string
```

**返回**: `string`

#### `getUserInfo`

```php
public function getUserInfo(): string
```

**返回**: `string`

#### `getHost`

```php
public function getHost(): string
```

**返回**: `string`

#### `getPort`

```php
public function getPort(): ?int
```

**返回**: `?int`

#### `getPath`

```php
public function getPath(): string
```

**返回**: `string`

#### `getQuery`

```php
public function getQuery(): string
```

**返回**: `string`

#### `getFragment`

```php
public function getFragment(): string
```

**返回**: `string`

#### `withScheme`

```php
public function withScheme(string $scheme): Psr\Http\Message\UriInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$scheme` | `string` | - |  |

**返回**: `Psr\Http\Message\UriInterface`

#### `withUserInfo`

```php
public function withUserInfo(string $user, ?string $password = 'null'): Psr\Http\Message\UriInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$user` | `string` | - |  |
| `$password` | `?string` | 'null' |  |

**返回**: `Psr\Http\Message\UriInterface`

#### `withHost`

```php
public function withHost(string $host): Psr\Http\Message\UriInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$host` | `string` | - |  |

**返回**: `Psr\Http\Message\UriInterface`

#### `withPort`

```php
public function withPort(?int $port): Psr\Http\Message\UriInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$port` | `?int` | - |  |

**返回**: `Psr\Http\Message\UriInterface`

#### `withPath`

```php
public function withPath(string $path): Psr\Http\Message\UriInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$path` | `string` | - |  |

**返回**: `Psr\Http\Message\UriInterface`

#### `withQuery`

```php
public function withQuery(string $query): Psr\Http\Message\UriInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$query` | `string` | - |  |

**返回**: `Psr\Http\Message\UriInterface`

#### `withFragment`

```php
public function withFragment(string $fragment): Psr\Http\Message\UriInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$fragment` | `string` | - |  |

**返回**: `Psr\Http\Message\UriInterface`

### Protected 方法

#### `normalizeScheme`

```php
protected function normalizeScheme(string $scheme): string
```

Normalize the scheme component of the URI.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$scheme` | `string` | - |  |

**返回**: `string`

#### `normalizePort`

```php
protected function normalizePort(?int $port): ?int
```

Normalize the port component of the URI.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$port` | `?int` | - |  |

**返回**: `?int`

#### `encode`

```php
protected function encode(string $string, string $pattern): string
```

Percent encodes all reserved characters in the provided string according to the provided pattern.
Characters that are already encoded as a percentage will not be re-encoded.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$string` | `string` | - |  |
| `$pattern` | `string` | - |  |

**返回**: `string`

#### `normalizeUserInfo`

```php
protected function normalizeUserInfo(string $user, ?string $pass = 'null'): string
```

Normalize the user information component of the URI.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$user` | `string` | - |  |
| `$pass` | `?string` | 'null' |  |

**返回**: `string`

#### `normalizePath`

```php
protected function normalizePath(string $path): string
```

Normalize the path component of the URI.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$path` | `string` | - |  |

**返回**: `string`

#### `normalizeQuery`

```php
protected function normalizeQuery(string $query): string
```

Normalize the query string of the URI.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$query` | `string` | - |  |

**返回**: `string`

#### `normalizeFragment`

```php
protected function normalizeFragment(string $fragment): string
```

Normalize the fragment component of the URI.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$fragment` | `string` | - |  |

**返回**: `string`

