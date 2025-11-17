---
fqcn: Hi\Http\Metadata\MiddlewareMetadata
type: class
namespace: Hi\Http\Metadata
module: Http
file: src/Http/Metadata/MiddlewareMetadata.php
line: 13
---
# MiddlewareMetadata

**命名空间**: `Hi\Http\Metadata`

**类型**: Class

**文件**: `src/Http/Metadata/MiddlewareMetadata.php:13`

Middleware metadata class

Pure data structure for storing middleware metadata
Immutable container following the Event module metadata pattern

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$className` | `string` | public readonly | - |  |
| `$alias` | `string` | public readonly | '' |  |
| `$desc` | `string` | public readonly | '' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $className, string $alias = '', string $desc = '')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | Class name |
| `$alias` | `string` | '' | Alias (optional) |
| `$desc` | `string` | '' | Description |

**返回**: `void`

#### `getClassName`

```php
public function getClassName(): string
```

Get middleware class name

**返回**: `string`

