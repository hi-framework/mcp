---
fqcn: Hi\Attributes\AutowireBindLoader
type: class
namespace: Hi\Attributes
module: Attributes
file: src/Attributes/AutowireBindLoader.php
line: 20
---
# AutowireBindLoader

**命名空间**: `Hi\Attributes`

**类型**: Class

**文件**: `src/Attributes/AutowireBindLoader.php:20`

## 继承关系

**继承**: `Hi\Attributes\AwesomeAttributeLoader`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | protected | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected | - |  |
| `$directories` | `array` | protected | [] |  |
| `$files` | `array` | protected | [] |  |
| `$proxyClassSaveDirectory` | `string` | protected | '' |  |
| `$filesSystem` | `Spiral\Files\FilesInterface` | protected | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Container\ContainerInterface $container, Psr\Log\LoggerInterface $logger, array $directories = [], array $files = [], ?Hi\Kernel\Reflection\AttributeLoaderInterface $attributeLoader = 'null', string $proxyClassSaveDirectory = '', Spiral\Files\FilesInterface $filesSystem = '...')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |
| `$directories` | `array` | [] |  |
| `$files` | `array` | [] |  |
| `$attributeLoader` | `?Hi\Kernel\Reflection\AttributeLoaderInterface` | 'null' |  |
| `$proxyClassSaveDirectory` | `string` | '' |  |
| `$filesSystem` | `Spiral\Files\FilesInterface` | '...' |  |

**返回**: `void`

#### `load`

```php
public function load(Spiral\Core\Container $container, bool $debug = 'false'): self
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Spiral\Core\Container` | - |  |
| `$debug` | `bool` | 'false' |  |

**返回**: `self`

### Protected 方法

#### `createCacheProxy`

```php
protected function createCacheProxy(array $carriers): string
```

Create proxy class for the class where the cache attribute is located

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$carriers` | `array` | - |  |

**返回**: `string`

#### `createTransactionProxy`

```php
protected function createTransactionProxy(array $carriers): string
```

Create proxy class for the class where the transaction attribute is located

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$carriers` | `array` | - |  |

**返回**: `string`

