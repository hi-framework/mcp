---
fqcn: Hi\Event\Loader\ComposerEventLoader
type: class
namespace: Hi\Event\Loader
module: Event
file: src/Event/Loader/ComposerEventLoader.php
line: 44
---
# ComposerEventLoader

**命名空间**: `Hi\Event\Loader`

**类型**: Class

**文件**: `src/Event/Loader/ComposerEventLoader.php:44`

Composer Event Loader

Discovers events and listeners from third-party packages via composer.json extra configuration
Uses direct file path approach for efficient discovery without class name conversion
Scans all installed packages for hi-framework.events configuration

Configuration structure:
{
  "extra": {
    "hi-framework": {
      "events": {
        "events": { "files": [ "src/Event/UserRegisteredEvent.php" ], "dirs": [ "src/Event" ] },
        "listeners": { "files": [ "src/Listener/UserRegisteredListener.php" ], "dirs": [ "src/Listener" ] },
        "subscribers": { "files": [ "src/Subscriber/UserRegisteredSubscriber.php" ], "dirs": [ "src/Subscriber" ] }
      }
    }
  }
}

The new format supports:
- "files": Array of relative file paths to specific event/listener/subscriber classes
- "dirs": Array of relative directories to scan for PHP files

All paths are resolved relative to the package installation directory.
Uses EventAttributeLoader to discover actual events and listeners from the files.

Extends AbstractPackageScanner to reuse framework infrastructure for package scanning

## 继承关系

**继承**: `Hi\Kernel\Composer\AbstractPackageScanner`

**实现**: `Hi\Event\Loader\EventLoaderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | private readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\DirectoriesInterface $directories, Psr\Container\ContainerInterface $container, Psr\Log\LoggerInterface $logger = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `Hi\Kernel\DirectoriesInterface` | - |  |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |

**返回**: `void`

#### `getName`

```php
public function getName(): string
```

**返回**: `string`

#### `findEvent`

```php
public function findEvent(string $name): ?Hi\Event\Metadata\EventMetadata
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Event\Metadata\EventMetadata`

#### `findAllEvents`

```php
public function findAllEvents(): Hi\Event\Loader\Generator|array
```

**返回**: `Hi\Event\Loader\Generator|array`

#### `findListeners`

```php
public function findListeners(string $eventType): Hi\Event\Loader\Generator|array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$eventType` | `string` | - |  |

**返回**: `Hi\Event\Loader\Generator|array`

#### `findAllListeners`

```php
public function findAllListeners(): Hi\Event\Loader\Generator|array
```

**返回**: `Hi\Event\Loader\Generator|array`

