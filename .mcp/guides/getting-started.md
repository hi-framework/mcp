# 开始使用 Hi Framework

Hi Framework 是一个现代的 PHP 8.2+ 框架库，专注于类型安全和高性能。本文档将指导你如何在项目中集成和使用 Hi Framework。

## 安装

通过 Composer 安装 Hi Framework：

```bash
composer require hi/framework
```

## 创建基础项目结构

创建一个新的项目目录并设置基本结构：

```bash
mkdir my-hi-app
cd my-hi-app

# 初始化 composer 项目
composer init

# 安装 Hi Framework
composer require hi/framework

# 创建基本目录结构
mkdir -p {app/Http/Controller,app/Console/Command,config,public}
```


## 创建应用入口

创建应用的主入口文件 `index.php`：

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Hi\Kernel;
use Hi\Http\Application;
use Spiral\Core\Container;

// 创建内核
$kernel = new Kernel(__DIR__);

// 配置应用
$kernel->load(function (Container $container) {
    // 注册HTTP应用
    $container->bindSingleton(Application::class, function () {
        $app = new Application();
        
        // 基本路由
        $app->get('/', function () {
            return ['message' => 'Hello Hi Framework!', 'time' => date('Y-m-d H:i:s')];
        });
        
        $app->get('/health', function () {
            return ['status' => 'ok'];
        });
        
        return $app;
    });
});

// 启动HTTP服务器
$app = \construct(Application::class);
$app->listen(8080, '0.0.0.0');
```

## 运行应用

### 使用PHP内置服务器

对于开发环境，可以使用PHP内置服务器快速启动：

```bash
php -S localhost:8080 index.php
```

### 使用Swoole (推荐生产环境)

如果安装了Swoole扩展，Hi Framework会自动使用Swoole服务器获得更好的性能：

```bash
# 安装 Swoole (macOS with Homebrew)
pecl install swoole

# 直接运行
php index.php
```

访问 `http://localhost:8080` 查看运行结果。

### 开发工具推荐

为了更好的开发体验，推荐安装以下工具：

```bash
# 文件变更监听工具（可选）
brew install watchexec

# 使用 watchexec 自动重启
watchexec --exts php --restart -- php index.php
```

## 控制台命令

Hi Framework 支持基于属性的控制台命令系统。创建控制台应用入口 `console.php`：

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Hi\Kernel;

// 创建内核
$kernel = new Kernel(__DIR__);

// 启动控制台应用
exit($kernel->bootstrap($argv));
```

现在你可以通过命令行使用：

```bash
# 基本用法
php console.php

# 查看帮助
php console.php --help
```


## 创建路由控制器

创建控制器文件 `app/Http/Controller/HomeController.php`：

```php
<?php

declare(strict_types=1);

namespace App\Http\Controller;

use Hi\Attributes\Http\Get;
use Hi\Attributes\Http\Post;
use Hi\Attributes\Http\Route;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

#[Route(prefix: '/')]
class HomeController
{
    #[Get('/', desc: '首页')]
    public function index(): array
    {
        return [
            'message' => 'Welcome to Hi Framework!',
            'version' => '1.0.0',
            'timestamp' => date('c')
        ];
    }

    #[Get('/hello', desc: '问候')]
    public function hello(ServerRequestInterface $request): array
    {
        // 从查询参数获取名称
        $name = $request->getQueryParams()['name'] ?? 'World';
        
        return [
            'message' => "Hello, {$name}!",
            'timestamp' => time(),
        ];
    }

    #[Post('/users', desc: '创建用户')]
    public function createUser(ServerRequestInterface $request): array
    {
        $data = json_decode($request->getBody()->getContents(), true);
        
        // 使用依赖注入获取服务
        $logger = \construct(LoggerInterface::class);
        $logger->info('Creating user', ['data' => $data]);
        
        return [
            'success' => true,
            'user_id' => 123,
            'data' => $data,
        ];
    }
}
```

### GET 查询参数处理

```php
#[Get('/search', desc: '搜索接口')]
public function search(ServerRequestInterface $request): array
{
    $query = $request->getQueryParams();
    $keyword = $query['keyword'] ?? '';
    $page = (int) ($query['page'] ?? 1);
    
    return [
        'keyword' => $keyword,
        'page' => $page,
        'results' => [],
    ];
}
```

### POST 请求体处理

```php
#[Post('/submit', desc: '提交数据')]
public function submit(ServerRequestInterface $request): array
{
    $data = json_decode($request->getBody()->getContents(), true);
    
    return [
        'received' => $data,
        'timestamp' => time(),
    ];
}
```

### 请求头处理

```php
#[Get('/info', desc: '获取请求信息')]
public function info(ServerRequestInterface $request): array
{
    $userAgent = $request->getHeaderLine('User-Agent');
    $contentType = $request->getHeaderLine('Content-Type');
    
    return [
        'user_agent' => $userAgent,
        'content_type' => $contentType,
        'method' => $request->getMethod(),
        'uri' => $request->getUri()->getPath(),
    ];
}
```

## HTTP 中间件

创建中间件文件 `app/Http/Middleware/LoggingMiddleware.php`：

```php
<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Hi\Attributes\Http\Middleware;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

#[Middleware]
class LoggingMiddleware
{
    /**
     * @param \Closure(ServerRequestInterface): ResponseInterface $next
     */
    public function handle(ServerRequestInterface $request, \Closure $next): ResponseInterface
    {
        // 请求前处理
        $logger = \construct(LoggerInterface::class);
        $logger->info('Request started', [
            'method' => $request->getMethod(),
            'uri' => $request->getUri()->getPath(),
        ]);

        $startTime = microtime(true);

        try {
            // 调用下一个中间件或控制器
            $response = $next($request);
            
            // 请求后处理
            $duration = microtime(true) - $startTime;
            $logger->info('Request completed', [
                'duration' => $duration,
                'status' => $response->getStatusCode(),
            ]);
            
            return $response;
            
        } catch (\Throwable $e) {
            $duration = microtime(true) - $startTime;
            $logger->error('Request failed', [
                'duration' => $duration,
                'error' => $e->getMessage(),
            ]);
            
            throw $e;
        }
    }
}
```

### 在应用中注册中间件

在 `index.php` 中注册全局中间件：

```php
$app->uses([
    \App\Http\Middleware\LoggingMiddleware::class,
    // 其他中间件...
]);
```

## 创建控制台命令

创建控制台命令 `app/Console/Command/DemoCommand.php`：

```php
<?php

declare(strict_types=1);

namespace App\Console\Command;

use Hi\Attributes\Console\Action;
use Hi\Attributes\Console\Command;
use Psr\Log\LoggerInterface;

#[Command('demo', desc: '示例命令')]
class DemoCommand
{
    #[Action('hello', desc: '打印问候信息')]
    public function hello(): int
    {
        $logger = \construct(LoggerInterface::class);
        $logger->info('Hello from console command!');
        
        echo "Hello, Hi Framework!\n";
        echo "当前时间: " . date('Y-m-d H:i:s') . "\n";
        
        return 0; // 成功退出
    }

    #[Action('task', desc: '执行示例任务')]
    public function task(): int
    {
        $logger = \construct(LoggerInterface::class);
        
        echo "开始执行任务...\n";
        
        for ($i = 1; $i <= 5; $i++) {
            $logger->info("Processing task step {$i}");
            echo "步骤 {$i} 完成\n";
            
            // 模拟处理时间
            sleep(1);
        }
        
        echo "任务完成！\n";
        return 0;
    }
}
```

### 运行控制台命令

```bash
# 运行问候命令
php console.php demo hello

# 运行任务命令
php console.php demo task
```

## 作用域隔离

Hi Framework 提供 `\scope()` 函数用于作用域隔离，可以在特定范围内绑定服务实例：

```php
// 在中间件中使用作用域
public function handle(ServerRequestInterface $request, \Closure $next): ResponseInterface
{
    // 为特定用户提供定制服务
    return \scope(
        fn: function () use ($request, $next): ResponseInterface {
            // 在这个作用域中执行
            return $next($request);
        },
        bindings: [
            // 绑定特定的服务实例
            LoggerInterface::class => new CustomLogger(),
            'user.id' => $request->getHeaderLine('X-User-ID'),
        ],
    );
}
```

## 完整的应用示例

整合以上所有内容的完整 `index.php` 示例：

```php
<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Hi\Kernel;
use Hi\Http\Application;
use Spiral\Core\Container;
use App\Http\Controller\HomeController;
use App\Http\Middleware\LoggingMiddleware;

// 创建内核
$kernel = new Kernel(__DIR__);

// 配置应用
$kernel->load(function (Container $container) {
    $container->bindSingleton(Application::class, function () {
        $app = new Application();
        
        // 注册全局中间件
        $app->uses([
            LoggingMiddleware::class,
        ]);
        
        // 基本路由（如果不使用属性路由）
        $app->get('/', function () {
            return ['message' => 'Hi Framework API', 'version' => '1.0.0'];
        });
        
        return $app;
    });
});

// 启动HTTP服务器
$app = \construct(Application::class);
echo "Server starting at http://localhost:8080\n";
$app->listen(8080, '0.0.0.0');
```

## 下一步

现在您已经有了一个基本的 Hi Framework 应用程序！接下来可以：

1. 学习 [HTTP 路由系统](./http/routing.md) 了解更高级的路由功能
2. 查看 [Kernel 组件](./components/kernel.md) 深入理解框架核心
3. 探索 [数据库组件](./components/database.md) 掌握数据库操作
4. 了解 [缓存系统](./components/cache.md) 优化应用性能
5. 阅读 [事件系统](./events.md) 实现松耦合架构
