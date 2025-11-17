---
fqcn: Hi\Http\Runtime\Builtin\BuiltinServer
type: class
namespace: Hi\Http\Runtime\Builtin
module: Http
file: src/Http/Runtime/Builtin/BuiltinServer.php
line: 13
---
# BuiltinServer

**命名空间**: `Hi\Http\Runtime\Builtin`

**类型**: Class

**文件**: `src/Http/Runtime/Builtin/BuiltinServer.php:13`

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

#### `startHttpServer`

```php
protected function startHttpServer(): void
```

Start PHP built-in webserver.
Like `php -S 127.0.0.1:9527 /path/to/entry.php`

**返回**: `void`

#### `phpExecutable`

```php
protected function phpExecutable(): string
```

Return PHP executable path.
If cannot determine PHP executable path, return empty string.

**返回**: `string`

