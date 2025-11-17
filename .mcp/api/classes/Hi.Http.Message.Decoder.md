---
fqcn: Hi\Http\Message\Decoder
type: class
namespace: Hi\Http\Message
module: Http
file: src/Http/Message/Decoder.php
line: 7
---
# Decoder

**命名空间**: `Hi\Http\Message`

**类型**: Class

**文件**: `src/Http/Message/Decoder.php:7`

## 方法

### Public 方法

#### `decode`

**标记**: static

```php
public static function decode(string $type, string $data): array
```

Decodes a string of data into an array based on the specified type.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$type` | `string` | - | The type of data to decode (e.g., 'json', 'xml'). |
| `$data` | `string` | - | the data to decode |

**返回**: `array` - the decoded data as an array

**抛出异常**:

- `\JsonException` - if JSON decoding fails
- `\Exception` - if XML decoding fails

