---
fqcn: Hi\Runtime\ContextInterface
type: interface
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/ContextInterface.php
line: 10
---
# ContextInterface

**命名空间**: `Hi\Runtime`

**类型**: Interface

**文件**: `src/Runtime/ContextInterface.php:10`

Coroutine context interface

## 继承关系

**继承**: `Hi\Runtime\ArrayAccess`

## 方法

### Public 方法

#### `get`

```php
public function get(string $key): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `mixed`

#### `set`

```php
public function set(string $key, mixed $value): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `void`

#### `unset`

```php
public function unset(string $key): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `void`

