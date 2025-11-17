---
fqcn: Hi\Kernel\ConfigInterface
type: interface
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/ConfigInterface.php
line: 7
---
# ConfigInterface

**命名空间**: `Hi\Kernel`

**类型**: Interface

**文件**: `src/Kernel/ConfigInterface.php:7`

## 方法

### Public 方法

#### `has`

```php
public function has(string $key): bool
```

Check config key exists (supports dot notation).

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `bool`

#### `set`

```php
public function set(string $key, mixed $value): self
```

Set value by key (supports dot notation).

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `self`

#### `forget`

```php
public function forget(string $key): self
```

Remove value by key (supports dot notation). No-op if not exists.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `self`

#### `merge`

```php
public function merge(array $config): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `self`

#### `get`

```php
public function get(string $key, mixed $defaultValue = 'null'): mixed
```

Return config value by key.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - | Config key, like "application.name" |
| `$defaultValue` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `getOrFail`

```php
public function getOrFail(string $key): mixed
```

Get required value by key or throw exception.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$key` | `string` | - |  |

**返回**: `mixed`

**抛出异常**:

- `Exception\ConfigKeyNotFoundException`

#### `toArray`

```php
public function toArray(): array
```

Return all config.

**返回**: `array`

#### `lock`

```php
public function lock(): self
```

Lock the config. After locking, the config cannot be modified.

**返回**: `self`

