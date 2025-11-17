---
fqcn: Hi\Attributes\ConsoleAttributeLoader
type: class
namespace: Hi\Attributes
module: Attributes
file: src/Attributes/ConsoleAttributeLoader.php
line: 20
---
# ConsoleAttributeLoader

**命名空间**: `Hi\Attributes`

**类型**: Class

**文件**: `src/Attributes/ConsoleAttributeLoader.php:20`

## 继承关系

**实现**: `Hi\Kernel\Console\CommandLoaderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$attributeLoader` | `Hi\Kernel\Reflection\AttributeLoaderInterface` | protected readonly | - |  |
| `$files` | `array` | protected | [] |  |
| `$directories` | `array` | protected | [] |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $directories = [], Psr\Log\LoggerInterface $logger = '...', ?Hi\Kernel\Reflection\AttributeLoaderInterface $attributeLoader = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | [] |  |
| `$logger` | `Psr\Log\LoggerInterface` | '...' |  |
| `$attributeLoader` | `?Hi\Kernel\Reflection\AttributeLoaderInterface` | 'null' |  |

**返回**: `void`

#### `getName`

```php
public function getName(): string
```

**返回**: `string`

#### `withDirectories`

```php
public function withDirectories(array $directories): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$directories` | `array` | - |  |

**返回**: `self`

#### `withFiles`

```php
public function withFiles(array $files): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$files` | `array` | - |  |

**返回**: `self`

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
public function findAllCommands(): Hi\Attributes\Generator|array
```

**返回**: `Hi\Attributes\Generator|array`

#### `findActions`

**标记**: deprecated

```php
public function findActions(Hi\Attributes\Console\Command $command): iterable
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `Hi\Attributes\Console\Command` | - |  |

**返回**: `iterable` - array<Action>>

#### `findAction`

```php
public function findAction(Hi\Attributes\Console\Command $command, string $name): ?Hi\Attributes\Console\Action
```

Find specific action by name using efficient reflection

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `Hi\Attributes\Console\Command` | - |  |
| `$name` | `string` | - |  |

**返回**: `?Hi\Attributes\Console\Action`

