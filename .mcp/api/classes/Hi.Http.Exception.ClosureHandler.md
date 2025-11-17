---
fqcn: Hi\Http\Exception\ClosureHandler
type: class
namespace: Hi\Http\Exception
module: Http
file: src/Http/Exception/ClosureHandler.php
line: 9
---
# ClosureHandler

**命名空间**: `Hi\Http\Exception`

**类型**: Class

**文件**: `src/Http/Exception/ClosureHandler.php:9`

## 继承关系

**继承**: `Hi\Exception\ExceptionHandler`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$handler` | `mixed` | protected readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(mixed $handler)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `mixed` | - |  |

**返回**: `void`

#### `handle`

```php
public function handle(Hi\Http\Exception\Throwable $th, mixed $context = 'null'): mixed
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Http\Exception\Throwable` | - |  |
| `$context` | `mixed` | 'null' |  |

**返回**: `mixed`

#### `report`

```php
public function report(Hi\Http\Exception\Throwable $th, mixed $context = 'null'): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$th` | `Hi\Http\Exception\Throwable` | - |  |
| `$context` | `mixed` | 'null' |  |

**返回**: `void`

