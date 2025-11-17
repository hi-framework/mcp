---
fqcn: Hi\Kernel\AppEnvironment
type: enum
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/AppEnvironment.php
line: 7
---
# AppEnvironment

**命名空间**: `Hi\Kernel`

**类型**: Enum

**文件**: `src/Kernel/AppEnvironment.php:7`

## 继承关系

**实现**: `Hi\Kernel\EnvironmentInterface`

## 方法

### Public 方法

#### `get`

```php
public function get(): string
```

**返回**: `string`

#### `isLocal`

```php
public function isLocal(): bool
```

**返回**: `bool`

#### `isDevelopment`

```php
public function isDevelopment(): bool
```

**返回**: `bool`

#### `isTesting`

```php
public function isTesting(): bool
```

**返回**: `bool`

#### `isStaging`

```php
public function isStaging(): bool
```

**返回**: `bool`

#### `isProduction`

```php
public function isProduction(): bool
```

**返回**: `bool`

#### `isBuild`

```php
public function isBuild(): bool
```

**返回**: `bool`

