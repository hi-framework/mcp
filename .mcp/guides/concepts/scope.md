# 作用域(Scope)

Hi Framework 提供了强大的作用域管理系统，通过依赖注入容器和协程上下文实现了同步和异步环境下的依赖绑定管理。

## 核心概念

### 1. 什么是作用域

作用域是一个独立的依赖注入环境，其中包含特定的服务绑定关系。Hi Framework 的作用域系统允许您：

- **隔离依赖**：不同作用域中的服务实例相互独立
- **继承绑定**：子作用域可以继承父作用域的绑定关系
- **异步安全**：在协程环境下保持依赖关系的一致性

### 2. 作用域的工作原理

```php
// 获取当前作用域的依赖
$userService = construct(UserServiceInterface::class);

// 在特定作用域中执行代码
scope(function($container) {
    // 这里的代码在独立的作用域中运行
    $service = construct(SomeServiceInterface::class);
}, [
    // 作用域特定的绑定
    SomeServiceInterface::class => SpecialImplementation::class
]);
```

## 快速开始

### 基本用法

```php
<?php

use function construct;
use function scope;
use function async_scope;

// 1. 获取当前作用域的服务
$logger = construct(LoggerInterface::class);
$logger->info('Hello World');

// 2. 在同步作用域中执行代码
scope(function ($container) {
    $dbService = construct(DatabaseInterface::class);
    $users = $dbService->findAll();
    return $users;
}, [
    // 为此作用域绑定特定的数据库实现
    DatabaseInterface::class => TestDatabaseService::class
]);

// 3. 在异步作用域中执行代码
async_scope(function ($container) {
    $logger = construct(LoggerInterface::class);
    $logger->info('Async task completed');
}, [
    LoggerInterface::class => AsyncLoggerService::class
]);
```

### 实际应用场景

```php
// HTTP 请求处理中的作用域
#[Get('/api/users/detail')]
public function getUser(Context $ctx): array
{
    $userId = (int) ($ctx->getRequest()->getQueryParams()['id'] ?? 0);
    
    // 为每个请求创建独立的作用域
    return scope(function () use ($userId) {
        $userService = construct(UserServiceInterface::class);
        $user = $userService->findById($userId);
        
        return ['user' => $user->toArray()];
    }, [
        // 请求特定的绑定
        UserServiceInterface::class => CachedUserService::class,
        CacheInterface::class => RedisCache::class
    ]);
}
```

## 核心函数详解

### construct() - 依赖解析

```php
function construct(string $alias): mixed
```

从当前作用域的容器中解析依赖。

**参数**：
- `$alias`: 服务的类名或别名

**返回值**：
- 解析的服务实例

**示例**：
```php
$logger = construct(LoggerInterface::class);
$userService = construct('user.service');
```

**异常**：
- `ScopeException`: 当容器作用域未设置或依赖解析失败时抛出

### scope() - 同步作用域

```php
function scope(callable $scope, array $bindings = []): mixed
```

在当前协程中创建一个同步作用域并执行回调函数。

**参数**：
- `$scope`: 要在作用域中执行的回调函数
- `$bindings`: 作用域特定的服务绑定

**工作原理**：
1. 将绑定保存到协程上下文中
2. 合并新绑定与已有绑定
3. 如果在新协程中，创建新的 Scope 实例
4. 否则使用当前作用域执行回调

**示例**：
```php
$result = scope(function ($container) {
    $service = construct(PaymentService::class);
    return $service->processPayment(100);
}, [
    PaymentService::class => MockPaymentService::class,
    LoggerInterface::class => NullLogger::class
]);
```

### async_scope() - 异步作用域

```php
function async_scope(callable $scope, array $bindings = [], float $delay = 0): mixed
```

创建一个新协程并在其中运行异步作用域。

**参数**：
- `$scope`: 要在异步作用域中执行的回调函数
- `$bindings`: 作用域特定的服务绑定
- `$delay`: 执行前的延迟时间（秒）

**工作原理**：
1. 继承当前协程的绑定关系
2. 创建新协程
3. 在新协程中设置绑定上下文
4. 执行回调函数并自动处理异常

**示例**：
```php
// 异步发送邮件
async_scope(function () use ($userId, $subject, $content) {
    $emailService = construct(EmailServiceInterface::class);
    $emailService->send($userId, $subject, $content);
}, [
    EmailServiceInterface::class => AsyncEmailService::class
], 1.0); // 延迟 1 秒执行

// 批量异步任务
foreach ($tasks as $task) {
    async_scope(function () use ($task) {
        $processor = construct(TaskProcessorInterface::class);
        $processor->process($task);
    });
}
```

## 高级应用：多应用环境下的服务隔离

这个示例基于实际生产项目，展示了作用域系统的真正威力 - 在多租户/多应用环境下实现服务级别的完全隔离，而业务代码保持完全透明。

### 场景：多应用共享代码基但使用不同服务实现

```php
// 应用级别的服务上下文标识
class AppSourceVO
{
    public function __construct(public readonly AppIdEnum $appId) {}
}

// 多应用消息队列消费者 - 演示应用级别作用域隔离
class HumenLabelFemaleConsumer extends AbstractConsumer
{
    protected function handle(Message $message)
    {
        $value = json_decode($message->getValue(), true);
        $appId = AppIdEnum::from($value['app_id'] ?? 'voya');
        
        // 关键：为每个应用创建独立的作用域环境
        // 业务逻辑完全不需要知道当前处理的是哪个应用
        scope(function () use ($value) {
            // 服务层代码对应用透明
            $service = construct(HumenLabelService::class);
            return $service->save($value, GenderEnum::Female);
        }, [
            // 注入应用上下文，所有服务自动使用对应应用的配置
            AppSourceVO::class => new AppSourceVO($appId)
        ]);
    }
}

// 定时任务中的多应用处理
#[Command('words', desc: '爱神牵线文案')]
class SyncConfigCommand
{
    #[Action('mysql-to-es', schedule: '*/5 * * * *')]
    public function mysqlToEs(): void
    {
        // 对每个应用执行相同的业务逻辑，但使用不同的服务实现
        foreach (AppIdEnum::all() as $appId) {
            scope(function (Container $container) {
                // 业务代码对应用完全透明
                $syncService = $container->make(SentenceSyncInterface::class);
                return $syncService->syncForPredefined();
            }, [
                // 每个应用使用独立的服务配置
                AppSourceVO::class => new AppSourceVO($appId)
            ]);
        }
    }
}

// 业务服务层 - 完全应用无关
class ChatMatchDispatchService
{
    public function __construct(
        private readonly VoyaChatMatchService $voyaMatchSvc,
        private readonly BeneChatMatchService $beneMatchSvc,
    ) {}

    protected function choseService(string $appId): AbstractChatMatchService
    {
        // 根据作用域中的应用上下文自动选择服务
        return match (AppIdEnum::from($appId)) {
            AppIdEnum::Voya => $this->voyaMatchSvc,
            AppIdEnum::Bene => $this->beneMatchSvc,
        };
    }

    public function trigger(ParticipantDTO $userDTO): bool
    {
        // 自动使用正确的应用服务，无需手动判断
        return $this->choseService($userDTO->appId)->trigger($userDTO);
    }
}

// 应用特定的服务实现
#[Bind(use: VoyaChatMatchService::class)]
class VoyaChatMatchService extends AbstractChatMatchService
{
    protected function init(): void
    {
        // 根据作用域上下文自动注入对应应用的服务
        $this->heartbeatSvc = construct(VoyaHeartbeatService::class);
        $this->sourceAppClient = construct(VoyaMessageService::class);
    }

    public function trigger(ParticipantDTO $userDTO): bool
    {
        // 异步任务也会继承当前应用作用域
        async_scope(fn () => $this->createParticipantSvc->save($requestor));
        
        // 业务逻辑...
        return $this->making($requestor, $operateStrategy, $userDTO);
    }
}
```

### 服务配置绑定 - 应用感知的依赖注入

```php
// 配置文件：不同应用使用不同的服务实现
return [
    'bindings' => [
        // Voya 应用的服务绑定
        'voya' => [
            HeartbeatInterface::class => VoyaHeartbeatService::class,
            MessageServiceInterface::class => VoyaMessageService::class,
            DatabaseInterface::class => VoyaDatabase::class,
        ],
        
        // Bene 应用的服务绑定
        'bene' => [
            HeartbeatInterface::class => BeneHeartbeatService::class,
            MessageServiceInterface::class => BeneMessageService::class,
            DatabaseInterface::class => BeneDatabase::class,
        ]
    ]
];

// 自动服务提供器
class MultiAppServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(HeartbeatInterface::class, function (Container $c) {
            $appContext = $c->get(AppSourceVO::class);
            $bindings = config("bindings.{$appContext->appId->value}");
            
            return $c->make($bindings[HeartbeatInterface::class]);
        });
    }
}
```

**这个实际生产应用的价值**：

1. **完美的应用隔离**：每个应用使用独立的数据库、消息服务、心跳服务等
2. **业务逻辑复用**：相同的业务代码可以在不同应用间完全复用
3. **配置驱动**：通过作用域绑定实现不同应用的服务配置
4. **异步任务继承**：`async_scope` 自动继承父作用域的应用上下文
5. **测试友好**：轻松为不同应用创建独立的测试环境
6. **运行时切换**：可以在运行时动态切换应用上下文而无需重启

### 核心优势总结

```php
// ❌ 传统方式：应用逻辑散布在业务代码中
class TraditionalService
{
    public function process($data, $appId)
    {
        if ($appId === 'voya') {
            $client = new VoyaClient();
            $database = new VoyaDatabase();
        } elseif ($appId === 'bene') {
            $client = new BeneClient();
            $database = new BeneDatabase();
        }
        
        // 业务逻辑与应用判断混合
        return $client->send($database->save($data));
    }
}

// ✅ 作用域方式：应用逻辑完全透明
class ScopeAwareService
{
    public function process($data)
    {
        // 纯粹的业务逻辑，对应用完全透明
        $client = construct(ClientInterface::class);
        $database = construct(DatabaseInterface::class);
        
        return $client->send($database->save($data));
    }
}

// 使用时通过作用域注入应用上下文
foreach ($messages as $message) {
    scope(function () use ($message) {
        $service = construct(ScopeAwareService::class);
        return $service->process($message);
    }, [
        AppSourceVO::class => new AppSourceVO($message['app_id'])
    ]);
}
```

## 协程上下文管理

### 绑定继承机制

```php
// 父协程中设置绑定
scope(function () {
    // 在子协程中，这些绑定会被继承
    async_scope(function () {
        $logger = construct(LoggerInterface::class); // 使用继承的 FileLogger
        $logger->info('Child coroutine message');
    });
}, [
    LoggerInterface::class => FileLogger::class
]);
```

### 上下文隔离

```php
// 不同协程中的作用域是独立的
async_scope(function () {
    $service = construct(ServiceInterface::class); // 使用 ServiceA
}, [ServiceInterface::class => ServiceA::class]);

async_scope(function () {
    $service = construct(ServiceInterface::class); // 使用 ServiceB
}, [ServiceInterface::class => ServiceB::class]);
```

## 性能优化

### 1. 避免过度嵌套

```php
// ❌ 不推荐：过度嵌套作用域
scope(function () {
    scope(function () {
        scope(function () {
            // 深度嵌套会影响性能
        });
    });
});

// ✅ 推荐：合理组织作用域
scope(function () {
    // 在单个作用域中处理相关逻辑
}, $allBindings);
```

### 2. 绑定重用

```php
// ✅ 推荐：重用相同的绑定配置
$testBindings = [
    DatabaseInterface::class => InMemoryDatabase::class,
    LoggerInterface::class => NullLogger::class
];

scope($task1, $testBindings);
scope($task2, $testBindings);
scope($task3, $testBindings);
```

### 3. 异步任务批量处理

```php
// ✅ 推荐：批量创建异步任务
$commonBindings = [/* ... */];

foreach ($tasks as $task) {
    async_scope(function () use ($task) {
        // 处理单个任务
    }, $commonBindings);
}
```

## 常见问题

### 何时使用 scope() vs async_scope()？

- 使用 `scope()` 当您需要在当前执行流中创建临时的依赖环境
- 使用 `async_scope()` 当您需要异步执行任务，并且希望该任务有独立的依赖环境

### 作用域绑定是否会影响全局容器？

不会。作用域绑定只在特定的作用域内生效，不会影响全局容器配置。

### 如何在作用域中处理异常？

框架会自动捕获异常并通过 `ExceptionHandlerInterface` 报告，无需手动处理。

### 异步作用域中的异常如何处理？

框架会自动捕获异常并通过 `ExceptionHandlerInterface` 报告，无需手动处理。

## 最佳实践

### 1. 明确作用域边界

```php
// ✅ 明确的作用域职责
class OrderService
{
    public function processOrder(Order $order): void
    {
        // 订单处理作用域
        scope(function () use ($order) {
            $this->validateOrder($order);
            $this->calculateTotal($order);
            $this->saveOrder($order);
        }, [
            ValidatorInterface::class => OrderValidator::class,
            CalculatorInterface::class => TaxCalculator::class
        ]);
        
        // 异步通知作用域
        async_scope(function () use ($order) {
            $this->sendConfirmationEmail($order);
            $this->updateInventory($order);
        }, [
            EmailServiceInterface::class => AsyncEmailService::class,
            InventoryInterface::class => RemoteInventoryService::class
        ]);
    }
}
```

### 2. 类型安全的绑定

```php
// ✅ 使用接口和具体实现
$bindings = [
    LoggerInterface::class => FileLogger::class,
    CacheInterface::class => RedisCache::class,
    DatabaseInterface::class => MySQLDatabase::class
];

scope($callback, $bindings);
```

### 3. 合理使用异步作用域

```php
// ✅ 异步作用域适用场景
class NotificationService  
{
    public function sendNotifications(array $users): void
    {
        foreach ($users as $user) {
            async_scope(function () use ($user) {
                $emailService = construct(EmailServiceInterface::class);
                $emailService->send($user->getEmail(), 'Welcome!');
            }, [], 0.1); // 每个任务间隔 0.1 秒
        }
    }
}
```

## 总结

Hi Framework 的作用域系统提供了：

- **灵活性**：支持同步和异步两种作用域模式
- **隔离性**：每个作用域拥有独立的依赖环境
- **继承性**：子作用域可以继承父作用域的绑定
- **类型安全**：编译期类型检查，减少运行时错误
- **性能优化**：基于协程的高效上下文管理

通过合理使用作用域，您可以构建更加模块化、可测试和可维护的应用程序。