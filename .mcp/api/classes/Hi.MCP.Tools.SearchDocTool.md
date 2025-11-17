---
fqcn: Hi\MCP\Tools\SearchDocTool
type: class
namespace: Hi\MCP\Tools
module: MCP
file: src/MCP/Tools/SearchDocTool.php
line: 14
---
# SearchDocTool

**命名空间**: `Hi\MCP\Tools`

**类型**: Class

**文件**: `src/MCP/Tools/SearchDocTool.php:14`

搜索文档工具

搜索 Hi Framework 使用文档

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

