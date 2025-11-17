# Http 路由

HTTP 路由组件是 Typing PHP Framework 的核心组件之一，负责处理 HTTP 请求的路由分发、中间件处理和响应生成。

## 设计思路

### 核心特性

- **完全匹配路由**：使用精确路径匹配，不支持路径变量
- **属性驱动**：通过 PHP 属性定义路由和中间件
- **高性能**：编译时路由解析，运行时直接匹配
- **中间件管道**：支持全局和路由级中间件
- **类型安全**：强类型参数绑定和依赖注入
- **PSR 兼容**：遵循 PSR-7 和 PSR-15 标准

### 架构设计

```
请求 -> Router -> 中间件管道 -> 控制器 -> 响应
  |       |         |           |        |
  |       |         |           |        |-> JSON/HTML/文件
  |       |         |           |-> 参数注入
  |       |         |-> 认证/日志/CORS
  |       |-> 路由匹配
  |-> HTTP 请求解析
```

## 基本使用

### 路由定义

使用属性定义路由：

```php
<?php

declare(strict_types=1);

namespace App\Transport\Http\Routes;

use Hi\Attributes\Http\Get;
use Hi\Attributes\Http\Post;
use Hi\Attributes\Http\Put;
use Hi\Attributes\Http\Delete;
use Hi\Attributes\Http\Route;
use Hi\Http\Context;

#[Route(prefix: '/api/v1')]
class UserController
{
    #[Get(pattern: '/', desc: '获取用户列表')]
    public function index(Context $ctx): array
    {
        $query = $ctx->getRequest()->getQueryParams();
        $page = (int) ($query['page'] ?? 1);
        $limit = (int) ($query['limit'] ?? 10);
        
        return [
            'data' => [],
            'pagination' => ['page' => $page, 'limit' => $limit],
        ];
    }
    
    #[Get(pattern: '/profile', desc: '获取用户资料')]
    public function profile(Context $ctx): array
    {
        $query = $ctx->getRequest()->getQueryParams();
        $userId = (int) ($query['user_id'] ?? 0);
        
        return ['user_id' => $userId, 'profile' => []];
    }
    
    #[Post(pattern: '/create', desc: '创建用户')]
    public function create(Context $ctx): array
    {
        $data = $ctx->getRequest()->getParsedBody();
        
        return [
            'success' => true,
            'user_id' => rand(1000, 9999),
            'data' => $data,
        ];
    }
}
```

### 支持的 HTTP 方法

```php
<?php

use Hi\Attributes\Http\Get;
use Hi\Attributes\Http\Post;
use Hi\Attributes\Http\Put;
use Hi\Attributes\Http\Delete;
use Hi\Attributes\Http\Patch;
use Hi\Attributes\Http\Options;
use Hi\Attributes\Http\Any;

class ApiController
{
    #[Get(pattern: '/users', desc: 'GET 请求')]
    public function getUsers(): array { return []; }
    
    #[Post(pattern: '/users', desc: 'POST 请求')]
    public function createUser(): array { return []; }
    
    #[Put(pattern: '/users/update', desc: 'PUT 请求')]
    public function updateUser(): array { return []; }
    
    #[Delete(pattern: '/users/delete', desc: 'DELETE 请求')]
    public function deleteUser(): array { return []; }
    
    #[Patch(pattern: '/users/patch', desc: 'PATCH 请求')]
    public function patchUser(): array { return []; }
    
    #[Options(pattern: '/users/options', desc: 'OPTIONS 请求')]
    public function optionsUser(): array { return []; }
    
    #[Any(pattern: '/users/any', desc: '支持所有 HTTP 方法')]
    public function anyMethodUser(): array { return []; }
}
```

## 路由组

使用 `prefix` 属性组织相关路由：

```php
<?php

// 用户相关路由
#[Route(prefix: '/api/users')]
class UserController
{
    #[Get(pattern: '/', desc: '用户列表')]          // /api/users/
    public function index(): array { return []; }
    
    #[Get(pattern: '/active', desc: '活跃用户')]    // /api/users/active
    public function active(): array { return []; }
    
    #[Post(pattern: '/register', desc: '用户注册')] // /api/users/register
    public function register(): array { return []; }
}

// 文章相关路由
#[Route(prefix: '/api/posts')]
class PostController
{
    #[Get(pattern: '/', desc: '文章列表')]          // /api/posts/
    public function index(): array { return []; }
    
    #[Get(pattern: '/featured', desc: '精选文章')]  // /api/posts/featured
    public function featured(): array { return []; }
    
    #[Post(pattern: '/publish', desc: '发布文章')]  // /api/posts/publish
    public function publish(): array { return []; }
}
```

## 参数处理

### 查询参数

```php
<?php

class SearchController
{
    #[Get(pattern: '/search', desc: '搜索接口')]
    public function search(Context $ctx): array
    {
        $query = $ctx->getRequest()->getQueryParams();
        
        // 获取查询参数
        $keyword = $query['keyword'] ?? '';
        $page = (int) ($query['page'] ?? 1);
        $limit = (int) ($query['limit'] ?? 10);
        $sort = $query['sort'] ?? 'created_at';
        $order = $query['order'] ?? 'desc';
        
        // 处理数组参数
        $categories = isset($query['category']) ? (array) $query['category'] : [];
        $tags = isset($query['tags']) ? explode(',', $query['tags']) : [];
        
        return [
            'keyword' => $keyword,
            'pagination' => ['page' => $page, 'limit' => $limit],
            'sort' => ['field' => $sort, 'order' => $order],
            'filters' => ['categories' => $categories, 'tags' => $tags],
        ];
    }
}
```

### 请求体参数

```php
<?php

class DataController
{
    #[Post(pattern: '/process', desc: '处理数据')]
    public function process(Context $ctx): array
    {
        $data = $ctx->getRequest()->getParsedBody();
        
        // 验证必需字段
        if (empty($data['action'])) {
            return ['error' => 'Action is required'];
        }
        
        $action = $data['action'];
        $payload = $data['data'] ?? [];
        $options = $data['options'] ?? [];
        
        return [
            'action' => $action,
            'payload' => $payload,
            'options' => $options,
        ];
    }
    
    #[Put(pattern: '/batch-update', desc: '批量更新')]
    public function batchUpdate(Context $ctx): array
    {
        $data = $ctx->getRequest()->getParsedBody();
        
        $items = $data['items'] ?? [];
        $updateFields = $data['fields'] ?? [];
        
        if (empty($items) || !is_array($items)) {
            return ['error' => 'Items array is required'];
        }
        
        return [
            'updated_count' => count($items),
            'fields' => $updateFields,
        ];
    }
}
```

### 请求头处理

```php
<?php

class HeaderController
{
    #[Get(pattern: '/headers', desc: '获取请求头')]
    public function headers(Context $ctx): array
    {
        $request = $ctx->getRequest();
        
        return [
            'user_agent' => $request->getHeaderLine('User-Agent'),
            'content_type' => $request->getHeaderLine('Content-Type'),
            'authorization' => $request->getHeaderLine('Authorization'),
            'custom_header' => $request->getHeaderLine('X-Custom-Header'),
            'all_headers' => $request->getHeaders(),
        ];
    }
    
    #[Post(pattern: '/api-key', desc: 'API 密钥验证')]
    public function apiKey(Context $ctx): array
    {
        $request = $ctx->getRequest();
        $apiKey = $request->getHeaderLine('X-API-Key');
        
        if (empty($apiKey)) {
            return ['error' => 'API key is required'];
        }
        
        return ['api_key' => $apiKey, 'valid' => true];
    }
}
```

## 中间件

### 创建中间件

```php
<?php

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
        
        if (empty($token)) {
            return new Response(
                body: json_encode(['error' => 'Unauthorized']),
                status: 401,
                headers: ['Content-Type' => 'application/json']
            );
        }
        
        // 验证令牌逻辑
        if (!$this->validateToken($token)) {
            return new Response(
                body: json_encode(['error' => 'Invalid token']),
                status: 403,
                headers: ['Content-Type' => 'application/json']
            );
        }
        
        return $next($ctx);
    }
    
    private function validateToken(string $token): bool
    {
        return str_starts_with($token, 'Bearer ') && strlen($token) > 10;
    }
}
```

### CORS 中间件

```php
<?php

#[Middleware]
class CorsMiddleware
{
    /**
     * @param \Closure(Context): mixed $next
     */
    public function handle(Context $ctx, \Closure $next): mixed
    {
        $request = $ctx->getRequest();
        
        // 处理预检请求
        if ($request->getMethod() === 'OPTIONS') {
            return new Response(
                headers: [
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Methods' => 'GET, POST, PUT, DELETE, OPTIONS',
                    'Access-Control-Allow-Headers' => 'Content-Type, Authorization',
                    'Access-Control-Max-Age' => '86400',
                ]
            );
        }
        
        $response = $next($ctx);
        
        // 添加 CORS 头
        if ($response instanceof ResponseInterface) {
            return $response
                ->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Credentials', 'true');
        }
        
        return $response;
    }
}
```

### 速率限制中间件

```php
<?php

#[Middleware]
class RateLimitMiddleware
{
    private array $requests = [];
    private int $limit = 100;
    private int $window = 3600; // 1小时

    /**
     * @param \Closure(Context): mixed $next
     */
    public function handle(Context $ctx, \Closure $next): mixed
    {
        $request = $ctx->getRequest();
        $clientIp = $this->getClientIp($request);
        
        $currentTime = time();
        $windowStart = $currentTime - $this->window;
        
        // 清理过期记录
        $this->requests[$clientIp] = array_filter(
            $this->requests[$clientIp] ?? [],
            fn($timestamp) => $timestamp > $windowStart
        );
        
        // 检查请求限制
        if (count($this->requests[$clientIp]) >= $this->limit) {
            return new Response(
                body: json_encode(['error' => 'Rate limit exceeded']),
                status: 429,
                headers: [
                    'Content-Type' => 'application/json',
                    'X-RateLimit-Limit' => (string) $this->limit,
                    'X-RateLimit-Remaining' => '0',
                    'X-RateLimit-Reset' => (string) ($windowStart + $this->window),
                ]
            );
        }
        
        // 记录当前请求
        $this->requests[$clientIp][] = $currentTime;
        
        return $next($ctx);
    }
    
    private function getClientIp(ServerRequestInterface $request): string
    {
        $serverParams = $request->getServerParams();
        return $serverParams['REMOTE_ADDR'] ?? '127.0.0.1';
    }
}
```

## 响应处理

### JSON 响应

```php
<?php

class ApiController
{
    #[Get(pattern: '/json', desc: 'JSON 响应')]
    public function jsonResponse(): array
    {
        return [
            'success' => true,
            'data' => ['id' => 1, 'name' => 'Example'],
            'timestamp' => time(),
        ];
    }
    
    #[Get(pattern: '/error', desc: '错误响应')]
    public function errorResponse(): array
    {
        return [
            'success' => false,
            'error' => 'Something went wrong',
            'code' => 'INTERNAL_ERROR',
        ];
    }
}
```

### 自定义响应

```php
<?php

use Hi\Http\Message\Response;
use Psr\Http\Message\ResponseInterface;

class CustomController
{
    #[Get(pattern: '/custom', desc: '自定义响应')]
    public function customResponse(): ResponseInterface
    {
        return new Response(
            body: json_encode(['message' => 'Custom response']),
            status: 201,
            headers: [
                'Content-Type' => 'application/json',
                'X-Custom-Header' => 'Custom Value',
            ]
        );
    }
    
    #[Get(pattern: '/redirect', desc: '重定向响应')]
    public function redirectResponse(): ResponseInterface
    {
        return new Response(
            status: 302,
            headers: ['Location' => '/api/users']
        );
    }
    
    #[Get(pattern: '/file', desc: '文件下载')]
    public function fileResponse(): ResponseInterface
    {
        $content = file_get_contents('/path/to/file.pdf');
        
        return new Response(
            body: $content,
            headers: [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="document.pdf"',
                'Content-Length' => (string) strlen($content),
            ]
        );
    }
}
```

## 路由配置

### 路由加载器配置

```php
<?php

use Hi\Attributes\HttpAttributeLoader;
use Hi\Http\Router;

// 在 bootstrap.php 中配置
$router = new Router(
    loader: $di->make(HttpAttributeLoader::class, [
        'directories' => [
            __DIR__ . '/app/Transport/Http/Routes',
            __DIR__ . '/app/Transport/Http/Api',
        ],
    ]),
    middlewares: [
        App\Transport\Http\Middleware\CorsMiddleware::class,
        App\Transport\Http\Middleware\LoggingMiddleware::class,
    ],
);
```

### 路由中间件

```php
<?php

class ProtectedController
{
    #[Get(
        pattern: '/protected', 
        desc: '受保护的路由',
        middlewares: [AuthMiddleware::class]
    )]
    public function protectedRoute(): array
    {
        return ['message' => 'This is protected'];
    }
    
    #[Post(
        pattern: '/admin', 
        desc: '管理员路由',
        middlewares: [AuthMiddleware::class, AdminMiddleware::class]
    )]
    public function adminRoute(): array
    {
        return ['message' => 'Admin only'];
    }
}
```

## 异常处理

### 全局异常处理

```php
<?php

use Hi\Exception\ExceptionHandlerInterface;
use Hi\Http\Context;
use Hi\Http\Message\Response;

class CustomExceptionHandler implements ExceptionHandlerInterface
{
    public function handle(\Throwable $exception, Context $context): ResponseInterface
    {
        $logger = \construct(LoggerInterface::class);
        $logger->error('Request exception', [
            'exception' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'uri' => $context->request->getUri()->getPath(),
        ]);
        
        // 根据异常类型返回不同响应
        $status = match (true) {
            $exception instanceof ValidationException => 400,
            $exception instanceof AuthenticationException => 401,
            $exception instanceof AuthorizationException => 403,
            $exception instanceof NotFoundException => 404,
            default => 500,
        };
        
        return new Response(
            body: json_encode([
                'error' => $exception->getMessage(),
                'code' => $exception->getCode(),
                'timestamp' => time(),
            ]),
            status: $status,
            headers: ['Content-Type' => 'application/json']
        );
    }
}
```

### 路由级异常处理

```php
<?php

class ErrorController
{
    #[Get(pattern: '/test-error', desc: '测试异常')]
    public function testError(): array
    {
        try {
            // 可能抛出异常的代码
            throw new \RuntimeException('Test exception');
            
        } catch (\Throwable $e) {
            $logger = \construct(LoggerInterface::class);
            $logger->error('Handled exception', ['error' => $e->getMessage()]);
            
            return [
                'success' => false,
                'error' => 'An error occurred',
                'details' => $e->getMessage(),
            ];
        }
    }
}
```

## 性能优化

### 路由缓存

路由在启动时编译为管道，提供高性能访问：

```php
<?php

// Router 内部实现
protected function pipeization(): void
{
    foreach ($this->routes as $index => $route) {
        $this->pipelines[$index] = $route->createPipeline(
            $this->middlewares, 
            $this->validator
        );
    }
}
```

### 内存优化

```php
<?php

// 路由加载后清理内存
public function boot(bool $purge = true): RouterInterface
{
    $this->loader->load($this);
    
    if ($purge) {
        $this->pipeization();
        $this->clearMemory(); // 清理不再需要的数据
    }
    
    return $this;
}
```

## 最佳实践

### 1. 路由组织

```php
<?php

// 按模块组织路由
#[Route(prefix: '/api/v1/users')]
class UserController { /* ... */ }

#[Route(prefix: '/api/v1/orders')]
class OrderController { /* ... */ }

#[Route(prefix: '/api/v1/products')]
class ProductController { /* ... */ }
```

### 2. 参数验证

```php
<?php

class ValidationController
{
    #[Post(pattern: '/validate', desc: '数据验证')]
    public function validate(Context $ctx): array
    {
        $data = $ctx->getRequest()->getParsedBody();
        
        // 验证必需字段
        $required = ['name', 'email', 'password'];
        $missing = [];
        
        foreach ($required as $field) {
            if (empty($data[$field])) {
                $missing[] = $field;
            }
        }
        
        if (!empty($missing)) {
            return [
                'success' => false,
                'error' => 'Missing required fields',
                'missing' => $missing,
            ];
        }
        
        // 验证邮箱格式
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return [
                'success' => false,
                'error' => 'Invalid email format',
            ];
        }
        
        return ['success' => true, 'data' => $data];
    }
}
```

### 3. 错误处理

```php
<?php

class SafeController
{
    #[Get(pattern: '/safe', desc: '安全的路由处理')]
    public function safeOperation(Context $ctx): array
    {
        try {
            $result = $this->performOperation();
            
            return [
                'success' => true,
                'data' => $result,
            ];
            
        } catch (\InvalidArgumentException $e) {
            return [
                'success' => false,
                'error' => 'Invalid input: ' . $e->getMessage(),
            ];
            
        } catch (\RuntimeException $e) {
            $logger = \construct(LoggerInterface::class);
            $logger->error('Runtime error', ['error' => $e->getMessage()]);
            
            return [
                'success' => false,
                'error' => 'Operation failed',
            ];
        }
    }
    
    private function performOperation(): array
    {
        // 业务逻辑
        return ['result' => 'success'];
    }
}
```

HTTP 路由组件提供了强大而灵活的路由处理能力，通过完全匹配路由、中间件管道和类型安全的参数处理，确保应用程序的高性能和可维护性。

**重要提醒**：框架使用完全匹配的路由模式，所有参数都通过查询参数、请求体或请求头传递，不支持路径变量（如 `/users/{id}`）。 