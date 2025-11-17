---
fqcn: Hi\Telemetry\SpanInterface
type: interface
namespace: Hi\Telemetry
module: Telemetry
file: src/Telemetry/SpanInterface.php
line: 9
---
# SpanInterface

**命名空间**: `Hi\Telemetry`

**类型**: Interface

**文件**: `src/Telemetry/SpanInterface.php:9`

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

Get the current span name.

**返回**: `string`

#### `updateName`

```php
public function updateName(string $name): self
```

Update the current span name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `self`

#### `setStatus`

```php
public function setStatus(string|int $code, string $description = 'null'): self
```

Set a status for the current span.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$code` | `string\|int` | - |  |
| `$description` | `string` | 'null' |  |

**返回**: `self`

#### `getStatus`

```php
public function getStatus(): ?Hi\Telemetry\Span\Status
```

Get the current span status.

**返回**: `?Hi\Telemetry\Span\Status`

#### `getAttributes`

```php
public function getAttributes(): array
```

Get the current span attributes.

**返回**: `array`

#### `setAttributes`

```php
public function setAttributes(array $attributes): self
```

Set the current span attributes.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attributes` | `array` | - |  |

**返回**: `self`

#### `setAttribute`

```php
public function setAttribute(string $name, mixed $value): self
```

Set the current span attribute.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `self`

#### `hasAttribute`

```php
public function hasAttribute(string $name): bool
```

Check if the current span has an attribute with given name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `getAttribute`

```php
public function getAttribute(string $name): mixed
```

Set the current span attribute by given name.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `mixed`

