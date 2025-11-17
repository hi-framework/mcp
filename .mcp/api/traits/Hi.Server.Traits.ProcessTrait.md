---
fqcn: Hi\Server\Traits\ProcessTrait
type: trait
namespace: Hi\Server\Traits
module: Server
file: src/Server/Traits/ProcessTrait.php
line: 14
---
# ProcessTrait

**命名空间**: `Hi\Server\Traits`

**类型**: Trait

**文件**: `src/Server/Traits/ProcessTrait.php:14`

待重新使用.

## 方法

### Public 方法

#### `getPid`

```php
public function getPid(): int
```

返回进程 id.

**返回**: `int`

#### `getChildPids`

```php
public function getChildPids(): array
```

返回当前服务所有子进程.

**返回**: `array`

#### `isRunning`

```php
public function isRunning(): bool
```

判断当前进程/服务是否正在运行中.

**返回**: `bool`

### Protected 方法

#### `findChildPids`

```php
protected function findChildPids($ppid, &$pids = []): void
```

以递归方式查找指定 pid 下进程 pid 树.

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$ppid` | `int` | - |  |
| `$pids` | `mixed` | [] |  |

**返回**: `void`

#### `startWait`

```php
protected function startWait(): void
```

阻塞等待进程启动.

**返回**: `void`

#### `stopWait`

```php
protected function stopWait(): void
```

阻塞等待进程停止.

**返回**: `void`

