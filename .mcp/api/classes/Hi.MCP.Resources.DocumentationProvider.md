---
fqcn: Hi\MCP\Resources\DocumentationProvider
type: class
namespace: Hi\MCP\Resources
module: MCP
file: src/MCP/Resources/DocumentationProvider.php
line: 14
---
# DocumentationProvider

**命名空间**: `Hi\MCP\Resources`

**类型**: Class

**文件**: `src/MCP/Resources/DocumentationProvider.php:14`

文档资源提供者

负责扫描、索引和提供 Hi Framework 的文档资源

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$documents` | `array` | private | [] |  |
| `$invertedIndex` | `array` | private | [] |  |
| `$fileMtimes` | `array` | private | [] |  |
| `$cache` | `?Hi\MCP\Cache\DocumentCache` | private | 'null' |  |
| `$frameworkPath` | `string` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(string $frameworkPath, ?Hi\MCP\Cache\DocumentCache $cache = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$frameworkPath` | `string` | - |  |
| `$cache` | `?Hi\MCP\Cache\DocumentCache` | 'null' |  |

**返回**: `void`

#### `buildIndex`

```php
public function buildIndex(): void
```

构建文档索引

**返回**: `void`

#### `listDocuments`

```php
public function listDocuments(): array
```

列出所有文档

**返回**: `array` - array{path: string, name: string, description: string}>

#### `readDocument`

```php
public function readDocument(string $path): string
```

读取文档内容

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$path` | `string` | - |  |

**返回**: `string`

#### `searchDocuments`

```php
public function searchDocuments(string $query, ?string $module = 'null'): array
```

搜索文档

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$query` | `string` | - |  |
| `$module` | `?string` | 'null' |  |

**返回**: `array` - array{path: string, name: string, description: string, matches?: string}>

#### `listModules`

```php
public function listModules(): array
```

列出所有模块

**返回**: `array` - array{name: string, description: string}>

