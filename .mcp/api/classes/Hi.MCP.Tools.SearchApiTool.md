---
fqcn: Hi\MCP\Tools\SearchApiTool
type: class
namespace: Hi\MCP\Tools
module: MCP
file: src/MCP/Tools/SearchApiTool.php
line: 14
---
# SearchApiTool

**命名空间**: `Hi\MCP\Tools`

**类型**: Class

**文件**: `src/MCP/Tools/SearchApiTool.php:14`

搜索 API 工具

搜索 Hi Framework API（类名、方法名）

## 继承关系

**继承**: `Hi\MCP\Tools\AbstractTool`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$apiProvider` | `Hi\MCP\Resources\ApiProvider` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\MCP\Resources\ApiProvider $apiProvider)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$apiProvider` | `Hi\MCP\Resources\ApiProvider` | - |  |

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

