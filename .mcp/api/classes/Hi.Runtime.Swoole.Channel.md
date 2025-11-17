---
fqcn: Hi\Runtime\Swoole\Channel
type: class
namespace: Hi\Runtime\Swoole
module: Runtime
file: src/Runtime/Swoole/Channel.php
line: 11
---
# Channel

**命名空间**: `Hi\Runtime\Swoole`

**类型**: Class

**文件**: `src/Runtime/Swoole/Channel.php:11`

## 继承关系

**实现**: `Hi\Runtime\ChannelInterface`

**使用 Traits**: `Hi\Runtime\Swoole\ExtensionCheckTrait`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$channels` | `array` | private | [] | Store created Channel instances |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct()
```

**返回**: `void`

#### `create`

```php
public function create(int $size = 0, array $options = []): Hi\Runtime\ChannelInstanceInterface
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$size` | `int` | 0 |  |
| `$options` | `array` | [] |  |

**返回**: `Hi\Runtime\ChannelInstanceInterface`

#### `cleanup`

```php
public function cleanup(): void
```

**返回**: `void`

