---
fqcn: Hi\Testing\TestCase
type: class
namespace: Hi\Testing
module: Testing
file: src/Testing/TestCase.php
line: 10
---
# TestCase

**命名空间**: `Hi\Testing`

**类型**: Class

**文件**: `src/Testing/TestCase.php:10`

## 继承关系

**继承**: `Hi\Testing\PHPUnit\Framework\TestCase`

## 方法

### Public 方法

#### `post`

```php
public function post(string $uri, ?array $parsedBody = 'null', array $headers = [], Psr\Http\Message\StreamInterface|string $body = ''): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$uri` | `string` | - |  |
| `$parsedBody` | `?array` | 'null' |  |
| `$headers` | `array` | [] |  |
| `$body` | `Psr\Http\Message\StreamInterface\|string` | '' |  |

**返回**: `mixed`

#### `get`

```php
public function get(string $uri, array $queryParams = [], array $headers = [], Psr\Http\Message\StreamInterface|string $body = ''): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$uri` | `string` | - |  |
| `$queryParams` | `array` | [] |  |
| `$headers` | `array` | [] |  |
| `$body` | `Psr\Http\Message\StreamInterface\|string` | '' |  |

**返回**: `mixed`

