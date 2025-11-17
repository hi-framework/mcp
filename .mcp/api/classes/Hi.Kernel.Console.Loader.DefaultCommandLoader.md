---
fqcn: Hi\Kernel\Console\Loader\DefaultCommandLoader
type: class
namespace: Hi\Kernel\Console\Loader
module: Kernel
file: src/Kernel/Console/Loader/DefaultCommandLoader.php
line: 12
---
# DefaultCommandLoader

**命名空间**: `Hi\Kernel\Console\Loader`

**类型**: Class

**文件**: `src/Kernel/Console/Loader/DefaultCommandLoader.php:12`

## 继承关系

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
public function findCommand(string $name): ?Hi\Kernel\Console\Metadata\CommandMetadata
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `string` | - |  |

**返回**: `?Hi\Kernel\Console\Metadata\CommandMetadata`

#### `findAllCommands`

```php
public function findAllCommands(): Hi\Kernel\Console\Loader\Generator|array
```

**返回**: `Hi\Kernel\Console\Loader\Generator|array`

