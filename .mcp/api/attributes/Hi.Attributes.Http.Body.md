---
fqcn: Hi\Attributes\Http\Body
type: class
namespace: Hi\Attributes\Http
module: Attributes
file: src/Attributes/Http/Body.php
line: 10
---
# Body

**命名空间**: `Hi\Attributes\Http`

**类型**: Class

**文件**: `src/Attributes/Http/Body.php:10`

HTTP request input parameter attribute.

## 继承关系

**继承**: `Hi\Attributes\Http\Parameter`

## 方法

### Public 方法

#### `parseSource`

```php
public function parseSource(): array
```

**返回**: `array` - string, path: string[]}

## Attribute 信息

**目标**: PROPERTY

**可重复**: 否

### 使用示例

```php
#[Body]
class MyClass {}
```

