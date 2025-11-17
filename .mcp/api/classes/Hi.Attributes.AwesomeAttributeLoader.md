---
fqcn: Hi\Attributes\AwesomeAttributeLoader
type: class
namespace: Hi\Attributes
module: Attributes
file: src/Attributes/AwesomeAttributeLoader.php
line: 16
---
# AwesomeAttributeLoader

**命名空间**: `Hi\Attributes`

**类型**: Class

**文件**: `src/Attributes/AwesomeAttributeLoader.php:16`

## 继承关系

**实现**: `Hi\Kernel\AwesomeLoaderInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$classStorage` | `array` | protected | [] | [     Core\Bind::class => [         \Server\Repository\UserRepositoryInterface::class => [],     ],     Database\Cache::class => [         \Server\Database\User::class => [             new Carrier\MethodAttributeCarrier(),         ],     ],     Http\Middleware::class => [         \Hi\Http\Middleware\CorsDefaultMiddleware::class => [],     ], ] |
| `$methodStorage` | `array` | protected | [] |  |
| `$propertyStorage` | `array` | protected | [] |  |
| `$attributeLoader` | `Hi\Kernel\Reflection\AttributeLoaderInterface` | protected readonly | - |  |
| `$container` | `Psr\Container\ContainerInterface` | protected | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | protected | - |  |
| `$directories` | `array` | protected | [] |  |
| `$files` | `array` | protected | [] |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Psr\Container\ContainerInterface $container, Psr\Log\LoggerInterface $logger, array $directories = [], array $files = [], ?Hi\Kernel\Reflection\AttributeLoaderInterface $attributeLoader = 'null')
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$logger` | `Psr\Log\LoggerInterface` | - |  |
| `$directories` | `array` | [] |  |
| `$files` | `array` | [] |  |
| `$attributeLoader` | `?Hi\Kernel\Reflection\AttributeLoaderInterface` | 'null' |  |

**返回**: `void`

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

#### `tokenize`

```php
public function tokenize(): void
```

**返回**: `void`

#### `getClassCarriers`

```php
public function getClassCarriers(string $attribute, ?string $target = 'null'): Hi\Attributes\Generator
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `string` | - |  |
| `$target` | `?string` | 'null' |  |

**返回**: `Hi\Attributes\Generator`

#### `getMethodCarriers`

```php
public function getMethodCarriers(string $attribute, ?string $target = 'null'): Hi\Attributes\Generator
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `string` | - |  |
| `$target` | `?string` | 'null' |  |

**返回**: `Hi\Attributes\Generator`

#### `getPropertyCarriers`

```php
public function getPropertyCarriers(string $attribute, ?string $target = 'null'): Hi\Attributes\Generator
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$attribute` | `string` | - |  |
| `$target` | `?string` | 'null' |  |

**返回**: `Hi\Attributes\Generator`

### Protected 方法

#### `storeClassAttribute`

```php
protected function storeClassAttribute(Hi\Kernel\Reflection\Carrier\CarrierInterface $carrier): void
```

Store class attribute carrier

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$carrier` | `Hi\Kernel\Reflection\Carrier\CarrierInterface` | - |  |

**返回**: `void`

#### `storeMethodAttribute`

```php
protected function storeMethodAttribute(Hi\Kernel\Reflection\Carrier\CarrierInterface $carrier): void
```

Store method attribute carrier

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$carrier` | `Hi\Kernel\Reflection\Carrier\CarrierInterface` | - |  |

**返回**: `void`

#### `storePropertyAttribute`

```php
protected function storePropertyAttribute(Hi\Kernel\Reflection\Carrier\CarrierInterface $carrier): void
```

Store property attribute carrier

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$carrier` | `Hi\Kernel\Reflection\Carrier\CarrierInterface` | - |  |

**返回**: `void`

#### `findAttribute`

```php
protected function findAttribute(array $storage, string $attribute, ?string $target = 'null'): Hi\Attributes\Generator
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$storage` | `array` | - |  |
| `$attribute` | `string` | - |  |
| `$target` | `?string` | 'null' |  |

**返回**: `Hi\Attributes\Generator`

