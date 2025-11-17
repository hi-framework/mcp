---
fqcn: Hi\Http\Loader\ComposerHttpLoader
type: class
namespace: Hi\Http\Loader
module: Http
file: src/Http/Loader/ComposerHttpLoader.php
line: 44
---
# ComposerHttpLoader

**命名空间**: `Hi\Http\Loader`

**类型**: Class

**文件**: `src/Http/Loader/ComposerHttpLoader.php:44`

Composer HTTP Loader

Discovers HTTP routes and middlewares from third-party packages via composer.json extra configuration
Uses direct file path approach for efficient discovery without class name conversion
Scans all installed packages for hi-framework.http configuration

Configuration structure:
{
  "extra": {
    "hi-framework": {
      "http": {
        "routes": { "files": [ "src/Http/Routes/UserRoute.php" ], "dirs": [ "src/Http/Routes" ] },
        "middlewares": { "files": [ "src/Http/Middleware/UserMiddleware.php" ], "dirs": [ "src/Http/Middleware" ] }
      }
    }
  }
}

The format supports:
- "files": Array of relative file paths to specific route/middleware classes
- "dirs": Array of relative directories to scan for PHP files

All paths are resolved relative to the package installation directory.
Uses HttpAttributeLoader to discover actual routes and middlewares from the files.

Extends AbstractPackageScanner to reuse framework infrastructure for package scanning

## 继承关系

**继承**: `Hi\Kernel\Composer\AbstractPackageScanner`

**实现**: `Hi\Http\HttpLoaderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | protected | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\DirectoriesInterface $directories, Psr\Log\LoggerInterface $logger, Psr\Container\ContainerInterface $container, ?Hi\Kernel\Composer\ComposerExtraReaderInterface $composerExtraReader = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `Hi\Kernel\DirectoriesInterface` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$composerExtraReader` | `?Hi\Kernel\Composer\ComposerExtraReaderInterface` | 'null' |  |

**返回**: `void`

#### `getName`

```php
public function getName(): string
```

**返回**: `string`

#### `findAllRoutes`

```php
public function findAllRoutes(): Hi\Http\Loader\Generator|array
```

**返回**: `Hi\Http\Loader\Generator|array`

#### `findAllMiddlewares`

```php
public function findAllMiddlewares(): Hi\Http\Loader\Generator|array
```

**返回**: `Hi\Http\Loader\Generator|array`

