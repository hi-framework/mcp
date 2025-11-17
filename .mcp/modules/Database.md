---
module: Database
namespaces: [Hi\Database\Transaction\Metrics, Hi\Database\Transaction, Hi\Database, Hi\Database\Connection, Hi\Database\Connection\Driver\ClickHouse, Hi\Database\Connection\Driver\MySQL, Hi\Database\Query\ClickHouse, Hi\Database\Query, Hi\Database\Query\Traits, Hi\Database\Query\Basic, Hi\Database\Query\MySQL, Hi\Database\Exception]
class_count: 45
interface_count: 9
trait_count: 1
enum_count: 4
attribute_count: 0
---
# Database 模块

数据库连接、查询构建、事务管理

## 概览

- 类: 45
- 接口: 9
- Traits: 1
- 枚举: 4
- Attributes: 0

## 使用指南

- [连接管理](../guides/database/connection.md)
- [MySQL 支持](../guides/database/mysql.md)
- [ClickHouse 支持](../guides/database/clickhouse.md)
- [查询构建器](../guides/database/query.md)
- [事务管理](../guides/database/transaction.md)
- [Database 数据库](../guides/components/database.md)

## 核心概念

- [生命周期](../guides/concepts/lifecycle.md)
- [作用域(Scope)](../guides/concepts/scope.md)
- [服务容器](../guides/concepts/container-and-di.md)
- [注解](../guides/concepts/attributes.md)
- [运行时系统](../guides/concepts/runtime.md)

## API 参考

### 接口

| 名称 | 描述 |
| --- | --- |
| [`TransactionMetricsCollectorInterface`](../api/interfaces/Hi.Database.Transaction.Metrics.TransactionMetricsCollectorInterface.md) | Transaction Metrics Collector Interface |
| [`MicrotimerInterface`](../api/interfaces/Hi.Database.Transaction.MicrotimerInterface.md) | 微秒计时器接口 |
| [`TransactionCoordinatorInterface`](../api/interfaces/Hi.Database.Transaction.TransactionCoordinatorInterface.md) | 事务协调器接口 |
| [`TransactionManagerInterface`](../api/interfaces/Hi.Database.Transaction.TransactionManagerInterface.md) | 事务管理器接口 |
| [`DeadlockDetectorInterface`](../api/interfaces/Hi.Database.Transaction.DeadlockDetectorInterface.md) | 死锁检测器接口 |
| [`TransactionContextInterface`](../api/interfaces/Hi.Database.Transaction.TransactionContextInterface.md) | 事务上下文接口 |
| [`DatabaseProviderInterface`](../api/interfaces/Hi.Database.DatabaseProviderInterface.md) |  |
| [`MetricCollectorInterface`](../api/interfaces/Hi.Database.Query.MetricCollectorInterface.md) |  |
| [`QueryInterface`](../api/interfaces/Hi.Database.Query.QueryInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`TransactionCoordinator`](../api/classes/Hi.Database.Transaction.TransactionCoordinator.md) | 事务协调器 |
| [`TransactionSavepoint`](../api/classes/Hi.Database.Transaction.TransactionSavepoint.md) |  |
| [`Microtimer`](../api/classes/Hi.Database.Transaction.Microtimer.md) | 微秒计时器实现类 |
| [`TransactionManager`](../api/classes/Hi.Database.Transaction.TransactionManager.md) | 事务管理器 |
| [`TransactionContext`](../api/classes/Hi.Database.Transaction.TransactionContext.md) | 事务上下文类 |
| [`MySQLDeadlockDetector`](../api/classes/Hi.Database.Transaction.MySQLDeadlockDetector.md) | MySQL 死锁检测器实现 |
| [`DatabaseManager`](../api/classes/Hi.Database.DatabaseManager.md) | Database connection pool manager |
| [`PDOConnectionPool`](../api/classes/Hi.Database.Connection.PDOConnectionPool.md) |  |
| [`ConnectionConfig`](../api/classes/Hi.Database.Connection.Driver.ClickHouse.ConnectionConfig.md) |  |
| [`ConnectionPool`](../api/classes/Hi.Database.Connection.Driver.ClickHouse.ConnectionPool.md) |  |
| [`ConnectionConfig`](../api/classes/Hi.Database.Connection.Driver.MySQL.ConnectionConfig.md) |  |
| [`ConnectionPool`](../api/classes/Hi.Database.Connection.Driver.MySQL.ConnectionPool.md) |  |
| [`DetectsLostConnections`](../api/classes/Hi.Database.Connection.DetectsLostConnections.md) | Copy from https://github.com/swoole/library/blob/master/src/core/Database/DetectsLostConnections.php |
| [`PDOStatementProxy`](../api/classes/Hi.Database.Connection.PDOStatementProxy.md) |  |
| [`PDOConnectionConfig`](../api/classes/Hi.Database.Connection.PDOConnectionConfig.md) |  |
| [`PDOConnection`](../api/classes/Hi.Database.Connection.PDOConnection.md) |  |
| [`Insert`](../api/classes/Hi.Database.Query.ClickHouse.Insert.md) |  |
| [`Factory`](../api/classes/Hi.Database.Query.ClickHouse.Factory.md) |  |
| [`Update`](../api/classes/Hi.Database.Query.ClickHouse.Update.md) |  |
| [`Delete`](../api/classes/Hi.Database.Query.ClickHouse.Delete.md) |  |
| [`Select`](../api/classes/Hi.Database.Query.ClickHouse.Select.md) |  |
| [`ClickHouse`](../api/classes/Hi.Database.Query.ClickHouse.md) |  |
| [`Bridge`](../api/classes/Hi.Database.Query.Bridge.md) |  |
| [`Insert`](../api/classes/Hi.Database.Query.Basic.Insert.md) |  |
| [`Update`](../api/classes/Hi.Database.Query.Basic.Update.md) |  |
| [`Builder`](../api/classes/Hi.Database.Query.Basic.Builder.md) |  |
| [`DMLBuilder`](../api/classes/Hi.Database.Query.Basic.DMLBuilder.md) |  |
| [`Delete`](../api/classes/Hi.Database.Query.Basic.Delete.md) |  |
| [`Select`](../api/classes/Hi.Database.Query.Basic.Select.md) |  |
| [`MySQL`](../api/classes/Hi.Database.Query.MySQL.md) |  |
| [`Insert`](../api/classes/Hi.Database.Query.MySQL.Insert.md) |  |
| [`Factory`](../api/classes/Hi.Database.Query.MySQL.Factory.md) |  |
| [`Update`](../api/classes/Hi.Database.Query.MySQL.Update.md) |  |
| [`Delete`](../api/classes/Hi.Database.Query.MySQL.Delete.md) |  |
| [`Select`](../api/classes/Hi.Database.Query.MySQL.Select.md) |  |
| [`Query`](../api/classes/Hi.Database.Query.Query.md) |  |
| [`DatabaseException`](../api/classes/Hi.Database.Exception.DatabaseException.md) |  |
| [`MySQLConfigInvalidException`](../api/classes/Hi.Database.Exception.MySQLConfigInvalidException.md) |  |
| [`ConnectionReleasedException`](../api/classes/Hi.Database.Exception.ConnectionReleasedException.md) |  |
| [`TransactionException`](../api/classes/Hi.Database.Exception.TransactionException.md) |  |
| [`SQLExecuteException`](../api/classes/Hi.Database.Exception.SQLExecuteException.md) |  |
| [`ConnectionException`](../api/classes/Hi.Database.Exception.ConnectionException.md) |  |
| [`DatabaseConfigInvalidException`](../api/classes/Hi.Database.Exception.DatabaseConfigInvalidException.md) |  |
| [`PrepareFailedException`](../api/classes/Hi.Database.Exception.PrepareFailedException.md) |  |
| [`RuntimeContextException`](../api/classes/Hi.Database.Exception.RuntimeContextException.md) |  |

### Traits

| 名称 | 描述 |
| --- | --- |
| [`WhereTrait`](../api/traits/Hi.Database.Query.Traits.WhereTrait.md) |  |

### 枚举

| 名称 | 描述 |
| --- | --- |
| [`TransactionTypeEnum`](../api/enums/Hi.Database.Transaction.TransactionTypeEnum.md) | 事务类型枚举 |
| [`TransactionIsolationEnum`](../api/enums/Hi.Database.Transaction.TransactionIsolationEnum.md) | 事务隔离级别枚举 |
| [`TransactionStateEnum`](../api/enums/Hi.Database.Transaction.TransactionStateEnum.md) | 事务状态枚举 |
| [`DriverEnum`](../api/enums/Hi.Database.Connection.DriverEnum.md) |  |

