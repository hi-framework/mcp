# Event 事件

Event 组件基于 PSR-14 事件调度器标准实现，提供了一种灵活且标准化的方式来处理应用程序中的事件，支持异步事件处理、事件优先级和性能监控。

## 设计思路

### 核心概念

- **事件 (Event)**: 事件是由发射器产生的消息，可以是任何PHP对象
- **监听器 (Listener)**: 监听器是期望接收事件的任何PHP可调用对象
- **发射器 (Emitter)**: 发射器是希望分发事件的任意代码
- **调度器 (Dispatcher)**: 调度器是负责确保事件传递给所有相关监听器的服务对象
- **监听器提供者 (Listener Provider)**: 监听器提供者负责确定哪些监听器与给定事件相关

### 架构特性

1. **PSR-14 兼容**: 完全遵循 PSR-14 事件调度器标准
2. **优先级支持**: 支持监听器优先级排序
3. **事件停止**: 支持可停止事件传播
4. **懒加载**: 支持监听器的延迟实例化
5. **性能追踪**: 内置事件处理性能监控
6. **组合模式**: 支持多个监听器提供者组合

## 基本使用

### 创建事件

```php
use Hi\Event\Event;

// 简单事件
class UserRegisteredEvent extends Event
{
    public function __construct(
        public readonly int $userId,
        public readonly string $email,
        public readonly array $userData
    ) {}
}

// 可停止事件
use Hi\Event\StoppableEvent;

class EmailSendingEvent extends StoppableEvent
{
    public function __construct(
        public readonly string $to,
        public readonly string $subject,
        public readonly string $body
    ) {}
    
    public function stopPropagation(): void
    {
        $this->propagationStopped = true;
    }
}
```

### 创建监听器

```php
// 函数监听器
function onUserRegistered(UserRegisteredEvent $event): void
{
    echo "用户 {$event->email} 已注册，ID: {$event->userId}\n";
}

// 类方法监听器
class UserEventListener
{
    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        // 发送欢迎邮件
        $this->emailService->sendWelcomeEmail($event->email);
        
        // 创建用户配置文件
        $this->createUserProfile($event->userId);
    }
    
    public function onEmailSending(EmailSendingEvent $event): void
    {
        // 验证邮件地址
        if (!$this->isValidEmail($event->to)) {
            $event->stopPropagation();
            return;
        }
        
        // 记录邮件发送日志
        $this->logger->info('发送邮件', [
            'to' => $event->to,
            'subject' => $event->subject,
        ]);
    }
}

// 可调用类监听器
class NotificationListener
{
    public function __invoke(UserRegisteredEvent $event): void
    {
        $this->sendNotification($event->userId);
    }
}
```

### 注册和分发事件

```php
use Hi\Event\ListenerProvider;
use Hi\Event\EventDispatcher;

// 创建监听器提供者
$provider = new ListenerProvider();

// 注册监听器
$provider->addListener(UserRegisteredEvent::class, 'onUserRegistered');
$provider->addListener(UserRegisteredEvent::class, [new UserEventListener(), 'onUserRegistered']);
$provider->addListener(UserRegisteredEvent::class, new NotificationListener());

// 创建调度器
$dispatcher = new EventDispatcher($provider);

// 分发事件
$event = new UserRegisteredEvent(123, 'user@example.com', ['name' => 'John Doe']);
$dispatcher->dispatch($event);
```

## 高级特性

### 优先级监听器

```php
use Hi\Event\PrioritizedListenerProvider;

$provider = new PrioritizedListenerProvider();

// 高优先级监听器（先执行）
$provider->addListener(
    UserRegisteredEvent::class,
    function (UserRegisteredEvent $event) {
        echo "高优先级处理: 验证用户数据\n";
    },
    -100 // 优先级越低越先执行
);

// 普通优先级监听器
$provider->addListener(
    UserRegisteredEvent::class,
    function (UserRegisteredEvent $event) {
        echo "普通处理: 发送欢迎邮件\n";
    },
    0
);

// 低优先级监听器（后执行）
$provider->addListener(
    UserRegisteredEvent::class,
    function (UserRegisteredEvent $event) {
        echo "低优先级处理: 统计分析\n";
    },
    100
);

$dispatcher = new EventDispatcher($provider);
$dispatcher->dispatch(new UserRegisteredEvent(123, 'user@example.com', []));

// 输出顺序：
// 高优先级处理: 验证用户数据
// 普通处理: 发送欢迎邮件
// 低优先级处理: 统计分析
```

### 可停止事件

```php
use Hi\Event\StoppableEvent;

class OrderProcessingEvent extends StoppableEvent
{
    public function __construct(
        public readonly int $orderId,
        public readonly array $orderData,
        private string $result = ''
    ) {}
    
    public function setResult(string $result): void
    {
        $this->result = $result;
        $this->stopPropagation();
    }
    
    public function getResult(): string
    {
        return $this->result;
    }
}

// 注册监听器
$provider->addListener(OrderProcessingEvent::class, function (OrderProcessingEvent $event) {
    if ($event->orderData['amount'] > 10000) {
        $event->setResult('需要人工审核');
        return; // 停止后续处理
    }
});

$provider->addListener(OrderProcessingEvent::class, function (OrderProcessingEvent $event) {
    // 这个监听器只在前面的监听器没有停止事件时执行
    $event->setResult('自动处理完成');
});

$event = new OrderProcessingEvent(1, ['amount' => 15000]);
$dispatcher->dispatch($event);
echo $event->getResult(); // 输出: 需要人工审核
```

### 懒加载监听器

```php
use Hi\Event\LazyListenerProvider;
use Psr\Container\ContainerInterface;

// 假设有一个 PSR-11 容器
$container = new Container();
$container->set('email.service', new EmailService());
$container->set('notification.service', new NotificationService());

$provider = new LazyListenerProvider($container);

// 添加服务引用而非实例
$provider->addService(
    UserRegisteredEvent::class,
    'email.service',
    'sendWelcomeEmail'
);

$provider->addService(
    UserRegisteredEvent::class,
    'notification.service',
    'notifyAdmins'
);

// 服务只在事件触发时才被实例化
$dispatcher = new EventDispatcher($provider);
$dispatcher->dispatch(new UserRegisteredEvent(123, 'user@example.com', []));
```

### 组合监听器提供者

```php
use Hi\Event\CompositeListenerProvider;

// 创建多个提供者
$standardProvider = new ListenerProvider();
$prioritizedProvider = new PrioritizedListenerProvider();
$lazyProvider = new LazyListenerProvider($container);

// 向不同提供者添加监听器
$standardProvider->addListener(UserRegisteredEvent::class, 'basicHandler');
$prioritizedProvider->addListener(UserRegisteredEvent::class, 'importantHandler', -100);
$lazyProvider->addService(UserRegisteredEvent::class, 'heavy.service', 'handle');

// 组合所有提供者
$compositeProvider = new CompositeListenerProvider([
    $prioritizedProvider, // 优先级处理器先执行
    $standardProvider,    // 标准处理器
    $lazyProvider,        // 懒加载处理器最后
]);

$dispatcher = new EventDispatcher($compositeProvider);
$dispatcher->dispatch(new UserRegisteredEvent(123, 'user@example.com', []));
```

### 性能追踪

```php
use Hi\Event\TracingEventDispatcher;
use Psr\Log\LoggerInterface;

$logger = new Logger('events');
$baseDispatcher = new EventDispatcher($provider);

// 创建追踪装饰器
$tracingDispatcher = new TracingEventDispatcher($baseDispatcher, $logger);

// 设置性能阈值
$tracingDispatcher->setSlowThreshold(100); // 100ms

// 分发事件 - 自动记录性能日志
$event = new UserRegisteredEvent(123, 'user@example.com', []);
$tracingDispatcher->dispatch($event);

// 日志输出示例：
// [INFO] Event dispatched: UserRegisteredEvent (3 listeners, 45ms)
// [WARN] Slow event processing: UserRegisteredEvent took 120ms
```

## 属性注解支持

### 使用属性标记监听器

```php
use Hi\Event\Attribute\EventListener;

class UserService
{
    #[EventListener(UserRegisteredEvent::class, priority: -10)]
    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        // 高优先级处理用户注册
        $this->validateUser($event->userId);
    }
    
    #[EventListener(UserRegisteredEvent::class)]
    public function sendWelcomeEmail(UserRegisteredEvent $event): void
    {
        $this->emailService->send($event->email, 'welcome');
    }
    
    #[EventListener(OrderProcessingEvent::class, priority: 100)]
    public function recordMetrics(OrderProcessingEvent $event): void
    {
        // 低优先级记录指标
        $this->metrics->increment('orders.processed');
    }
}
```

### 自动发现监听器

```php
use Hi\Event\AttributeEventSubscriber;

$subscriber = new AttributeEventSubscriber($container);

// 扫描并注册带有 EventListener 属性的方法
$subscriber->subscribe(UserService::class);
$subscriber->subscribe(OrderService::class);
$subscriber->subscribe(NotificationService::class);

// 获取注册的监听器提供者
$provider = $subscriber->getListenerProvider();
$dispatcher = new EventDispatcher($provider);
```

## 异步事件处理

### 队列事件

```php
use Hi\Event\AsyncEventDispatcher;
use Hi\Queue\QueueManager;

class AsyncUserRegisteredEvent extends UserRegisteredEvent
{
    public function shouldQueue(): bool
    {
        return true; // 标记为异步处理
    }
    
    public function getQueueName(): string
    {
        return 'user-events';
    }
}

// 异步事件调度器
$queueManager = new QueueManager($config);
$asyncDispatcher = new AsyncEventDispatcher($dispatcher, $queueManager);

// 同步事件立即处理，异步事件加入队列
$asyncDispatcher->dispatch(new AsyncUserRegisteredEvent(123, 'user@example.com', []));
```

### 延迟事件

```php
use Hi\Event\DelayedEventDispatcher;

class DelayedWelcomeEvent extends Event
{
    public function __construct(
        public readonly string $email,
        public readonly int $delaySeconds = 3600 // 1小时后发送
    ) {}
}

$delayedDispatcher = new DelayedEventDispatcher($dispatcher, $scheduler);

// 延迟1小时后分发事件
$delayedDispatcher->dispatch(new DelayedWelcomeEvent('user@example.com', 3600));
```

## 事件中间件

### 事件过滤

```php
class EventFilterMiddleware
{
    public function handle($event, callable $next)
    {
        // 过滤敏感事件
        if ($event instanceof SensitiveEvent && !$this->hasPermission()) {
            return $event; // 跳过处理
        }
        
        return $next($event);
    }
}

// 应用中间件
$dispatcher = new EventDispatcher($provider);
$dispatcher->addMiddleware(new EventFilterMiddleware());
```

### 事件转换

```php
class EventTransformMiddleware
{
    public function handle($event, callable $next)
    {
        // 转换旧事件格式到新格式
        if ($event instanceof LegacyUserEvent) {
            $event = new UserRegisteredEvent(
                $event->getUserId(),
                $event->getEmail(),
                $event->getData()
            );
        }
        
        return $next($event);
    }
}
```

## 测试支持

### 事件断言

```php
use Hi\Event\Testing\EventFake;

class UserRegistrationTest extends TestCase
{
    public function testUserRegistrationDispatchesEvent(): void
    {
        // 使用假的事件调度器
        $eventFake = new EventFake();
        $this->app->instance(EventDispatcherInterface::class, $eventFake);
        
        // 执行业务逻辑
        $userService = new UserService();
        $userService->register('user@example.com', 'password');
        
        // 断言事件被分发
        $eventFake->assertDispatched(UserRegisteredEvent::class);
        $eventFake->assertDispatched(UserRegisteredEvent::class, function ($event) {
            return $event->email === 'user@example.com';
        });
        
        // 断言事件没有被分发
        $eventFake->assertNotDispatched(UserDeletedEvent::class);
        
        // 断言分发次数
        $eventFake->assertDispatchedTimes(UserRegisteredEvent::class, 1);
    }
}
```

### 监听器测试

```php
class UserEventListenerTest extends TestCase
{
    public function testSendsWelcomeEmail(): void
    {
        $emailService = $this->createMock(EmailService::class);
        $emailService->expects($this->once())
            ->method('sendWelcomeEmail')
            ->with('user@example.com');
            
        $listener = new UserEventListener($emailService);
        $event = new UserRegisteredEvent(123, 'user@example.com', []);
        
        $listener->onUserRegistered($event);
    }
}
```

## 性能优化

### 事件缓存

```php
class CachedListenerProvider implements ListenerProviderInterface
{
    public function __construct(
        private ListenerProviderInterface $provider,
        private CacheInterface $cache
    ) {}
    
    public function getListenersForEvent(object $event): iterable
    {
        $eventClass = get_class($event);
        $cacheKey = "event_listeners:{$eventClass}";
        
        $listeners = $this->cache->get($cacheKey);
        
        if ($listeners === null) {
            $listeners = iterator_to_array($this->provider->getListenersForEvent($event));
            $this->cache->set($cacheKey, $listeners, 3600);
        }
        
        return $listeners;
    }
}
```

### 条件监听器

```php
class ConditionalListener
{
    public function __construct(
        private callable $condition,
        private callable $listener
    ) {}
    
    public function __invoke($event): void
    {
        if (($this->condition)($event)) {
            ($this->listener)($event);
        }
    }
}

// 只在工作日处理的监听器
$provider->addListener(
    OrderProcessingEvent::class,
    new ConditionalListener(
        fn($event) => date('N') <= 5, // 周一到周五
        fn($event) => $this->processOrder($event)
    )
);
```

## 注意事项

### 1. 内存泄漏防护

```php
// ❌ 避免在事件中保留大对象引用
class BadEvent
{
    public function __construct(
        public readonly LargeObject $data // 可能导致内存泄漏
    ) {}
}

// ✅ 传递必要的数据
class GoodEvent
{
    public function __construct(
        public readonly int $id,
        public readonly array $essentialData
    ) {}
}
```

### 2. 异常处理

```php
class SafeEventDispatcher implements EventDispatcherInterface
{
    public function dispatch(object $event): object
    {
        foreach ($this->getListeners($event) as $listener) {
            try {
                $listener($event);
            } catch (\Throwable $e) {
                $this->logger->error('Event listener failed', [
                    'event' => get_class($event),
                    'listener' => $this->getListenerName($listener),
                    'error' => $e->getMessage(),
                ]);
                
                // 继续执行其他监听器
                continue;
            }
        }
        
        return $event;
    }
}
```

### 3. 循环依赖

```php
// ❌ 避免事件监听器中触发相同事件
class BadListener
{
    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        // 这可能导致无限循环
        $this->dispatcher->dispatch(new UserRegisteredEvent(...));
    }
}

// ✅ 使用不同的事件或条件判断
class GoodListener
{
    public function onUserRegistered(UserRegisteredEvent $event): void
    {
        if (!$event->isProcessed()) {
            $this->dispatcher->dispatch(new UserWelcomeEvent($event->userId));
        }
    }
}
```

## 最佳实践

1. **事件设计**: 事件应该是不可变的，包含足够但不冗余的信息
2. **监听器职责**: 每个监听器应该有单一职责，避免复杂逻辑
3. **错误处理**: 监听器中的异常不应该影响其他监听器的执行
4. **性能考虑**: 避免在监听器中执行耗时操作，考虑异步处理
5. **测试覆盖**: 为事件和监听器编写充分的测试
6. **文档记录**: 为每个事件和监听器编写清晰的文档
7. **版本兼容**: 事件结构变更时要考虑向后兼容性
8. **监控指标**: 监控事件处理性能和错误率 