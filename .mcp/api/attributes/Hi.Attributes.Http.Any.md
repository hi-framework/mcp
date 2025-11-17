---
fqcn: Hi\Attributes\Http\Any
type: class
namespace: Hi\Attributes\Http
module: Attributes
file: src/Attributes/Http/Any.php
line: 11
---
# Any

**命名空间**: `Hi\Attributes\Http`

**类型**: Class

**文件**: `src/Attributes/Http/Any.php:11`

HTTP route action attribute
Using it means supporting all HTTP request methods.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$method` | `string` | protected | 'ANY' |  |
| `$pattern` | `string` | public readonly | - |  |
| `$desc` | `string` | public readonly | - |  |
| `$middlewares` | `array\|string` | public readonly | [] |  |
| `$auth` | `?bool` | public readonly | 'null' |  |
| `$cors` | `string` | public readonly | '' |  |
| `$owner` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $pattern, string $desc, array|string $middlewares = [], ?bool $auth = 'null', string $cors = '', string $owner = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - | Route pattern |
| `$desc` | `string` | - | Route description |
| `$middlewares` | `array\|string` | [] | Route middlewares |
| `$auth` | `?bool` | 'null' | Route need authentication |
| `$cors` | `string` | '' | Route cors policy(middleware alias) |
| `$owner` | `string` | '' | Route owner |

**返回**: `void`

#### `getMethod`

```php
public function getMethod(): string
```

Get HTTP method

**返回**: `string`

## Attribute 信息

**目标**: METHOD

**可重复**: 否

### 使用示例

```php
#[Any(pattern: '/example', desc: '/example')]
class MyClass {}
```

