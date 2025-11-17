---
fqcn: Hi\MCP\Cache\ApiCache
type: class
namespace: Hi\MCP\Cache
module: MCP
file: src/MCP/Cache/ApiCache.php
line: 12
---
# ApiCache

**命名空间**: `Hi\MCP\Cache`

**类型**: Class

**文件**: `src/MCP/Cache/ApiCache.php:12`

API 缓存

专门用于缓存 API 解析结果

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `CACHE_PREFIX_CLASS` | 'api_class_' | private |  |
| `CACHE_PREFIX_MODULE` | 'api_module_' | private |  |

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

#### `getClass`

```php
public function getClass(string $className): ?array
```

获取类信息缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | 完整的类名 |

**返回**: `?array` - mixed>|null

#### `setClass`

```php
public function setClass(string $className, array $classInfo): void
```

设置类信息缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - | 完整的类名 |
| `$classInfo` | `array` | - |  |

**返回**: `void`

#### `getModule`

```php
public function getModule(string $moduleName): ?array
```

获取模块 API 缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$moduleName` | `string` | - | 模块名称 |

**返回**: `?array` - array<string, mixed>>|null

#### `setModule`

```php
public function setModule(string $moduleName, array $moduleApi): void
```

设置模块 API 缓存

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$moduleName` | `string` | - | 模块名称 |
| `$moduleApi` | `array` | - |  |

**返回**: `void`

#### `hasClass`

```php
public function hasClass(string $className): bool
```

检查类缓存是否存在

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$className` | `string` | - |  |

**返回**: `bool`

#### `hasModule`

```php
public function hasModule(string $moduleName): bool
```

检查模块缓存是否存在

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$moduleName` | `string` | - |  |

**返回**: `bool`

#### `clear`

```php
public function clear(): void
```

清空 API 缓存

**返回**: `void`

