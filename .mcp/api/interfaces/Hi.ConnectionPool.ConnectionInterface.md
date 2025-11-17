---
fqcn: Hi\ConnectionPool\ConnectionInterface
type: interface
namespace: Hi\ConnectionPool
module: ConnectionPool
file: src/ConnectionPool/ConnectionInterface.php
line: 7
---
# ConnectionInterface

**命名空间**: `Hi\ConnectionPool`

**类型**: Interface

**文件**: `src/ConnectionPool/ConnectionInterface.php:7`

## 方法

### Public 方法

#### `connect`

```php
public function connect(): void
```

Connect to connection
eg: database, http client

**返回**: `void`

#### `disconnect`

```php
public function disconnect(): void
```

Close connection.

**返回**: `void`

#### `isConnected`

```php
public function isConnected(): bool
```

Check if connection is connected

**返回**: `bool`

#### `isClosed`

```php
public function isClosed(): bool
```

Check if connection is closed

**返回**: `bool`

#### `getLastUseTime`

```php
public function getLastUseTime(): float
```

Get connection last use time

**返回**: `float`

#### `getCreatedTime`

```php
public function getCreatedTime(): int
```

Get connection created time

**返回**: `int`

#### `getNumber`

```php
public function getNumber(): int
```

Get connection number
Connection pool assigns a unique identifier to each connection to mark its growth.

**返回**: `int`

#### `use`

```php
public function use(): self
```

Mark connection in use

**返回**: `self`

#### `release`

```php
public function release(): void
```

Release connection
The connection is released back to the pool

**返回**: `void`

