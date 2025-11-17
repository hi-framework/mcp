---
fqcn: Hi\Http\Runtime\Workerman\WorkermanHttpServer
type: class
namespace: Hi\Http\Runtime\Workerman
module: Http
file: src/Http/Runtime/Workerman/WorkermanHttpServer.php
line: 14
---
# WorkermanHttpServer

**命名空间**: `Hi\Http\Runtime\Workerman`

**类型**: Class

**文件**: `src/Http/Runtime/Workerman/WorkermanHttpServer.php:14`

## 继承关系

**继承**: `Hi\Server\Server`

## 方法

### Public 方法

#### `start`

```php
public function start(Hi\Http\RouterInterface $router): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `void`

### Protected 方法

#### `configure`

```php
protected function configure(Hi\Http\RouterInterface $router): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$router` | `Hi\Http\RouterInterface` | - |  |

**返回**: `void`

#### `run`

```php
protected function run(): void
```

**返回**: `void`

