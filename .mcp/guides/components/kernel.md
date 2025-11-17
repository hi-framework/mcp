# Kernel 内核

Kernel 是 Hi Framework 的核心组件，负责应用程序的启动、依赖注入容器管理、异常处理和生命周期控制。

## 设计思路

### 核心职责

1. **应用启动**: 管理应用程序的启动流程和初始化
2. **容器管理**: 集成 Spiral Container 的依赖注入容器
3. **异常处理**: 提供全局异常处理机制
4. **服务注册**: 管理核心服务的注册和绑定
5. **生命周期**: 控制应用程序的生命周期事件

### 架构特点

- **单一入口**: 作为应用程序的唯一启动点
- **延迟加载**: 支持服务的延迟实例化
- **类型安全**: 全面的类型提示和检查
- **Container 集成**: 基于 Spiral Container 的依赖注入系统

## 基本使用

### 创建应用内核

```php
<?php

use Hi\Kernel;
use Hi\Exception\ExceptionHandler;
use Spiral\Core\Container;
use Hi\Kernel\LoggerFactory;

// 创建基础内核（最简单方式）
$kernel = new Kernel(__DIR__);

// 创建带完整配置的内核
$kernel = new Kernel(
    rootDirectory: __DIR__,
    exceptionHandler: new ExceptionHandler(),
    handleErrors: true,
    container: new Container(),
    loggerFactory: new LoggerFactory(),
);
```

### 配置和启动

```php
use Hi\Http\Application;
use Hi\Database\DatabaseManager;
use Hi\Cache\CacheManager;
use Spiral\Core\Container;

// 配置应用（通过依赖注入自动解析参数）
$kernel->load(function (Container $container, DatabaseManager $db, CacheManager $cache) {
    // 注册HTTP应用
    $container->bindSingleton(Application::class, function () {
        $app = new Application();
        $app->get('/', function () {
            return ['message' => 'Hello World'];
        });
        return $app;
    });
    
    // 数据库初始化（如果需要）
    // $db->initialize();
    
    // 缓存配置（如果需要）
    // $cache->configure();
});

// 启动应用（控制台应用）
$exitCode = $kernel->bootstrap($argv);
exit($exitCode);
```

## 高级配置

### 自定义服务提供者

```php
use Hi\Kernel;
use Hi\Cache\CacheManager;
use Spiral\Core\Container;

$kernel = new Kernel(__DIR__);

$kernel->load(function (Container $container) {
    // 注册自定义服务
    $container->bindSingleton(CustomService::class, function () {
        return new CustomService('config');
    });
    
    // 绑定接口实现
    $container->bind(PaymentInterface::class, StripePayment::class);
    
    // 配置现有服务（如果该服务已存在）
    if ($container->has(CacheManager::class)) {
        $cacheManager = $container->get(CacheManager::class);
        // 进行相应配置
    }
});
```

### 环境配置

```php
use Hi\Kernel\AppEnvironment;
use Hi\Kernel\EnvironmentInterface;
use Spiral\Core\Container;
use Psr\Log\LoggerInterface;

$kernel = new Kernel(__DIR__);

$kernel->load(function (Container $container) {
    // 设置应用环境
    $container->bindSingleton(EnvironmentInterface::class, AppEnvironment::Development);
    
    // 根据环境配置服务
    $env = $container->get(EnvironmentInterface::class);
    
    if ($env === AppEnvironment::Development) {
        // 开发环境配置
        $container->bind(LoggerInterface::class, DebugLogger::class);
    } else {
        // 生产环境配置
        $container->bind(LoggerInterface::class, ProductionLogger::class);
    }
});
```

### 控制台应用

Kernel 的 `bootstrap()` 方法主要用于控制台应用的启动，它会自动处理控制台输入输出和命令分发：

```php
use Hi\Kernel;
use Hi\Kernel\ConsoleInterface;
use Hi\Kernel\InputInterface;
use Hi\Kernel\OutputInterface;

$kernel = new Kernel(__DIR__);

// 配置控制台命令（通过属性自动发现）
$kernel->load(function (ConsoleInterface $console) {
    // 控制台接口会自动发现带有属性的命令类
    // 无需手动注册，框架会扫描相关目录
});

// 启动控制台应用
// bootstrap 方法会：
// 1. 创建 Input/Output 实例
// 2. 解析命令行参数
// 3. 调用 ConsoleInterface::run() 执行命令
// 4. 返回退出码
$exitCode = $kernel->bootstrap($argv);
exit($exitCode);
```

#### 自定义控制台命令示例

```php
use Hi\Attributes\Console\Command;
use Hi\Attributes\Console\Action;

#[Command('migrate', desc: '数据库迁移命令')]
class MigrateCommand
{
    #[Action('run', desc: '执行数据库迁移')]
    public function run(): int
    {
        echo "开始数据库迁移...\n";
        
        try {
            // 执行迁移逻辑
            echo "迁移完成!\n";
            return 0; // 成功
        } catch (\Exception $e) {
            echo "迁移失败: " . $e->getMessage() . "\n";
            return 1; // 失败
        }
    }
}
```

## 生命周期钩子

### 启动前钩子

Kernel 的 `load()` 方法用于在应用启动前执行初始化逻辑：

```php
$kernel->load(function () {
    // 在应用启动前执行
    echo "应用正在启动...\n";
    
    // 设置时区
    date_default_timezone_set('Asia/Shanghai');
    
    // 其他初始化工作
    ini_set('memory_limit', '256M');
});
```

### 服务配置钩子

```php
use Hi\Http\Application;
use Spiral\Core\Container;

$kernel->load(function (Container $container) {
    // 配置HTTP应用
    $container->bindSingleton(Application::class, function () {
        $app = new Application();
        
        // 添加全局中间件
        $app->uses([
            CorsMiddleware::class,
            AuthMiddleware::class,
        ]);
        
        return $app;
    });
});
```

## 异常处理

### 自定义异常处理器

Hi Framework 的异常处理器基于记者模式，支持多个异常报告器：

```php
use Hi\Exception\ExceptionHandlerInterface;
use Hi\Exception\ExceptionHandler;
use Hi\Exception\ExceptionReporterInterface;

class CustomExceptionHandler extends ExceptionHandler
{
    public function handle(\Throwable $throwable, mixed $context = null): mixed
    {
        // 先报告异常
        $this->report($throwable, $context);
        
        // 如果是HTTP上下文，返回HTTP响应
        if ($context instanceof \Hi\Http\Context) {
            return new \Hi\Http\Message\Response(
                body: json_encode([
                    'error' => 'Internal Server Error',
                    'message' => $throwable->getMessage(),
                    'code' => $throwable->getCode()
                ]),
                statusCode: 500,
                headers: ['Content-Type' => 'application/json']
            );
        }
        
        // 默认返回错误消息
        return $throwable->getMessage();
    }
}

// 使用自定义异常处理器
$kernel = new Kernel(
    rootDirectory: __DIR__,
    exceptionHandler: new CustomExceptionHandler()
);
```

### 添加异常报告器

```php
use Hi\Exception\ExceptionReporterInterface;

class SentryReporter implements ExceptionReporterInterface
{
    public function report(\Throwable $throwable, mixed $context = null): void
    {
        // 发送到 Sentry
        \Sentry\captureException($throwable);
    }
}

// 添加自定义报告器
$kernel->load(function (\Hi\Exception\ExceptionHandler $handler) {
    $handler->addReporter(new SentryReporter());
    
    // 或者使用闭包
    $handler->addReporter(function (\Throwable $throwable) {
        error_log("Exception: " . $throwable->getMessage());
    });
});
```

### 排除特定异常

```php
$kernel->load(function (\Hi\Exception\ExceptionHandler $handler) {
    // 不报告特定类型的异常
    $handler->dontReport(\InvalidArgumentException::class);
    $handler->dontReport(\RuntimeException::class);
});
```

## 容器配置

### 服务绑定

Hi Framework 使用 Spiral Container，支持多种绑定方式：

```php
use Spiral\Core\Container;

$kernel->load(function (Container $container) {
    // 单例绑定 - 整个应用生命周期只创建一次
    $container->bindSingleton(DatabaseManager::class, function () {
        return new DatabaseManager(['host' => 'localhost']);
    });
    
    // 瞬态绑定 - 每次请求都创建新实例
    $container->bind(EmailService::class, function () {
        return new SmtpEmailService(['smtp' => 'localhost']);
    });
    
    // 接口绑定 - 将接口绑定到具体实现
    $container->bind(CacheInterface::class, RedisCacheService::class);
    
    // 直接绑定实例
    $container->bindSingleton('app.version', '1.0.0');
});
```

### 自动装配和构造器注入

Spiral Container 支持自动装配，会自动解析构造器依赖：

```php
class UserService
{
    public function __construct(
        private DatabaseManager $db,
        private CacheInterface $cache,
        private LoggerInterface $logger
    ) {}
}

$kernel->load(function (Container $container) {
    // 自动装配 - 无需手动绑定，Container会自动解析依赖
    $userService = $container->get(UserService::class);
    
    // 也可以显式绑定用于自定义逻辑
    $container->bind(UserService::class, function (Container $container) {
        return new UserService(
            $container->get(DatabaseManager::class),
            $container->get(CacheInterface::class),
            $container->get(LoggerInterface::class)
        );
    });
});
```

## 配置管理

### 目录结构

Kernel会自动注册DirectoriesInterface服务来管理应用目录：

```php
use Hi\Kernel\DirectoriesInterface;

$kernel->load(function (DirectoriesInterface $dirs) {
    // 获取根目录（构造函数中设置的）
    $rootDir = $dirs->get('root');
    
    // 可以设置其他目录
    $dirs->set('config', $rootDir . '/config');
    $dirs->set('storage', $rootDir . '/storage');
    $dirs->set('uploads', $rootDir . '/storage/uploads');
    $dirs->set('logs', $rootDir . '/storage/logs');
});
```

### 配置加载

```php
use Hi\Kernel\ConfigInterface;

$kernel->load(function (ConfigInterface $config, DirectoriesInterface $dirs) {
    // ConfigInterface 由 Kernel 自动绑定为 Config 类
    // 具体的配置加载方式依赖于 Config 类的实现
    
    // 获取根目录
    $rootDir = $dirs->get('root');
    
    // 设置应用时区
    date_default_timezone_set('Asia/Shanghai');
});
```

## 性能优化

### 预加载关键服务

```php
use Spiral\Core\Container;

$kernel->load(function (Container $container) {
    // 预加载关键服务（如果需要）
    if ($container->has(DatabaseManager::class)) {
        $container->get(DatabaseManager::class);
    }
    
    if ($container->has(CacheManager::class)) {
        $container->get(CacheManager::class);
    }
});
```

### 减少不必要的依赖

```php
// ✅ 好的做法：延迟加载
$kernel->load(function (Container $container) {
    $container->bind(ExpensiveService::class, function () {
        return new ExpensiveService();
    });
});

// ❌ 避免：立即实例化大对象
$kernel->load(function () {
    $expensiveObject = new ExpensiveService(); // 避免这样做
});
```

## 注意事项

### 1. 内存管理

```php
// ❌ 避免在 load 回调中创建大对象
$kernel->load(function () {
    $bigArray = range(1, 1000000); // 避免这样做
});

// ✅ 使用延迟加载
$kernel->load(function (ContainerInterface $container) {
    $container->bind(ExpensiveService::class, function () {
        return new ExpensiveService();
    });
});
```

### 2. 循环依赖

```php
// ❌ 避免循环依赖
class ServiceA {
    public function __construct(ServiceB $b) {}
}
class ServiceB {
    public function __construct(ServiceA $a) {}
}

// ✅ 使用接口或工厂模式解决
interface ServiceAInterface {}
class ServiceA implements ServiceAInterface {
    public function __construct(ServiceB $b) {}
}
class ServiceB {
    public function __construct(ServiceAInterface $a) {}
}
```

### 3. 异常处理

```php
// ✅ 始终处理可能的异常
$kernel->load(function () {
    try {
        // 可能失败的初始化代码
        connectToExternalService();
    } catch (\Exception $e) {
        // 记录错误但不阻止应用启动
        logger()->warning('External service unavailable', ['error' => $e->getMessage()]);
    }
});
```

### 4. 测试考虑

```php
// 为测试环境提供特殊配置
if (defined('PHPUNIT_RUNNING')) {
    $kernel->load(function (ContainerInterface $container) {
        $container->bind(DatabaseManager::class, InMemoryDatabase::class);
        $container->bind(EmailService::class, MockEmailService::class);
    });
}
```

## 最佳实践

1. **单一职责**: 保持 `load()` 回调简洁，专注于特定的配置任务
2. **类型安全**: 始终使用 PHP 8+ 的类型提示和返回类型声明
3. **错误处理**: 妥善处理初始化过程中可能出现的异常
4. **性能考虑**: 避免在应用启动时执行耗时操作，使用延迟加载
5. **依赖注入**: 充分利用 Spiral Container 的自动装配能力
6. **环境感知**: 根据不同环境配置不同的服务实现

## 实际使用示例

基于实际的 Kernel 实现，完整的应用启动示例：

```php
<?php

use Hi\Kernel;
use Hi\Exception\ExceptionHandler;
use Hi\Http\Application;
use Spiral\Core\Container;

// 创建内核
$kernel = new Kernel(
    rootDirectory: __DIR__,
    exceptionHandler: new ExceptionHandler(),
    handleErrors: true
);

// 配置应用
$kernel->load(function (Container $container) {
    // 配置HTTP应用
    $container->bindSingleton(Application::class, function () {
        $app = new Application();
        
        // 基本路由
        $app->get('/', function () {
            return ['message' => 'Hello Hi Framework!'];
        });
        
        return $app;
    });
});

// 启动应用
exit($kernel->bootstrap($argv));
``` 