---
fqcn: Hi\Kernel\Logger\LoggerFactory
type: class
namespace: Hi\Kernel\Logger
module: Kernel
file: src/Kernel/Logger/LoggerFactory.php
line: 12
---
# LoggerFactory

**命名空间**: `Hi\Kernel\Logger`

**类型**: Class

**文件**: `src/Kernel/Logger/LoggerFactory.php:12`

## 继承关系

**实现**: `Hi\Kernel\Logger\LoggerFactoryInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$channels` | `array` | protected | [] |  |
| `$defaultLevel` | `string` | protected | 'info' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $defaultLevel = 'info')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$defaultLevel` | `string` | 'info' |  |

**返回**: `void`

#### `get`

```php
public function get(?string $channel = 'null', string $level = '', bool $newLogger = 'true'): Psr\Log\LoggerInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$channel` | `?string` | 'null' |  |
| `$level` | `string` | '' |  |
| `$newLogger` | `bool` | 'true' |  |

**返回**: `Psr\Log\LoggerInterface`

#### `set`

```php
public function set(string $channel, Psr\Log\LoggerInterface $logger): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$channel` | `string` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |

**返回**: `void`

#### `has`

```php
public function has(string $channel): bool
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$channel` | `string` | - |  |

**返回**: `bool`

### Protected 方法

#### `createLogger`

```php
protected function createLogger(string $channel, string $level): Psr\Log\LoggerInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$channel` | `string` | - |  |
| `$level` | `string` | - |  |

**返回**: `Psr\Log\LoggerInterface`

