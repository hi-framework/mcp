---
fqcn: Hi\Kernel\EnvironmentInterface
type: interface
namespace: Hi\Kernel
module: Kernel
file: src/Kernel/EnvironmentInterface.php
line: 11
---
# EnvironmentInterface

**命名空间**: `Hi\Kernel`

**类型**: Interface

**文件**: `src/Kernel/EnvironmentInterface.php:11`

App running environment
Must implement the interface through an enum

## 方法

### Public 方法

#### `get`

```php
public function get(): string
```

Get the environment name.

**返回**: `string`

#### `isLocal`

```php
public function isLocal(): bool
```

Check if this environment is local environment.

**返回**: `bool`

#### `isDevelopment`

```php
public function isDevelopment(): bool
```

Check if this environment is development environment.

**返回**: `bool`

#### `isTesting`

```php
public function isTesting(): bool
```

Check if this environment is testing environment.

**返回**: `bool`

#### `isStaging`

```php
public function isStaging(): bool
```

Check if this environment is staging environment.

**返回**: `bool`

#### `isProduction`

```php
public function isProduction(): bool
```

Check if this environment is production environment.

**返回**: `bool`

#### `isBuild`

```php
public function isBuild(): bool
```

Check if this environment is build environment.

**返回**: `bool`

