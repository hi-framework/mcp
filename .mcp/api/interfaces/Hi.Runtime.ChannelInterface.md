---
fqcn: Hi\Runtime\ChannelInterface
type: interface
namespace: Hi\Runtime
module: Runtime
file: src/Runtime/ChannelInterface.php
line: 7
---
# ChannelInterface

**命名空间**: `Hi\Runtime`

**类型**: Interface

**文件**: `src/Runtime/ChannelInterface.php:7`

## 方法

### Public 方法

#### `create`

```php
public function create(int $size = 0, array $options = []): Hi\Runtime\ChannelInstanceInterface
```

Create a new Channel instance

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$size` | `int` | 0 | The capacity size of the Channel, 0 means unlimited |
| `$options` | `array` | [] | The options for creating the Channel |

**返回**: `Hi\Runtime\ChannelInstanceInterface` - The Channel instance

**抛出异常**:

- `\InvalidArgumentException` - When the size parameter is invalid
- `\RuntimeException` - When the creation fails

#### `cleanup`

```php
public function cleanup(): void
```

Cleanup all channels
This method should be called when the application is shutting down

**返回**: `void`

