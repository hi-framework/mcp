---
fqcn: Hi\Kernel\Console\Loader\ComposerCommandLoader
type: class
namespace: Hi\Kernel\Console\Loader
module: Kernel
file: src/Kernel/Console/Loader/ComposerCommandLoader.php
line: 32
---
# ComposerCommandLoader

**命名空间**: `Hi\Kernel\Console\Loader`

**类型**: Class

**文件**: `src/Kernel/Console/Loader/ComposerCommandLoader.php:32`

Load Hi-Framework specific commands from composer packages

Reads from vendor/composer/installed.json

Configuration structure:
{
  "extra": {
    "hi-framework": {
         "console": {
             "commands": [
                 "App\\Console\\Commands\\UserCommand",
             ]
         }
    }
  }
}

## 继承关系

**继承**: `Hi\Kernel\Composer\AbstractPackageScanner`

**实现**: `Hi\Kernel\Console\CommandLoaderInterface`

## 方法

### Public 方法

#### `getName`

```php
public function getName(): string
```

**返回**: `string`

#### `findCommand`

```php
public function findCommand(string $commandName): ?Hi\Kernel\Console\Metadata\CommandMetadata
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$commandName` | `string` | - |  |

**返回**: `?Hi\Kernel\Console\Metadata\CommandMetadata`

#### `findAllCommands`

```php
public function findAllCommands(): Hi\Kernel\Console\Loader\Generator|array
```

**返回**: `Hi\Kernel\Console\Loader\Generator|array`

