---
fqcn: Hi\Server\Control
type: class
namespace: Hi\Server
module: Server
file: src/Server/Control.php
line: 12
---
# Control

**命名空间**: `Hi\Server`

**类型**: Class

**文件**: `src/Server/Control.php:12`

**修饰符**: abstract

待重新使用.

## 继承关系

**实现**: `Hi\Server\ServerInterface`

**使用 Traits**: `Hi\Server\Traits\ProcessTrait`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$config` | `Hi\Server\Config` | protected | - | Server config. |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $config = [])
```

Construct.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | [] |  |

**返回**: `void`

#### `getConfig`

```php
public function getConfig(): Hi\Server\Config
```

**返回**: `Hi\Server\Config`

#### `withHost`

```php
public function withHost(string $host): self
```

设置服务 host.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$host` | `string` | - |  |

**返回**: `self`

#### `withPort`

```php
public function withPort(int $port): self
```

设置服务 port.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$port` | `int` | - |  |

**返回**: `self`

#### `reload`

```php
public function reload(): void
```

平滑重启服务

**返回**: `void`

#### `stop`

```php
public function stop(): void
```

平滑停止服务

**返回**: `void`

#### `shutdown`

```php
public function shutdown(): void
```

强制停止服务(强制杀掉服务相关所有进程).

**返回**: `void`

