---
fqcn: Hi\Server\Server
type: class
namespace: Hi\Server
module: Server
file: src/Server/Server.php
line: 11
---
# Server

**命名空间**: `Hi\Server`

**类型**: Class

**文件**: `src/Server/Server.php:11`

**修饰符**: abstract

## 继承关系

**实现**: `Hi\Server\ServerInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$config` | `Hi\Server\Config` | protected | - |  |
| `$processes` | `array` | protected | [] |  |
| `$exceptionHandler` | `?Hi\Exception\ExceptionHandlerInterface` | protected | 'null' |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $config = [], ?Hi\Exception\ExceptionHandlerInterface $exceptionHandler = 'null', Psr\Log\LoggerInterface $logger = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | [] |  |
| `$exceptionHandler` | `?Hi\Exception\ExceptionHandlerInterface` | 'null' |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |

**返回**: `void`

#### `withHost`

```php
public function withHost(string $host): Hi\Server\ServerInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$host` | `string` | - |  |

**返回**: `Hi\Server\ServerInterface`

#### `withPort`

```php
public function withPort(int $port): Hi\Server\ServerInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$port` | `int` | - |  |

**返回**: `Hi\Server\ServerInterface`

#### `addCustomProcess`

```php
public function addCustomProcess(mixed $process): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$process` | `mixed` | - |  |

**返回**: `void`

#### `task`

```php
public function task(string $taskClass, mixed $data = 'null'): int|false
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$taskClass` | `string` | - |  |
| `$data` | `mixed` | 'null' |  |

**返回**: `int|false`

