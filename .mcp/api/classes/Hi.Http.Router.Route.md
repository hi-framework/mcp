---
fqcn: Hi\Http\Router\Route
type: class
namespace: Hi\Http\Router
module: Http
file: src/Http/Router/Route.php
line: 27
---
# Route

**命名空间**: `Hi\Http\Router`

**类型**: Class

**文件**: `src/Http/Router/Route.php:27`

HTTP 路由处理器

负责创建和管理 HTTP 请求的处理管道，包括：
- 全局中间件和路由特定中间件的组合
- 参数解析和注入（框架类型、输入类、容器服务）
- 请求验证和错误处理

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$handler` | `mixed` | public readonly | - |  |
| `$extend` | `Hi\Http\Router\Extend` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(mixed $handler, Hi\Http\Router\Extend $extend)
```

构造函数

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$handler` | `mixed` | - | 路由处理器函数 |
| `$extend` | `Hi\Http\Router\Extend` | - | 路由扩展配置（中间件、参数、认证等） |

**返回**: `void`

#### `createPipeline`

```php
public function createPipeline(array $middlewares, ?Symfony\Component\Validator\Validator\ValidatorInterface $validator): Hi\Http\Pipeline
```

创建请求处理管道

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$middlewares` | `array` | - | 全局中间件列表 |
| `$validator` | `?Symfony\Component\Validator\Validator\ValidatorInterface` | - | 验证器实例（可选） |

**返回**: `Hi\Http\Pipeline` - 配置好的处理管道

### Protected 方法

#### `findPropertyValue`

**标记**: static

```php
protected static function findPropertyValue(array $path, array $parsedBody, string $hintType): mixed
```

从嵌套数组中查找属性值

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$path` | `array` | - | 属性路径数组 |
| `$parsedBody` | `array` | - | 已解析的数据数组 |
| `$hintType` | `string` | - | 目标类型提示 |

**返回**: `mixed` - 找到的值（已转换类型）或 null

#### `prepareHeaderValue`

**标记**: static

```php
protected static function prepareHeaderValue(string $headerValue, string $hintType): mixed
```

准备 HTTP 头部值

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$headerValue` | `string` | - | HTTP 头部值 |
| `$hintType` | `string` | - | 目标类型提示 |

**返回**: `mixed` - 转换后的值

#### `parsedBody`

**标记**: static

```php
protected static function parsedBody(Psr\Http\Message\ServerRequestInterface $request, string $inputType): array
```

解析请求体

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$request` | `Psr\Http\Message\ServerRequestInterface` | - | HTTP 请求对象 |
| `$inputType` | `string` | - | 输入类型（如 'application/json'） |

**返回**: `array` - 解析后的数据数组

**抛出异常**:

- `\JsonException` - 当 JSON 解码失败时
- `\Exception` - 当 XML 解码失败时

