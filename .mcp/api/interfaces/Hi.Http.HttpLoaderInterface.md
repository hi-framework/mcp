---
fqcn: Hi\Http\HttpLoaderInterface
type: interface
namespace: Hi\Http
module: Http
file: src/Http/HttpLoaderInterface.php
line: 16
---
# HttpLoaderInterface

**命名空间**: `Hi\Http`

**类型**: Interface

**文件**: `src/Http/HttpLoaderInterface.php:16`

Http loader interface

Unified loader contract for HTTP system components
Based on EventLoaderInterface architecture pattern

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

Get loader name

**返回**: `string`

#### `findAllRoutes`

```php
public function findAllRoutes(): Hi\Http\Generator|array
```

Get all routes

**返回**: `Hi\Http\Generator|array` - Route metadata array

#### `findAllMiddlewares`

```php
public function findAllMiddlewares(): Hi\Http\Generator|array
```

Get all middlewares

**返回**: `Hi\Http\Generator|array` - All middleware metadata

