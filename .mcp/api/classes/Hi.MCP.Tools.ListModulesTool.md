---
fqcn: Hi\MCP\Tools\ListModulesTool
type: class
namespace: Hi\MCP\Tools
module: MCP
file: src/MCP/Tools/ListModulesTool.php
line: 14
---
# ListModulesTool

**命名空间**: `Hi\MCP\Tools`

**类型**: Class

**文件**: `src/MCP/Tools/ListModulesTool.php:14`

列出模块工具

列出 Hi Framework 所有可用模块

## 继承关系

**继承**: `Hi\MCP\Tools\AbstractTool`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$docProvider` | `Hi\MCP\Resources\DocumentationProvider` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\MCP\Resources\DocumentationProvider $docProvider)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$docProvider` | `Hi\MCP\Resources\DocumentationProvider` | - |  |

**返回**: `void`

#### `getName`

```php
public function getName(): string
```

**返回**: `string`

#### `getDescription`

```php
public function getDescription(): string
```

**返回**: `string`

#### `getInputSchema`

```php
public function getInputSchema(): array
```

**返回**: `array`

#### `execute`

```php
public function execute(array $arguments): string
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$arguments` | `array` | - |  |

**返回**: `string`

