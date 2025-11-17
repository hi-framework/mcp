---
fqcn: Hi\Http\Router\ParameterResolver
type: class
namespace: Hi\Http\Router
module: Http
file: src/Http/Router/ParameterResolver.php
line: 27
---
# ParameterResolver

**命名空间**: `Hi\Http\Router`

**类型**: Class

**文件**: `src/Http/Router/ParameterResolver.php:27`

路由处理器参数解析器

负责解析路由处理方法的参数，将参数分类为：
- 输入类（使用 #[Input] 注解标记）
- 框架类型（Context、Request、Response）
- 容器绑定服务（通过 DI 容器解析）
- 基础类型（带默认值）

支持联合类型和自动实例化，遵循与 HttpAttributeLoader 相同的解析逻辑。

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$container` | `?Psr\Container\ContainerInterface` | private readonly | 'null' |  |
| `$logger` | `Psr\Log\LoggerInterface` | private readonly | '...' |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(?Psr\Container\ContainerInterface $container = 'null', Psr\Log\LoggerInterface $logger = '...')
```

构造函数

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `?Psr\Container\ContainerInterface` | 'null' | DI 容器（可选） |
| `$logger` | `Psr\Log\LoggerInterface` | '...' | 日志记录器 |

**返回**: `void`

#### `resolveParameterFormat`

```php
public function resolveParameterFormat(Hi\Http\Metadata\RouteMetadata $routeMetadata): array
```

从路由元数据解析参数格式

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$routeMetadata` | `Hi\Http\Metadata\RouteMetadata` | - | 路由元数据 |

**返回**: `array` - 解析后的参数元数据数组

**抛出异常**:

- `RouterException` - 当参数解析失败时

