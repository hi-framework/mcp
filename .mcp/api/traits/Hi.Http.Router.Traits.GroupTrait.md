---
fqcn: Hi\Http\Router\Traits\GroupTrait
type: trait
namespace: Hi\Http\Router\Traits
module: Http
file: src/Http/Router/Traits/GroupTrait.php
line: 13
---
# GroupTrait

**命名空间**: `Hi\Http\Router\Traits`

**类型**: Trait

**文件**: `src/Http/Router/Traits/GroupTrait.php:13`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$prefixes` | `array` | protected | [] |  |
| `$extendes` | `array` | protected | [] |  |

## 方法

### Public 方法

#### `group`

```php
public function group(string $prefix, callable $handler, ?Hi\Http\Router\Extend $extend = 'null'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$prefix` | `string` | - |  |
| `$handler` | `callable` | - |  |
| `$extend` | `?Hi\Http\Router\Extend` | 'null' |  |

**返回**: `void`

### Protected 方法

#### `prefixesMerge`

```php
protected function prefixesMerge(string $pattern): string
```

Merge group prefixes setting to route pattern.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$pattern` | `string` | - |  |

**返回**: `string`

#### `extendsMerge`

```php
protected function extendsMerge(?Hi\Http\Router\Extend $extend): Hi\Http\Router\Extend
```

Merge group extends setting to route extend.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$extend` | `?Hi\Http\Router\Extend` | - |  |

**返回**: `Hi\Http\Router\Extend`

