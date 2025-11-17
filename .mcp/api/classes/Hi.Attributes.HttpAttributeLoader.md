---
fqcn: Hi\Attributes\HttpAttributeLoader
type: class
namespace: Hi\Attributes
module: Attributes
file: src/Attributes/HttpAttributeLoader.php
line: 26
---
# HttpAttributeLoader

**命名空间**: `Hi\Attributes`

**类型**: Class

**文件**: `src/Attributes/HttpAttributeLoader.php:26`

Http attribute loader

Discovers HTTP route and middleware definitions through PHP 8+ attributes.
Inherits AwesomeAttributeLoader to reuse reflection capabilities and follows Hi Framework patterns.

## 继承关系

**继承**: `Hi\Attributes\AwesomeAttributeLoader`

**实现**: `Hi\Http\HttpLoaderInterface`

## 常量

| 名称 | 值 | 可见性 | 描述 |
| --- | --- | --- | --- |
| `ANY_METHOD` | 'ANY' | protected | router supported methods |
| `SUPPORTED_METHODS` | [] | protected |  |
| `CORS_METHOD` | 'OPTIONS' | protected |  |

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
public function findAllRoutes(): Hi\Attributes\Generator
```

Get all routes

**返回**: `Hi\Attributes\Generator`

#### `findAllMiddlewares`

```php
public function findAllMiddlewares(): Hi\Attributes\Generator
```

Get all middlewares

**返回**: `Hi\Attributes\Generator`

