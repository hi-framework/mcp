---
fqcn: Hi\Event\Exception\InvalidEventMetadataException
type: class
namespace: Hi\Event\Exception
module: Event
file: src/Event/Exception/InvalidEventMetadataException.php
line: 12
---
# InvalidEventMetadataException

**命名空间**: `Hi\Event\Exception`

**类型**: Class

**文件**: `src/Event/Exception/InvalidEventMetadataException.php:12`

Invalid event metadata exception

Thrown when event metadata is invalid or incomplete

## 继承关系

**继承**: `Hi\Event\Exception\EventException`

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $message = '', int $code = 0, ?Hi\Event\Exception\Throwable $previous = 'null')
```

Create exception for invalid metadata

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$message` | `string` | '' | Exception message |
| `$code` | `int` | 0 | Exception code |
| `$previous` | `?Hi\Event\Exception\Throwable` | 'null' | Previous exception |

**返回**: `void`

#### `eventClassNotExists`

**标记**: static

```php
public static function eventClassNotExists(string $className): self
```

Create exception for missing event class

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - |  |

**返回**: `self`

#### `listenerMethodNotAccessible`

**标记**: static

```php
public static function listenerMethodNotAccessible(string $className, string $methodName): self
```

Create exception for missing listener method

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - |  |
| `$methodName` | `string` | - |  |

**返回**: `self`

#### `incompleteConfiguration`

**标记**: static

```php
public static function incompleteConfiguration(string $property, string $context): self
```

Create exception for incomplete configuration

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$property` | `string` | - |  |
| `$context` | `string` | - |  |

**返回**: `self`

#### `invalidPriority`

**标记**: static

```php
public static function invalidPriority(int $priority): self
```

Create exception for invalid priority

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$priority` | `int` | - |  |

**返回**: `self`

#### `invalidRetryConfig`

**标记**: static

```php
public static function invalidRetryConfig(string $field, mixed $value): self
```

Create exception for invalid retry configuration

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$field` | `string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `self`

#### `attributeValidationFailed`

**标记**: static

```php
public static function attributeValidationFailed(string $className, string $methodName, string $error): self
```

Create exception for attribute validation failure

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - |  |
| `$methodName` | `string` | - |  |
| `$error` | `string` | - |  |

**返回**: `self`

