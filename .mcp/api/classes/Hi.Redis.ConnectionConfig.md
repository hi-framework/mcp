---
fqcn: Hi\Redis\ConnectionConfig
type: class
namespace: Hi\Redis
module: Redis
file: src/Redis/ConnectionConfig.php
line: 12
---
# ConnectionConfig

**命名空间**: `Hi\Redis`

**类型**: Class

**文件**: `src/Redis/ConnectionConfig.php:12`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$host` | `string` | public readonly | - |  |
| `$port` | `int` | public readonly | - |  |
| `$password` | `string` | public readonly | - |  |
| `$db` | `int` | public readonly | - |  |
| `$options` | `array` | public readonly | - |  |
| `$timeout` | `int` | public readonly | - |  |

## 方法

### Public 方法

#### `__construct`

```php
public function __construct(array $config)
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `void`

#### `validate`

```php
public function validate(array $config): void
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$config` | `array` | - |  |

**返回**: `void`

### Protected 方法

#### `defaultOptions`

```php
protected function defaultOptions(): array
```

**返回**: `array`

