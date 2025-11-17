---
fqcn: Hi\Http\Pipeline
type: class
namespace: Hi\Http
module: Http
file: src/Http/Pipeline.php
line: 9
---
# Pipeline

**命名空间**: `Hi\Http`

**类型**: Class

**文件**: `src/Http/Pipeline.php:9`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$auth` | `bool` | public readonly | - |  |
| `$stack` | `mixed` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(bool $auth, mixed $stack)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$auth` | `bool` | - |  |
| `$stack` | `mixed` | - |  |

**返回**: `void`

#### `create`

**标记**: static

```php
public static function create(array $stages, callable $destination, bool $auth): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$stages` | `array` | - |  |
| `$destination` | `callable` | - |  |
| `$auth` | `bool` | - |  |

**返回**: `self`

