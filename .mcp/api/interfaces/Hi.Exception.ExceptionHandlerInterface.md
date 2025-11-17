---
fqcn: Hi\Exception\ExceptionHandlerInterface
type: interface
namespace: Hi\Exception
module: Exception
file: src/Exception/ExceptionHandlerInterface.php
line: 7
---
# ExceptionHandlerInterface

**命名空间**: `Hi\Exception`

**类型**: Interface

**文件**: `src/Exception/ExceptionHandlerInterface.php:7`

## 继承关系

**继承**: `Hi\Exception\ExceptionReporterInterface`

## 方法

### Public 方法

#### `register`

```php
public function register(): void
```

Enable global exception handling.

**返回**: `void`

#### `handleGlobalException`

```php
public function handleGlobalException(Hi\Exception\Throwable $e): void
```

Handle global exception outside (a Dispatcher) and output error to the user.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$e` | `Hi\Exception\Throwable` | - |  |

**返回**: `void`

#### `handle`

```php
public function handle(Hi\Exception\Throwable $th, mixed $context = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Exception\Throwable` | - |  |
| `$context` | `mixed` | 'null' |  |

**返回**: `mixed`

