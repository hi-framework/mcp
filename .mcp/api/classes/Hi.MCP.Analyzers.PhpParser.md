---
fqcn: Hi\MCP\Analyzers\PhpParser
type: class
namespace: Hi\MCP\Analyzers
module: MCP
file: src/MCP/Analyzers/PhpParser.php
line: 12
---
# PhpParser

**命名空间**: `Hi\MCP\Analyzers`

**类型**: Class

**文件**: `src/MCP/Analyzers/PhpParser.php:12`

PHP 代码解析器

使用 PHP Reflection API 解析类的结构和元数据

## 方法

### Public 方法

#### `parseClass`

```php
public function parseClass(string $className): array
```

解析类信息

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | 完整的类名（包含命名空间） |

**返回**: `array` - mixed> 类的详细信息

**抛出异常**:

- `\ReflectionException` - 当类不存在时

#### `getClassDescription`

```php
public function getClassDescription(string $className): ?string
```

获取类的简短描述

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - |  |

**返回**: `?string`

