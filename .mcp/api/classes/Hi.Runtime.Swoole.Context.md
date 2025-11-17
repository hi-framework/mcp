---
fqcn: Hi\Runtime\Swoole\Context
type: class
namespace: Hi\Runtime\Swoole
module: Runtime
file: src/Runtime/Swoole/Context.php
line: 15
---
# Context

**命名空间**: `Hi\Runtime\Swoole`

**类型**: Class

**文件**: `src/Runtime/Swoole/Context.php:15`

Swoole 协程上下文实现

包装 Swoole\Coroutine::getContext() 返回的上下文对象，
使其符合 ContextInterface 接口规范

## 继承关系

**实现**: `Hi\Runtime\ContextInterface`

**使用 Traits**: `Hi\Runtime\Swoole\ExtensionCheckTrait`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$context` | `mixed` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(mixed $context)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$context` | `mixed` | - |  |

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

#### `offsetExists`

```php
public function offsetExists(mixed $offset): bool
```

检查键是否存在

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `mixed` | - |  |

**返回**: `bool`

#### `offsetGet`

```php
public function offsetGet(mixed $offset): mixed
```

获取值（ArrayAccess 接口）

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `mixed` | - |  |

**返回**: `mixed`

#### `offsetSet`

```php
public function offsetSet(mixed $offset, mixed $value): void
```

设置值（ArrayAccess 接口）

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

删除值（ArrayAccess 接口）

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$offset` | `mixed` | - |  |

**返回**: `void`

#### `toArray`

```php
public function toArray(): array
```

获取所有上下文数据

**返回**: `array`

#### `clear`

```php
public function clear(): void
```

清空所有上下文数据

**返回**: `void`

#### `isEmpty`

```php
public function isEmpty(): bool
```

检查上下文是否为空

**返回**: `bool`

#### `count`

```php
public function count(): int
```

获取上下文数据数量

**返回**: `int`

