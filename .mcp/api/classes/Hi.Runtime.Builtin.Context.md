---
fqcn: Hi\Runtime\Builtin\Context
type: class
namespace: Hi\Runtime\Builtin
module: Runtime
file: src/Runtime/Builtin/Context.php
line: 12
---
# Context

**命名空间**: `Hi\Runtime\Builtin`

**类型**: Class

**文件**: `src/Runtime/Builtin/Context.php:12`

内置运行时上下文实现

## 继承关系

**实现**: `Hi\Runtime\ContextInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$data` | `array` | private | [] |  |

## 方法

### Public 方法

#### `offsetExists`

```php
public function offsetExists(mixed $offset): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `mixed` | - |  |

**返回**: `bool`

#### `offsetGet`

```php
public function offsetGet(mixed $offset): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `mixed` | - |  |

**返回**: `mixed`

#### `offsetSet`

```php
public function offsetSet(mixed $offset, mixed $value): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `mixed` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `void`

#### `offsetUnset`

```php
public function offsetUnset(mixed $offset): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `mixed` | - |  |

**返回**: `void`

#### `get`

```php
public function get(string $key): mixed
```

获取上下文值

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `mixed`

#### `set`

```php
public function set(string $key, mixed $value): void
```

设置上下文值

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

删除上下文值

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `void`

