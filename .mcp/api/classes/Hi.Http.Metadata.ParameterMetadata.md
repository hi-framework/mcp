---
fqcn: Hi\Http\Metadata\ParameterMetadata
type: class
namespace: Hi\Http\Metadata
module: Http
file: src/Http/Metadata/ParameterMetadata.php
line: 14
---
# ParameterMetadata

**命名空间**: `Hi\Http\Metadata`

**类型**: Class

**文件**: `src/Http/Metadata/ParameterMetadata.php:14`

HTTP Parameter Metadata Class

Used to store metadata information for HTTP request parameters, including parameter type,
input configuration, dynamic properties, etc. This class is primarily used for metadata
management when the framework processes HTTP request parameters internally.

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$type` | `string` | public readonly | - |  |
| `$isInput` | `bool` | public readonly | 'false' |  |
| `$isFramework` | `bool` | public readonly | 'false' |  |
| `$isSingleton` | `bool` | public readonly | 'false' |  |
| `$defaultValue` | `mixed` | public readonly | 'null' |  |
| `$inputConfig` | `array` | public readonly | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $type, bool $isInput = 'false', bool $isFramework = 'false', bool $isSingleton = 'false', mixed $defaultValue = 'null', array $inputConfig = [])
```

Constructor

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$type` | `string` | - | parameter type, such as 'string', 'int', 'array', etc |
| `$isInput` | `bool` | 'false' | Whether this is an input parameter (obtained from request) |
| `$isFramework` | `bool` | 'false' | Whether this is a framework parameter (such as route parameters) |
| `$isSingleton` | `bool` | 'false' | Whether this is a singleton parameter (only one instance, will not be cloned) |
| `$defaultValue` | `mixed` | 'null' | Default value to use when parameter doesn't exist |
| `$inputConfig` | `array` | [] |  |

**返回**: `void`

