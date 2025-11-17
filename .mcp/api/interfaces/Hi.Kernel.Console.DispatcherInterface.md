---
fqcn: Hi\Kernel\Console\DispatcherInterface
type: interface
namespace: Hi\Kernel\Console
module: Kernel
file: src/Kernel/Console/DispatcherInterface.php
line: 9
---
# DispatcherInterface

**命名空间**: `Hi\Kernel\Console`

**类型**: Interface

**文件**: `src/Kernel/Console/DispatcherInterface.php:9`

## 方法

### Public 方法

#### `dispatch`

```php
public function dispatch(Psr\Container\ContainerInterface $container, Hi\Kernel\Console\InputInterface $input, Hi\Kernel\Console\OutputInterface $output): int
```

Dispatch command action.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |
| `$input` | `Hi\Kernel\Console\InputInterface` | - |  |
| `$output` | `Hi\Kernel\Console\OutputInterface` | - |  |

**返回**: `int`

