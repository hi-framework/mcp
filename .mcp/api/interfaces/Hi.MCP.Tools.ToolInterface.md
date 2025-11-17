---
fqcn: Hi\MCP\Tools\ToolInterface
type: interface
namespace: Hi\MCP\Tools
module: MCP
file: src/MCP/Tools/ToolInterface.php
line: 12
---
# ToolInterface

**命名空间**: `Hi\MCP\Tools`

**类型**: Interface

**文件**: `src/MCP/Tools/ToolInterface.php:12`

MCP 工具接口

定义所有 MCP 工具必须实现的方法

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

获取工具名称

**返回**: `string`

#### `getDescription`

```php
public function getDescription(): string
```

获取工具描述

**返回**: `string`

#### `getInputSchema`

```php
public function getInputSchema(): array
```

获取工具输入模式（JSON Schema）

**返回**: `array` - mixed>

#### `execute`

```php
public function execute(array $arguments): string
```

执行工具

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$arguments` | `array` | - |  |

**返回**: `string` - 执行结果（文本格式）

