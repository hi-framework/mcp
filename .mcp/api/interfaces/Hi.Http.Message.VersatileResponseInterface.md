---
fqcn: Hi\Http\Message\VersatileResponseInterface
type: interface
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/VersatileResponseInterface.php
line: 9
---
# VersatileResponseInterface

**命名空间**: `Hi\Http\Message`

**类型**: Interface

**文件**: `src/Http/Message/VersatileResponseInterface.php:9`

## 继承关系

**继承**: `Psr\Http\Message\ResponseInterface`

## 方法

### Public 方法

#### `writeBody`

```php
public function writeBody(mixed $body): self
```

Write response body
The implementation class can perform custom data serialization

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$body` | `mixed` | - |  |

**返回**: `self`

