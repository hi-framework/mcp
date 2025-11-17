---
fqcn: Hi\Kernel\Console\Dispatcher
type: class
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/Dispatcher.php
line: 16
---
# Dispatcher

**命名空间**: `Hi\Kernel\Console`

**类型**: Class

**文件**: `src/Kernel/Console/Dispatcher.php:16`

## 继承关系

**实现**: `Hi\Kernel\Console\DispatcherInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$command` | `Hi\Kernel\Console\Metadata\CommandMetadata` | public readonly | - |  |
| `$action` | `Hi\Kernel\Console\Metadata\ActionMetadata` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(Hi\Kernel\Console\Metadata\CommandMetadata $command, Hi\Kernel\Console\Metadata\ActionMetadata $action)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$command` | `Hi\Kernel\Console\Metadata\CommandMetadata` | - |  |
| `$action` | `Hi\Kernel\Console\Metadata\ActionMetadata` | - |  |

**返回**: `void`

#### `dispatch`

```php
public function dispatch(Psr\Container\ContainerInterface $container, Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output): int
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |

**返回**: `int`

### Protected 方法

#### `resolveArguments`

```php
protected function resolveArguments(Psr\Container\ContainerInterface $container, Hi\Kernel\Console\ReflectionMethod $method, array $parameters = []): array
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$method` | `Hi\Kernel\Console\ReflectionMethod` | - |  |
| `$parameters` | `array` | [] |  |

**返回**: `array`

