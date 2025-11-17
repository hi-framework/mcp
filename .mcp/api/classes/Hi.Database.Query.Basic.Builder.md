---
fqcn: Hi\Database\Query\Basic\Builder
type: class
namespace: Hi\Database\Query\Basic
module: Database
file: src/Database/Query/Basic/Builder.php
line: 14
---
# Builder

**命名空间**: `Hi\Database\Query\Basic`

**类型**: Class

**文件**: `src/Database/Query/Basic/Builder.php:14`

**修饰符**: abstract

## 继承关系

**实现**: `Aura\SqlQuery\Common\QueryInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$bridge` | `Hi\Database\Query\Bridge` | protected | - |  |
| `$builder` | `mixed` | protected | - |  |

## 方法

### Public 方法

#### `getQuery`

```php
public function getQuery(): mixed
```

Return original query builder

**返回**: `mixed`

#### `execute`

```php
public function execute(): mixed
```

**返回**: `mixed`

#### `resetFlags`

```php
public function resetFlags(): self
```

Reset all query flags.

**返回**: `self`

#### `__toString`

```php
public function __toString()
```

**返回**: `void`

#### `getStatement`

```php
public function getStatement(): string
```

**返回**: `string`

#### `getQuoteNamePrefix`

```php
public function getQuoteNamePrefix(): string
```

**返回**: `string`

#### `getQuoteNameSuffix`

```php
public function getQuoteNameSuffix(): string
```

**返回**: `string`

#### `bindValues`

```php
public function bindValues(array $bind_values): static
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$bind_values` | `array` | - |  |

**返回**: `static`

#### `bindValue`

```php
public function bindValue(int|string $name, mixed $value): static
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$name` | `int\|string` | - |  |
| `$value` | `mixed` | - |  |

**返回**: `static`

#### `getBindValues`

```php
public function getBindValues(): array
```

**返回**: `array`

