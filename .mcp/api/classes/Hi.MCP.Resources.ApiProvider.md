---
fqcn: Hi\MCP\Resources\ApiProvider
type: class
namespace: Hi\MCP\Resources
module: MCP
file: src/MCP/Resources/ApiProvider.php
line: 15
---
# ApiProvider

**命名空间**: `Hi\MCP\Resources`

**类型**: Class

**文件**: `src/MCP/Resources/ApiProvider.php:15`

API 资源提供者

提供 Hi Framework API 信息的查询和访问服务

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$extractor` | `Hi\MCP\Analyzers\ApiExtractor` | private | - |  |
| `$indexedModules` | `array` | private | [] |  |
| `$availableModules` | `array` | private | [] |  |
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

#### `buildIndex`

```php
public function buildIndex(?array $modules = 'null'): void
```

构建 API 索引

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$modules` | `?array` | 'null' |  |

**返回**: `void`

#### `getModuleApi`

```php
public function getModuleApi(string $moduleName, string $detailLevel = 'summary'): array
```

获取模块的 API 信息

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$moduleName` | `string` | - | 模块名称 |
| `$detailLevel` | `string` | 'summary' | 详细程度：'summary' 或 'full' |

**返回**: `array` - mixed> 模块 API 信息

#### `getClassApi`

```php
public function getClassApi(string $className, string $detailLevel = 'summary'): array
```

获取类的 API 信息

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | 完整的类名 |
| `$detailLevel` | `string` | 'summary' | 详细程度：'summary' 或 'full' |

**返回**: `array` - mixed> 类 API 信息

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

#### `listModules`

```php
public function listModules(): array
```

列出所有可用模块

**返回**: `array` - array<string, mixed>> 模块列表及状态

#### `listApiResources`

```php
public function listApiResources(): array
```

列出 API 资源

**返回**: `array` - array<string, mixed>> 资源列表

#### `readApiResource`

```php
public function readApiResource(string $uri): array
```

读取 API 资源

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$uri` | `string` | - | API 资源 URI（如 api://module/Cache） |

**返回**: `array` - mixed> 资源内容

#### `formatClassInfo`

```php
public function formatClassInfo(array $classInfo, bool $includeDetails = 'true'): string
```

格式化类信息为可读文本

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$classInfo` | `array` | - |  |
| `$includeDetails` | `bool` | 'true' |  |

**返回**: `string`

