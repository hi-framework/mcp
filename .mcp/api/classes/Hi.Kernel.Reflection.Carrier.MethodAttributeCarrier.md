---
fqcn: Hi\Kernel\Reflection\Carrier\MethodAttributeCarrier
type: class
namespace: Hi\Kernel\Reflection\Carrier
module: Kernel
file: src/Kernel/Reflection/Carrier/MethodAttributeCarrier.php
line: 7
---
# MethodAttributeCarrier

**命名空间**: `Hi\Kernel\Reflection\Carrier`

**类型**: Class

**文件**: `src/Kernel/Reflection/Carrier/MethodAttributeCarrier.php:7`

## 继承关系

**实现**: `Hi\Kernel\Reflection\Carrier\CarrierInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$reflection` | `Hi\Kernel\Reflection\Carrier\ReflectionMethod` | public readonly | - |  |
| `$attribute` | `mixed` | public readonly | - |  |
| `$attributes` | `array` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\Reflection\Carrier\ReflectionMethod $reflection, mixed $attribute, array $attributes)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$reflection` | `Hi\Kernel\Reflection\Carrier\ReflectionMethod` | - |  |
| `$attribute` | `mixed` | - |  |
| `$attributes` | `array` | - | All attributes of the method |

**返回**: `void`

#### `isClass`

```php
public function isClass(): bool
```

**返回**: `bool`

#### `isMethod`

```php
public function isMethod(): bool
```

**返回**: `bool`

#### `isProperty`

```php
public function isProperty(): bool
```

**返回**: `bool`

