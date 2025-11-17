---
fqcn: Hi\Http\Loader\DefaultHttpLoader
type: class
namespace: Hi\Http\Loader
module: Http
file: src/Http/Loader/DefaultHttpLoader.php
line: 18
---
# DefaultHttpLoader

**命名空间**: `Hi\Http\Loader`

**类型**: Class

**文件**: `src/Http/Loader/DefaultHttpLoader.php:18`

Default HTTP Loader

Empty implementation of HttpLoaderInterface that returns no routes or middlewares.
Used as a safe default when no specific loaders are configured.
Maintains interface compatibility without performing any actual loading.

## 继承关系

**实现**: `Hi\Http\HttpLoaderInterface`

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
public function findAllRoutes(): Hi\Http\Loader\Generator|array
```

Get all routes - returns empty array

**返回**: `Hi\Http\Loader\Generator|array`

#### `findAllMiddlewares`

```php
public function findAllMiddlewares(): Hi\Http\Loader\Generator|array
```

Get all middlewares - returns empty array

**返回**: `Hi\Http\Loader\Generator|array`

