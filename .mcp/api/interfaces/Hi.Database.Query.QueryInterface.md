---
fqcn: Hi\Database\Query\QueryInterface
type: interface
namespace: Hi\Database\Query
module: Database
file: src/Database/Query/QueryInterface.php
line: 10
---
# QueryInterface

**命名空间**: `Hi\Database\Query`

**类型**: Interface

**文件**: `src/Database/Query/QueryInterface.php:10`

## 方法

### Public 方法

#### `setMetricCollector`

```php
public function setMetricCollector(Hi\Database\Query\MetricCollectorInterface $collector): static
```

Set database metric collector

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$collector` | `Hi\Database\Query\MetricCollectorInterface` | - |  |

**返回**: `static`

#### `setContainer`

```php
public function setContainer(Psr\Container\ContainerInterface $container): static
```

Set container

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$container` | `Psr\Container\ContainerInterface` | - |  |

**返回**: `static`

#### `setTransactionManager`

```php
public function setTransactionManager(Hi\Database\Transaction\TransactionManagerInterface $transactionManager): static
```

Set transaction manager

**参数**:

| 参数 | 类型 | 默认值 | 描述 |
| --- | --- | --- | --- |
| `$transactionManager` | `Hi\Database\Transaction\TransactionManagerInterface` | - |  |

**返回**: `static`

