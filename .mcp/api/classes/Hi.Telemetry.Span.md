---
fqcn: Hi\Telemetry\Span
type: class
namespace: Hi\Telemetry
module: Telemetry
file: src/Telemetry/Span.php
line: 12
---
# Span

**命名空间**: `Hi\Telemetry`

**类型**: Class

**文件**: `src/Telemetry/Span.php:12`

## 继承关系

**实现**: `Hi\Telemetry\SpanInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$status` | `?Hi\Telemetry\Span\Status` | private | 'null' |  |
| `$name` | `string` | private | - |  |
| `$attributes` | `array` | private | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $name, array $attributes = [])
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |
| `$attributes` | `array` | [] |  |

**返回**: `void`

#### `getName`

```php
public function getName(): string
```

**返回**: `string`

#### `updateName`

```php
public function updateName(string $name): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `self`

#### `getAttributes`

```php
public function getAttributes(): array
```

**返回**: `array`

#### `setAttributes`

```php
public function setAttributes(array $attributes): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attributes` | `array` | - |  |

**返回**: `self`

#### `setAttribute`

```php
public function setAttribute(string $name, mixed $value): self
```

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

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `bool`

#### `getAttribute`

```php
public function getAttribute(string $name): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `mixed`

#### `setStatus`

```php
public function setStatus(string|int $code, string $description = 'null'): self
```

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

**返回**: `?Hi\Telemetry\Span\Status`

