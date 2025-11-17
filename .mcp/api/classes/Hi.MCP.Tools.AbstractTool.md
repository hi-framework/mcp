---
fqcn: Hi\MCP\Tools\AbstractTool
type: class
namespace: Hi\MCP\Tools
module: MCP
file: src/MCP/Tools/AbstractTool.php
line: 12
---
# AbstractTool

**命名空间**: `Hi\MCP\Tools`

**类型**: Class

**文件**: `src/MCP/Tools/AbstractTool.php:12`

**修饰符**: abstract

MCP 工具抽象基类

提供工具的通用实现

## 继承关系

**实现**: `Hi\MCP\Tools\ToolInterface`

## 方法

### Protected 方法

#### `validateRequired`

```php
protected function validateRequired(array $arguments, array $required): void
```

验证必需参数

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$arguments` | `array` | - |  |
| `$required` | `array` | - |  |

**返回**: `void`

**抛出异常**:

- `\InvalidArgumentException`

#### `getArgument`

```php
protected function getArgument(array $arguments, string $key, mixed $default = 'null'): mixed
```

获取参数值，如果不存在则返回默认值

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$arguments` | `array` | - |  |
| `$key` | `string` | - |  |
| `$default` | `mixed` | 'null' |  |

**返回**: `mixed`

