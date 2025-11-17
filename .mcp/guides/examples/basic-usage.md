# 基本使用示例

本文档提供 Typing PHP Framework 的基本使用示例，涵盖常见的开发场景和最佳实践。

## 快速开始示例

### 创建第一个应用

```php
<?php
// bootstrap.php

declare(strict_types=1);

use Hi\Attributes\ConsoleAttributeLoader;
use Hi\Attributes\HttpAttributeLoader;
use Hi\Http\Application;
use Hi\Http\ApplicationInterface;
use Hi\Http\Router;
use Hi\Kernel;
use Hi\Kernel\ConfigInterface;
use Hi\Kernel\Console;
use Hi\Kernel\ConsoleInterface;
use Spiral\Core\Container;

require __DIR__ . '/vendor/autoload.php';

// 创建内核并配置依赖注入容器
$kernel = (new Kernel(__DIR__))->load(static function (Container $di, ConfigInterface $config): void {
    
    // 配置控制台命令加载器
    $di->bindSingleton(ConsoleInterface::class, static fn (Container $di): mixed => $di->make(Console::class, [
        'loader' => $di->make(ConsoleAttributeLoader::class, [
            'directories' => [
                __DIR__ . '/app/Transport/Console',
            ],
        ]),
    ]));

    // 配置 HTTP 应用和路由
    $di->bindSingleton(ApplicationInterface::class, static fn () => new Application(
        router: new Router(
            middlewares: [
                App\Transport\Http\Middleware\Scope::class,
            ],
            loader: $di->make(HttpAttributeLoader::class, [
                'directories' => [
                    __DIR__ . '/app/Transport/Http',
                ],
            ]),
        ),
    ));
});

// 启动应用
$kernel->bootstrap($argv ?? ['', 'http', 'start']);
```

### 路由控制器示例

```php
<?php
// app/Transport/Http/Routes/UserController.php

declare(strict_types=1);

namespace App\Transport\Http\Routes;

use Hi\Attributes\Http\Get;
use Hi\Attributes\Http\Post;
use Hi\Attributes\Http\Put;
use Hi\Attributes\Http\Delete;
use Hi\Attributes\Http\Route;
use Hi\Http\Context;
use Psr\Log\LoggerInterface;

#[Route(prefix: '/api/users')]
class UserController
{
    #[Get(pattern: '/', desc: '获取用户列表')]
    public function index(Context $ctx): array
    {
        $logger = \construct(LoggerInterface::class);
        $query = $ctx->getRequest()->getQueryParams();
        
        // 分页参数
        $page = (int) ($query['page'] ?? 1);
        $limit = (int) ($query['limit'] ?? 10);
        
        $logger->info('Getting users list', ['page' => $page, 'limit' => $limit]);
        
        // 模拟从数据库获取用户数据
        $users = [
            ['id' => 1, 'name' => 'Alice', 'email' => 'alice@example.com'],
            ['id' => 2, 'name' => 'Bob', 'email' => 'bob@example.com'],
        ];
        
        return [
            'success' => true,
            'data' => $users,
            'total' => count($users),
            'page' => $page,
            'limit' => $limit,
        ];
    }
    
    #[Get(pattern: '/show', desc: '获取单个用户')]
    public function show(Context $ctx): array
    {
        $query = $ctx->getRequest()->getQueryParams();
        $id = (int) ($query['id'] ?? 0);
        
        if ($id <= 0) {
            return [
                'success' => false,
                'error' => 'User ID is required',
            ];
        }
        
        $logger = \construct(LoggerInterface::class);
        $logger->info('Getting user', ['id' => $id]);
        
        // 模拟用户数据
        $user = ['id' => $id, 'name' => 'User ' . $id, 'email' => "user{$id}@example.com"];
        
        return [
            'success' => true,
            'data' => $user,
        ];
    }
    
    #[Post(pattern: '/', desc: '创建用户')]
    public function store(Context $ctx): array
    {
        $request = $ctx->getRequest();
        $data = $request->getParsedBody();
        
        $logger = \construct(LoggerInterface::class);
        $logger->info('Creating user', ['data' => $data]);
        
        // 验证数据
        if (empty($data['name']) || empty($data['email'])) {
            return [
                'success' => false,
                'error' => 'Name and email are required',
            ];
        }
        
        // 模拟创建用户
        $user = [
            'id' => rand(1000, 9999),
            'name' => $data['name'],
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        
        return [
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user,
        ];
    }
    
    #[Put(pattern: '/update', desc: '更新用户')]
    public function update(Context $ctx): array
    {
        $request = $ctx->getRequest();
        $data = $request->getParsedBody();
        
        // 从请求体中获取用户ID
        $id = (int) ($data['id'] ?? 0);
        
        if ($id <= 0) {
            return [
                'success' => false,
                'error' => 'User ID is required',
            ];
        }
        
        $logger = \construct(LoggerInterface::class);
        $logger->info('Updating user', ['id' => $id, 'data' => $data]);
        
        return [
            'success' => true,
            'message' => 'User updated successfully',
            'data' => ['id' => $id, ...$data, 'updated_at' => date('Y-m-d H:i:s')],
        ];
    }
    
    #[Delete(pattern: '/delete', desc: '删除用户')]
    public function destroy(Context $ctx): array
    {
        $request = $ctx->getRequest();
        $data = $request->getParsedBody();
        
        // 从请求体中获取用户ID
        $id = (int) ($data['id'] ?? 0);
        
        if ($id <= 0) {
            return [
                'success' => false,
                'error' => 'User ID is required',
            ];
        }
        
        $logger = \construct(LoggerInterface::class);
        $logger->info('Deleting user', ['id' => $id]);
        
        return [
            'success' => true,
            'message' => 'User deleted successfully',
        ];
    }
}
```

## 中间件示例

### 基础中间件

```php
<?php
// app/Transport/Http/Middleware/Scope.php

declare(strict_types=1);

namespace App\Transport\Http\Middleware;

use Hi\Attributes\Http\Middleware;
use Hi\Exception\ExceptionHandler;
use Hi\Http\Context;
use Hi\Kernel\Logger\LoggerFactoryInterface;
use Psr\Log\LoggerInterface;

#[Middleware]
class Scope
{
    protected LoggerFactoryInterface $loggerFactory;
    protected ExceptionHandler $exceptionHandler;

    public function __construct()
    {
        $this->loggerFactory = \construct(LoggerFactoryInterface::class);
        $this->exceptionHandler = \construct(ExceptionHandler::class);
    }

    /**
     * @param \Closure(Context): mixed $next
     */
    public function handle(Context $ctx, \Closure $next): mixed
    {
        $level = \config('logger.level', 'debug');
        $newLogger = false;

        // 为每个请求创建一个对应的 logger 单例
        $logger = $this->loggerFactory->get(
            $ctx->routeIndex,
            $level,
            $newLogger,
        );

        return \scope(
            scope: function () use ($ctx, $next): mixed {
                try {
                    return $next($ctx);
                } catch (\Throwable $th) {
                    return $this->exceptionHandler->handle($th, $ctx);
                }
            },
            bindings: [
                LoggerInterface::class => $logger,
            ],
        );
    }
}
```

### 认证中间件

```php
<?php
// app/Transport/Http/Middleware/AuthMiddleware.php

declare(strict_types=1);

namespace App\Transport\Http\Middleware;

use Hi\Attributes\Http\Middleware;
use Hi\Http\Context;
use Hi\Http\Message\Response;
use Psr\Log\LoggerInterface;

#[Middleware]
class AuthMiddleware
{
    /**
     * @param \Closure(Context): mixed $next
     */
    public function handle(Context $ctx, \Closure $next): mixed
    {
        $request = $ctx->getRequest();
        $token = $request->getHeaderLine('Authorization');
        
        $logger = \construct(LoggerInterface::class);
        
        if (empty($token)) {
            $logger->warning('Missing authorization token');
            return new Response(
                body: json_encode(['error' => 'Authorization token required']),
                status: 401,
                headers: ['Content-Type' => 'application/json']
            );
        }
        
        // 验证令牌（这里简化处理）
        if (!$this->validateToken($token)) {
            $logger->warning('Invalid authorization token', ['token' => $token]);
            return new Response(
                body: json_encode(['error' => 'Invalid authorization token']),
                status: 403,
                headers: ['Content-Type' => 'application/json']
            );
        }
        
        $logger->info('User authenticated successfully');
        
        return $next($ctx);
    }
    
    private function validateToken(string $token): bool
    {
        // 简化的令牌验证逻辑
        return str_starts_with($token, 'Bearer ') && strlen($token) > 10;
    }
}
```

## 控制台命令示例

### 基础命令

```php
<?php
// app/Transport/Console/DemoCommand.php

declare(strict_types=1);

namespace App\Transport\Console;

use Hi\Attributes\Console\Action;
use Hi\Attributes\Console\Command;
use Hi\Runtime\AppRuntime;
use Psr\Log\LoggerInterface;

#[Command('demo', desc: '演示命令集合')]
class DemoCommand
{
    #[Action('hello', desc: '打印问候信息')]
    public function hello(): void
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Hello command executed');
        
        echo "Hello, Typing PHP Framework!\n";
        echo "Current time: " . date('Y-m-d H:i:s') . "\n";
    }

    #[Action('async-task', desc: '异步任务示例')]
    public function asyncTask(): void
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Starting async task');
        
        echo "Starting async operations...\n";
        
        // 使用异步作用域
        \async_scope(static function (): void {
            $logger = \construct(LoggerInterface::class);
            
            for ($i = 1; $i <= 3; $i++) {
                $logger->info("Async operation {$i}");
                echo "Async operation {$i} started\n";
                
                // 异步等待
                AppRuntime::coroutine()->sleep(1);
                
                echo "Async operation {$i} completed\n";
            }
        });
        
        echo "All async operations completed!\n";
    }

    #[Action('process-data', desc: '数据处理示例')]
    public function processData(): void
    {
        $logger = \construct(LoggerInterface::class);
        
        $data = [
            ['id' => 1, 'name' => 'Item 1'],
            ['id' => 2, 'name' => 'Item 2'],
            ['id' => 3, 'name' => 'Item 3'],
        ];
        
        foreach ($data as $item) {
            $logger->info('Processing item', $item);
            echo "Processing: {$item['name']}\n";
            
            // 模拟处理时间
            AppRuntime::coroutine()->sleep(0.5);
        }
        
        echo "Data processing completed!\n";
    }
}
```

### 数据库操作命令

```php
<?php
// app/Transport/Console/DatabaseCommand.php

declare(strict_types=1);

namespace App\Transport\Console;

use Hi\Attributes\Console\Action;
use Hi\Attributes\Console\Command;
use Psr\Log\LoggerInterface;

#[Command('db', desc: '数据库操作命令')]
class DatabaseCommand
{
    #[Action('migrate', desc: '执行数据库迁移')]
    public function migrate(): void
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Starting database migration');
        
        echo "Running database migrations...\n";
        
        // 模拟迁移过程
        $migrations = [
            'create_users_table',
            'create_posts_table', 
            'add_indexes',
        ];
        
        foreach ($migrations as $migration) {
            echo "Running: {$migration}\n";
            $logger->info('Running migration', ['migration' => $migration]);
            
            // 模拟执行时间
            \Hi\Runtime\AppRuntime::coroutine()->sleep(1);
            
            echo "Completed: {$migration}\n";
        }
        
        echo "All migrations completed successfully!\n";
    }

    #[Action('seed', desc: '填充测试数据')]
    public function seed(): void
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Starting database seeding');
        
        echo "Seeding database with test data...\n";
        
        // 模拟数据填充
        $seeders = [
            'UserSeeder' => 100,
            'PostSeeder' => 500,
            'CommentSeeder' => 1000,
        ];
        
        foreach ($seeders as $seeder => $count) {
            echo "Running {$seeder} ({$count} records)...\n";
            $logger->info('Running seeder', ['seeder' => $seeder, 'count' => $count]);
            
            \Hi\Runtime\AppRuntime::coroutine()->sleep(0.5);
            
            echo "Completed {$seeder}\n";
        }
        
        echo "Database seeding completed!\n";
    }
}
```

## Kafka 消息队列示例

### 消息生产者

```php
<?php
// app/Transport/Queue/DemoProducer.php

declare(strict_types=1);

namespace App\Transport\Queue;

use Hi\Kafka\AbstractProducer;
use Hi\Kafka\Metadata;
use Hi\Sidecar\BridgeInterface;

class DemoProducer extends AbstractProducer
{
    protected string $topic = 'demo-topic';
    
    public function __construct(private array $data)
    {
    }

    public function send(BridgeInterface $bridge): void
    {
        $message = [
            'id' => uniqid(),
            'timestamp' => time(),
            'data' => $this->data,
        ];
        
        $metadata = new Metadata(
            topic: $this->topic,
            partition: 0,
            value: json_encode($message),
        );
        
        $bridge->produce($metadata);
    }
}
```

### 消息消费者

```php
<?php
// app/Transport/Queue/ListenDemoConsumer.php

declare(strict_types=1);

namespace App\Transport\Queue;

use Hi\Kafka\AbstractConsumer;
use Hi\Kafka\Metadata;
use Hi\Sidecar\BridgeInterface;
use Psr\Log\LoggerInterface;

class ListenDemoConsumer extends AbstractConsumer
{
    protected string $topic = 'demo-topic';
    protected string $groupId = 'demo-group';

    public function execute(BridgeInterface $bridge): void
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Starting demo consumer');
        
        echo "Demo consumer started, listening for messages...\n";
        
        $bridge->consume($this->topic, $this->groupId, function (Metadata $metadata) use ($logger) {
            $message = json_decode($metadata->value, true);
            
            $logger->info('Received message', $message);
            echo "Received message: " . json_encode($message, JSON_PRETTY_PRINT) . "\n";
            
            // 处理消息逻辑
            $this->processMessage($message);
        });
    }
    
    private function processMessage(array $message): void
    {
        $logger = \construct(LoggerInterface::class);
        
        try {
            // 模拟消息处理
            $logger->info('Processing message', ['id' => $message['id']]);
            
            // 模拟处理时间
            \Hi\Runtime\AppRuntime::coroutine()->sleep(1);
            
            $logger->info('Message processed successfully', ['id' => $message['id']]);
            
        } catch (\Throwable $e) {
            $logger->error('Message processing failed', [
                'id' => $message['id'],
                'error' => $e->getMessage(),
            ]);
        }
    }
}
```

### Kafka 命令控制器

```php
<?php
// app/Transport/Console/KafkaCommand.php

declare(strict_types=1);

namespace App\Transport\Console;

use App\Transport\Queue\DemoProducer;
use App\Transport\Queue\ListenDemoConsumer;
use Hi\Attributes\Console\Action;
use Hi\Attributes\Console\Command;
use Hi\Kafka\KafkaManager;
use Psr\Log\LoggerInterface;

#[Command('kafka', desc: 'Kafka 消息队列操作')]
class KafkaCommand
{
    #[Action('consume-demo', desc: '消费演示消息')]
    public function consumeDemo(): void
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Starting Kafka consumer');
        
        \construct(KafkaManager::class)->consume(ListenDemoConsumer::class);
    }

    #[Action('produce-demo', desc: '生产演示消息')]
    public function produceDemo(): void
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Starting Kafka producer');
        
        $count = 0;
        
        for (;;) {
            $data = [
                'count' => ++$count,
                'message' => "Demo message {$count}",
                'timestamp' => time(),
            ];
            
            \construct(KafkaManager::class)->produce(new DemoProducer($data));
            
            $logger->info('Message produced', ['count' => $count]);
            echo "Produced message {$count}\n";
            
            // 每 10 条消息暂停一下
            if (0 === $count % 10) {
                \usleep(10_000); // 10ms
            }
        }
    }

    #[Action('test-message', desc: '发送测试消息')]
    public function testMessage(): void
    {
        $logger = \construct(LoggerInterface::class);
        
        $testData = [
            'test' => true,
            'message' => 'This is a test message',
            'timestamp' => time(),
            'random' => rand(1000, 9999),
        ];
        
        \construct(KafkaManager::class)->produce(new DemoProducer($testData));
        
        $logger->info('Test message sent', $testData);
        echo "Test message sent successfully!\n";
    }
}
```

## 配置管理

### 应用配置

```php
<?php
// config/app.php

return [
    'name' => \env('APP_NAME', 'Typing PHP App'),
    'env' => \env('APP_ENV', 'production'),
    'debug' => \env('APP_DEBUG', false),
    'timezone' => \env('APP_TIMEZONE', 'UTC'),
    'locale' => \env('APP_LOCALE', 'en'),
];
```

### 日志配置

```php
<?php
// config/logger.php

return [
    'level' => \env('LOG_LEVEL', 'info'),
    'path' => \env('LOG_PATH', __DIR__ . '/../storage/logs/app.log'),
    'max_files' => \env('LOG_MAX_FILES', 30),
];
```

### 服务配置

```php
<?php
// config/services.php

return [
    'kafka' => [
        'brokers' => \env('KAFKA_BROKERS', 'localhost:9092'),
        'group_id' => \env('KAFKA_GROUP_ID', 'typing-php-group'),
    ],
    
    'database' => [
        'host' => \env('DB_HOST', 'localhost'),
        'port' => \env('DB_PORT', 3306),
        'database' => \env('DB_DATABASE', 'typing_php'),
        'username' => \env('DB_USERNAME', 'root'),
        'password' => \env('DB_PASSWORD', ''),
    ],
    
    'redis' => [
        'host' => \env('REDIS_HOST', 'localhost'),
        'port' => \env('REDIS_PORT', 6379),
        'password' => \env('REDIS_PASSWORD', null),
    ],
];
```

## 工具函数使用

### 依赖注入和配置

```php
<?php

// 获取服务实例
$logger = \construct(LoggerInterface::class);
$config = \construct(ConfigInterface::class);

// 获取配置值
$appName = \config('app.name', 'Default App');
$debug = \config('app.debug', false);
$logLevel = \config('logger.level', 'info');

// 在控制器中使用
class ExampleController
{
    #[Get(pattern: '/config', desc: '获取配置信息')]
    public function getConfig(): array
    {
        return [
            'app_name' => \config('app.name'),
            'environment' => \config('app.env'),
            'debug_mode' => \config('app.debug'),
        ];
    }
}
```

### 异步作用域

```php
<?php

// 异步执行多个任务
\async_scope(static function (): void {
    $logger = \construct(LoggerInterface::class);
    
    // 任务 1
    $logger->info('Task 1 started');
    \Hi\Runtime\AppRuntime::coroutine()->sleep(1);
    $logger->info('Task 1 completed');
    
    // 任务 2
    $logger->info('Task 2 started');
    \Hi\Runtime\AppRuntime::coroutine()->sleep(2);
    $logger->info('Task 2 completed');
});

// 作用域绑定
\scope(
    scope: function (): mixed {
        $logger = \construct(LoggerInterface::class);
        $logger->info('In custom scope');
        return 'result';
    },
    bindings: [
        LoggerInterface::class => $customLogger,
    ],
);
```

## 路由和参数处理

### 查询参数示例

```php
<?php

#[Route(prefix: '/api')]
class SearchController
{
    #[Get(pattern: '/search', desc: '搜索接口')]
    public function search(Context $ctx): array
    {
        $query = $ctx->getRequest()->getQueryParams();
        
        $keyword = $query['keyword'] ?? '';
        $page = (int) ($query['page'] ?? 1);
        $limit = (int) ($query['limit'] ?? 10);
        $sort = $query['sort'] ?? 'created_at';
        
        return [
            'keyword' => $keyword,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
            ],
            'sort' => $sort,
            'results' => [],
        ];
    }
    
    #[Get(pattern: '/filter', desc: '过滤接口')]
    public function filter(Context $ctx): array
    {
        $query = $ctx->getRequest()->getQueryParams();
        
        // 支持多值参数
        $categories = isset($query['category']) ? (array) $query['category'] : [];
        $tags = isset($query['tags']) ? explode(',', $query['tags']) : [];
        $priceRange = [
            'min' => (float) ($query['price_min'] ?? 0),
            'max' => (float) ($query['price_max'] ?? 0),
        ];
        
        return [
            'filters' => [
                'categories' => $categories,
                'tags' => $tags,
                'price_range' => $priceRange,
            ],
            'results' => [],
        ];
    }
}
```

### 请求体参数示例

```php
<?php

#[Route(prefix: '/api')]
class DataController
{
    #[Post(pattern: '/process', desc: '处理数据')]
    public function process(Context $ctx): array
    {
        $data = $ctx->getRequest()->getParsedBody();
        
        // 验证必需字段
        $required = ['action', 'data'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                return [
                    'success' => false,
                    'error' => "Field '{$field}' is required",
                ];
            }
        }
        
        $action = $data['action'];
        $payload = $data['data'];
        $options = $data['options'] ?? [];
        
        return [
            'success' => true,
            'action' => $action,
            'processed_data' => $payload,
            'options' => $options,
            'timestamp' => time(),
        ];
    }
    
    #[Put(pattern: '/bulk-update', desc: '批量更新')]
    public function bulkUpdate(Context $ctx): array
    {
        $data = $ctx->getRequest()->getParsedBody();
        
        $items = $data['items'] ?? [];
        if (empty($items) || !is_array($items)) {
            return [
                'success' => false,
                'error' => 'Items array is required',
            ];
        }
        
        $updated = [];
        foreach ($items as $item) {
            if (empty($item['id'])) {
                continue;
            }
            
            $updated[] = [
                'id' => $item['id'],
                'status' => 'updated',
                'timestamp' => time(),
            ];
        }
        
        return [
            'success' => true,
            'updated_count' => count($updated),
            'updated_items' => $updated,
        ];
    }
}
```

## 运行应用

### HTTP 服务器

```bash
# 启动 HTTP 服务器
php bootstrap.php http start

# 指定端口
php bootstrap.php http start --port=8080

# 指定主机
php bootstrap.php http start --host=0.0.0.0
```

### 控制台命令

```bash
# 查看所有可用命令
php bootstrap.php

# 运行特定命令
php bootstrap.php demo hello
php bootstrap.php demo async-task
php bootstrap.php db migrate
php bootstrap.php kafka produce-demo
```

### API 测试示例

```bash
# 获取用户列表 (带分页)
curl "http://localhost:9527/api/users/?page=1&limit=5"

# 获取单个用户
curl "http://localhost:9527/api/users/show?id=123"

# 创建用户
curl -X POST http://localhost:9527/api/users/ \
  -H "Content-Type: application/json" \
  -d '{"name":"John Doe","email":"john@example.com"}'

# 更新用户
curl -X PUT http://localhost:9527/api/users/update \
  -H "Content-Type: application/json" \
  -d '{"id":123,"name":"John Smith","email":"johnsmith@example.com"}'

# 搜索
curl "http://localhost:9527/api/search?keyword=test&page=1&limit=10&sort=name"

# 过滤
curl "http://localhost:9527/api/filter?category[]=electronics&category[]=books&tags=sale,new&price_min=10&price_max=100"
```

这些示例展示了 Typing PHP Framework 的实际使用方式，**注意所有路由都使用完全匹配模式，参数通过查询参数或请求体传递，而不是路径变量**。 