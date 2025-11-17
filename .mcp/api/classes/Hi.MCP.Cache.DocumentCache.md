---
fqcn: Hi\MCP\Cache\DocumentCache
type: class
namespace: Hi\MCP\Cache
module: MCP
file: src/MCP/Cache/DocumentCache.php
line: 13
---
# DocumentCache

**命名空间**: `Hi\MCP\Cache`

**类型**: Class

**文件**: `src/MCP/Cache/DocumentCache.php:13`

文档缓存

专门用于缓存文档索引数据
支持基于文件修改时间的自动失效

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `CACHE_KEY_INDEX` | 'doc_index' | private |  |
| `CACHE_KEY_INVERTED_INDEX` | 'doc_inverted_index' | private |  |
| `CACHE_KEY_MTIME` | 'doc_mtime' | private |  |

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$cache` | `Hi\MCP\Cache\CacheInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\MCP\Cache\CacheInterface $cache)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$cache` | `Hi\MCP\Cache\CacheInterface` | - |  |

**返回**: `void`

#### `getIndex`

```php
public function getIndex(): ?array
```

获取文档索引缓存

**返回**: `?array` - array<string, mixed>>|null

#### `setIndex`

```php
public function setIndex(array $index): void
```

设置文档索引缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$index` | `array` | - |  |

**返回**: `void`

#### `getInvertedIndex`

```php
public function getInvertedIndex(): ?array
```

获取倒排索引缓存

**返回**: `?array` - array<int, int>>|null

#### `setInvertedIndex`

```php
public function setInvertedIndex(array $invertedIndex): void
```

设置倒排索引缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$invertedIndex` | `array` | - |  |

**返回**: `void`

#### `getMtimeCache`

```php
public function getMtimeCache(): ?array
```

获取文件修改时间戳缓存

**返回**: `?array` - int>|null

#### `setMtimeCache`

```php
public function setMtimeCache(array $mtimes): void
```

设置文件修改时间戳缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$mtimes` | `array` | - |  |

**返回**: `void`

#### `isValid`

```php
public function isValid(string $docsPath): bool
```

检查缓存是否有效

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$docsPath` | `string` | - | 文档目录路径 |

**返回**: `bool`

#### `clear`

```php
public function clear(): void
```

清空文档缓存

**返回**: `void`

