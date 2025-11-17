---
fqcn: Hi\Database\Query\Query
type: class
namespace: Hi\Database\Query
module: Database
file: src/Database/Query/Query.php
line: 13
---
# Query

**命名空间**: `Hi\Database\Query`

**类型**: Class

**文件**: `src/Database/Query/Query.php:13`

**修饰符**: abstract

## 继承关系

**实现**: `Hi\Database\Query\QueryInterface`

## 属性

| 属性 | 类型 | 可见性 | 默认值 | 描述 |
| --- | --- | --- | --- | --- |
| `$connection` | `string` | protected | - | Which database connection to use |
| `$readonlyConnection` | `string` | protected | - | Which database connection to use for read |
| `$table` | `string` | protected | - | Target table name |
| `$transactionManager` | `Hi\Database\Transaction\TransactionManagerInterface` | protected | - |  |
| `$container` | `Psr\Container\ContainerInterface` | protected | - |  |
| `$metricCollector` | `Hi\Database\Query\MetricCollectorInterface` | protected | - |  |

## 方法

### Public 方法

#### `setMetricCollector`

```php
public function setMetricCollector(Hi\Database\Query\MetricCollectorInterface $metricCollector): static
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$metricCollector` | `Hi\Database\Query\MetricCollectorInterface` | - |  |

**返回**: `static`

#### `setTransactionManager`

```php
public function setTransactionManager(Hi\Database\Transaction\TransactionManagerInterface $transactionManager): static
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionManager` | `Hi\Database\Transaction\TransactionManagerInterface` | - |  |

**返回**: `static`

#### `setContainer`

```php
public function setContainer(Psr\Container\ContainerInterface $container): static
```

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |

**返回**: `static`

#### `query`

```php
public function query(string $sql, array $bind = []): mixed
```

Executes the query
Return PDOStatement used for subsequent operations

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$sql` | `string` | - |  |
| `$bind` | `array` | [] |  |

**返回**: `mixed`

