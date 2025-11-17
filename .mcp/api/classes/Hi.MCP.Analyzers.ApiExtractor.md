---
fqcn: Hi\MCP\Analyzers\ApiExtractor
type: class
namespace: Hi\MCP\Analyzers
module: MCP
file: src/MCP/Analyzers/ApiExtractor.php
line: 14
---
# ApiExtractor

**命名空间**: `Hi\MCP\Analyzers`

**类型**: Class

**文件**: `src/MCP/Analyzers/ApiExtractor.php:14`

API 信息提取器

负责扫描 PHP 源码目录，提取类和接口的 API 信息

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$parser` | `Hi\MCP\Analyzers\PhpParser` | private | - |  |
| `$classCache` | `array` | private | [] |  |
| `$cache` | `?Hi\MCP\Cache\ApiCache` | private | 'null' |  |
| `$frameworkPath` | `string` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $frameworkPath, ?Hi\MCP\Cache\ApiCache $cache = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$frameworkPath` | `string` | - |  |
| `$cache` | `?Hi\MCP\Cache\ApiCache` | 'null' |  |

**返回**: `void`

#### `extractModuleApi`

```php
public function extractModuleApi(string $moduleName): array
```

扫描模块的所有类

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$moduleName` | `string` | - | 模块名称，如 "Cache"、"Database" |

**返回**: `array` - array<string, mixed>> 类信息列表

#### `extractClassInfo`

```php
public function extractClassInfo(string $className): ?array
```

提取单个类的信息

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | 完整的类名 |

**返回**: `?array` - mixed>|null 类信息，如果类不存在则返回 null

#### `searchApi`

```php
public function searchApi(string $query): array
```

搜索 API

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$query` | `string` | - | 搜索关键词 |

**返回**: `array` - array<string, mixed>> 搜索结果

#### `listScannedModules`

```php
public function listScannedModules(): array
```

列出所有已扫描的模块

**返回**: `array` - string> 模块名称列表

#### `getModuleClassList`

```php
public function getModuleClassList(string $moduleName): array
```

获取模块的类列表（简化信息）

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$moduleName` | `string` | - | 模块名称 |

**返回**: `array` - array<string, mixed>> 类摘要列表

#### `clearCache`

```php
public function clearCache(): void
```

清空缓存

**返回**: `void`

