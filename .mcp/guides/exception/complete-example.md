# 完整示例

## 概述

本文档通过一个完整的用户管理系统示例，展示 Typing PHP Framework 异常处理系统的实际应用。示例包括用户注册、登录、信息查询等常见业务场景，演示如何设计异常、配置处理器和实现报告。

## 项目结构

```
src/
├── Application/
│   ├── Exception/
│   │   ├── Handler.php
│   │   ├── UserNotFoundException.php
│   │   ├── ValidationException.php
│   │   └── AuthenticationException.php
│   ├── Services/
│   │   └── UserService.php
│   ├── Controllers/
│   │   └── UserController.php
│   └── Models/
│       └── User.php
├── bootstrap.php
└── config/
    └── app.php
```

## 异常类设计

### 1. 用户不存在异常

```php
<?php

namespace Application\Exception;

use Hi\Exception\Exception;

class UserNotFoundException extends Exception implements NoReportedExceptionInterface
{
    public function __construct(string $identifier, string $type = 'ID')
    {
        $message = "用户 {$type} '{$identifier}' 不存在";
        parent::__construct($message, 404);
    }
}
```

### 2. 验证异常

```php
<?php

namespace Application\Exception;

use Hi\Exception\Exception;

class ValidationException extends Exception implements NoReportedExceptionInterface
{
    public function __construct(
        string $message,
        public readonly array $errors,
        int $code = 422
    ) {
        parent::__construct($message, $code);
    }
}
```

### 3. 认证异常

```php
<?php

namespace Application\Exception;

use Hi\Exception\Exception;

class AuthenticationException extends Exception implements NoReportedExceptionInterface
{
    public function __construct(string $message = '认证失败', int $code = 401)
    {
        parent::__construct($message, $code);
    }
}
```

## 异常处理器

### 自定义异常处理器

```php
<?php

namespace Application\Exception;

use Hi\Exception\ExceptionHandler;
use Hi\Http\Context;
use Hi\Http\Message\Response;
use Psr\Http\Message\ResponseInterface;

class Handler extends ExceptionHandler
{
    public function __construct()
    {
        parent::__construct();
        
        // 配置不报告的异常类型
        $this->dontReport([
            UserNotFoundException::class,
            ValidationException::class,
            AuthenticationException::class,
        ]);
        
        // 添加自定义报告器
        $this->addReporter(new ApplicationLogReporter());
        $this->addReporter(new SlackNotificationReporter());
    }

    public function handle(\Throwable $th, mixed $context = null): mixed
    {
        // 报告异常
        $this->report($th, $context);

        // 如果不是 HTTP 上下文，返回空字符串
        if (! $context instanceof Context) {
            return '';
        }

        // 处理不同类型的异常
        if ($th instanceof UserNotFoundException) {
            return $this->handleUserNotFound($th, $context);
        }

        if ($th instanceof ValidationException) {
            return $this->handleValidationError($th, $context);
        }

        if ($th instanceof AuthenticationException) {
            return $this->handleAuthenticationError($th, $context);
        }

        // 处理其他异常
        return $this->handleGenericError($th, $context);
    }

    protected function handleUserNotFound(UserNotFoundException $th, Context $context): ResponseInterface
    {
        return new Response(
            statusCode: 404,
            body: json_encode([
                'error' => 'user_not_found',
                'message' => $th->getMessage(),
                'timestamp' => date('c'),
            ]),
            headers: ['Content-Type' => 'application/json']
        );
    }

    protected function handleValidationError(ValidationException $th, Context $context): ResponseInterface
    {
        return new Response(
            statusCode: 422,
            body: json_encode([
                'error' => 'validation_failed',
                'message' => $th->getMessage(),
                'errors' => $th->errors,
                'timestamp' => date('c'),
            ]),
            headers: ['Content-Type' => 'application/json']
        );
    }

    protected function handleAuthenticationError(AuthenticationException $th, Context $context): ResponseInterface
    {
        return new Response(
            statusCode: 401,
            body: json_encode([
                'error' => 'authentication_failed',
                'message' => $th->getMessage(),
                'timestamp' => date('c'),
            ]),
            headers: ['Content-Type' => 'application/json']
        );
    }

    protected function handleGenericError(\Throwable $th, Context $context): ResponseInterface
    {
        // 生产环境中隐藏详细错误信息
        if (!AppDebug) {
            return new Response(
                statusCode: 500,
                body: json_encode([
                    'error' => 'internal_server_error',
                    'message' => '服务器内部错误',
                    'timestamp' => date('c'),
                ]),
                headers: ['Content-Type' => 'application/json']
            );
        }

        // 开发环境中显示详细错误信息
        return new Response(
            statusCode: 500,
            body: json_encode([
                'error' => 'internal_server_error',
                'message' => $th->getMessage(),
                'file' => $th->getFile(),
                'line' => $th->getLine(),
                'trace' => $th->getTrace(),
                'timestamp' => date('c'),
            ]),
            headers: ['Content-Type' => 'application/json']
        );
    }
}
```

## 自定义报告器

### 1. 应用日志报告器

```php
<?php

namespace Application\Exception;

use Hi\Exception\ExceptionReporterInterface;
use Psr\Log\LoggerInterface;

class ApplicationLogReporter implements ExceptionReporterInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        $logContext = [
            'exception_class' => $th::class,
            'message' => $th->getMessage(),
            'code' => $th->getCode(),
            'file' => $th->getFile(),
            'line' => $th->getLine(),
            'stack_trace' => $th->getTraceAsString(),
            'context' => $this->extractContext($context),
            'timestamp' => date('c'),
            'user_id' => $this->extractUserId($context),
            'request_id' => $this->extractRequestId($context),
        ];

        // 根据异常类型选择日志级别
        $level = $this->determineLogLevel($th);
        $this->logger->log($level, 'Application exception occurred', $logContext);
    }

    private function determineLogLevel(\Throwable $th): string
    {
        if ($th instanceof UserNotFoundException || 
            $th instanceof ValidationException) {
            return 'INFO';
        }

        if ($th instanceof AuthenticationException) {
            return 'WARNING';
        }

        return 'ERROR';
    }

    private function extractContext(mixed $context): array
    {
        if (!$context instanceof Context) {
            return [];
        }

        return [
            'url' => $context->request->getUri()->__toString(),
            'method' => $context->request->getMethod(),
            'user_agent' => $context->request->getHeaderLine('User-Agent'),
            'ip' => $context->request->getServerParams()['REMOTE_ADDR'] ?? '',
            'headers' => $context->request->getHeaders(),
        ];
    }

    private function extractUserId(mixed $context): ?string
    {
        if (!$context instanceof Context) {
            return null;
        }

        // 从请求中提取用户ID（假设存储在认证中间件中）
        return $context->request->getAttribute('user_id');
    }

    private function extractRequestId(mixed $context): ?string
    {
        if (!$context instanceof Context) {
            return null;
        }

        return $context->request->getHeaderLine('X-Request-ID');
    }
}
```

### 2. Slack 通知报告器

```php
<?php

namespace Application\Exception;

use Hi\Exception\ExceptionReporterInterface;
use Hi\Http\Client\HttpClientInterface;

class SlackNotificationReporter implements ExceptionReporterInterface
{
    public function __construct(
        private string $webhookUrl,
        private HttpClientInterface $httpClient,
        private array $channels = ['#alerts']
    ) {
    }

    public function report(\Throwable $th, mixed $context = null): void
    {
        // 只报告严重异常
        if (!$this->isSevereException($th)) {
            return;
        }

        try {
            $payload = $this->prepareSlackPayload($th, $context);
            
            foreach ($this->channels as $channel) {
                $this->sendToSlack($channel, $payload);
            }
        } catch (\Throwable $e) {
            // 记录发送失败，但不抛出异常
            error_log('Failed to send Slack notification: ' . $e->getMessage());
        }
    }

    private function isSevereException(\Throwable $th): bool
    {
        $severeExceptions = [
            \PDOException::class,
            \ErrorException::class,
            \FatalErrorException::class,
        ];

        foreach ($severeExceptions as $severeException) {
            if ($th instanceof $severeException) {
                return true;
            }
        }

        return false;
    }

    private function prepareSlackPayload(\Throwable $th, mixed $context): array
    {
        $contextInfo = $this->extractContext($context);
        
        return [
            'channel' => '#alerts',
            'text' => '🚨 应用异常告警',
            'attachments' => [
                [
                    'color' => '#ff0000',
                    'title' => $th::class,
                    'text' => $th->getMessage(),
                    'fields' => [
                        [
                            'title' => '文件',
                            'value' => $th->getFile() . ':' . $th->getLine(),
                            'short' => true,
                        ],
                        [
                            'title' => '时间',
                            'value' => date('Y-m-d H:i:s'),
                            'short' => true,
                        ],
                        [
                            'title' => 'URL',
                            'value' => $contextInfo['url'] ?? 'N/A',
                            'short' => true,
                        ],
                        [
                            'title' => '用户ID',
                            'value' => $contextInfo['user_id'] ?? 'N/A',
                            'short' => true,
                        ],
                    ],
                    'footer' => 'Typing PHP Framework',
                    'ts' => time(),
                ],
            ],
        ];
    }

    private function sendToSlack(string $channel, array $payload): void
    {
        $payload['channel'] = $channel;
        
        $this->httpClient->post($this->webhookUrl, [
            'json' => $payload,
        ]);
    }

    private function extractContext(mixed $context): array
    {
        if (!$context instanceof Context) {
            return [];
        }

        return [
            'url' => $context->request->getUri()->__toString(),
            'user_id' => $context->request->getAttribute('user_id'),
        ];
    }
}
```

## 业务逻辑实现

### 用户服务

```php
<?php

namespace Application\Services;

use Application\Exception\UserNotFoundException;
use Application\Exception\ValidationException;
use Application\Exception\AuthenticationException;
use Application\Models\User;

class UserService
{
    public function __construct(
        private \PDO $db,
        private \PasswordHash $passwordHash
    ) {
    }

    public function findById(string $id): User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$userData) {
            throw new UserNotFoundException($id);
        }

        return new User($userData);
    }

    public function findByEmail(string $email): User
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $userData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$userData) {
            throw new UserNotFoundException($email, '邮箱');
        }

        return new User($userData);
    }

    public function create(array $data): User
    {
        // 验证数据
        $errors = $this->validateUserData($data);
        if (!empty($errors)) {
            throw new ValidationException('用户数据验证失败', $errors);
        }

        // 检查邮箱是否已存在
        try {
            $this->findByEmail($data['email']);
            throw new ValidationException('邮箱已存在', ['email' => ['邮箱已被注册']]);
        } catch (UserNotFoundException) {
            // 邮箱不存在，可以继续
        }

        // 创建用户
        $hashedPassword = $this->passwordHash->hash($data['password']);
        
        $stmt = $this->db->prepare('
            INSERT INTO users (name, email, password, created_at) 
            VALUES (?, ?, ?, ?)
        ');
        
        $stmt->execute([
            $data['name'],
            $data['email'],
            $hashedPassword,
            date('Y-m-d H:i:s'),
        ]);

        $userId = $this->db->lastInsertId();
        return $this->findById($userId);
    }

    public function authenticate(string $email, string $password): User
    {
        try {
            $user = $this->findByEmail($email);
        } catch (UserNotFoundException) {
            throw new AuthenticationException('邮箱或密码错误');
        }

        if (!$this->passwordHash->verify($password, $user->password)) {
            throw new AuthenticationException('邮箱或密码错误');
        }

        return $user;
    }

    private function validateUserData(array $data): array
    {
        $errors = [];

        if (empty($data['name'])) {
            $errors['name'] = ['姓名不能为空'];
        } elseif (strlen($data['name']) < 2) {
            $errors['name'] = ['姓名长度不能少于2个字符'];
        }

        if (empty($data['email'])) {
            $errors['email'] = ['邮箱不能为空'];
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = ['邮箱格式不正确'];
        }

        if (empty($data['password'])) {
            $errors['password'] = ['密码不能为空'];
        } elseif (strlen($data['password']) < 6) {
            $errors['password'] = ['密码长度不能少于6个字符'];
        }

        return $errors;
    }
}
```

### 用户控制器

```php
<?php

namespace Application\Controllers;

use Application\Services\UserService;
use Hi\Http\Context;
use Hi\Http\Message\Response;
use Psr\Http\Message\ResponseInterface;

class UserController
{
    public function __construct(private UserService $userService)
    {
    }

    public function show(Context $context): ResponseInterface
    {
        try {
            $userId = $context->request->getAttribute('user_id');
            $user = $this->userService->findById($userId);

            return new Response(
                statusCode: 200,
                body: json_encode([
                    'data' => $user->toArray(),
                    'message' => '获取用户信息成功',
                ]),
                headers: ['Content-Type' => 'application/json']
            );
        } catch (\Throwable $e) {
            // 异常会被全局异常处理器捕获
            throw $e;
        }
    }

    public function store(Context $context): ResponseInterface
    {
        try {
            $data = json_decode($context->request->getBody()->getContents(), true);
            $user = $this->userService->create($data);

            return new Response(
                statusCode: 201,
                body: json_encode([
                    'data' => $user->toArray(),
                    'message' => '用户创建成功',
                ]),
                headers: ['Content-Type' => 'application/json']
            );
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    public function login(Context $context): ResponseInterface
    {
        try {
            $data = json_decode($context->request->getBody()->getContents(), true);
            
            if (empty($data['email']) || empty($data['password'])) {
                throw new ValidationException('邮箱和密码不能为空', [
                    'email' => ['邮箱不能为空'],
                    'password' => ['密码不能为空'],
                ]);
            }

            $user = $this->userService->authenticate($data['email'], $data['password']);

            // 生成认证令牌
            $token = $this->generateAuthToken($user);

            return new Response(
                statusCode: 200,
                body: json_encode([
                    'data' => [
                        'user' => $user->toArray(),
                        'token' => $token,
                    ],
                    'message' => '登录成功',
                ]),
                headers: ['Content-Type' => 'application/json']
            );
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    private function generateAuthToken(User $user): string
    {
        // 简单的令牌生成示例
        return base64_encode(json_encode([
            'user_id' => $user->id,
            'email' => $user->email,
            'exp' => time() + 3600, // 1小时过期
        ]));
    }
}
```

## 应用启动配置

### 引导文件

```php
<?php

// bootstrap.php

use Application\Exception\Handler;
use Hi\Kernel\Application;

// 创建应用实例
$app = new Application();

// 注册异常处理器
$handler = new Handler();
$handler->register();

// 设置全局异常处理器
$app->setExceptionHandler($handler);

// 启动应用
$app->run();
```

### 配置文件

```php
<?php

// config/app.php

return [
    'debug' => env('APP_DEBUG', false),
    'environment' => env('APP_ENV', 'production'),
    
    'logging' => [
        'default' => 'stack',
        'channels' => [
            'stack' => [
                'driver' => 'stack',
                'channels' => ['single', 'slack'],
            ],
            'single' => [
                'driver' => 'single',
                'path' => storage_path('logs/app.log'),
                'level' => 'debug',
            ],
            'slack' => [
                'driver' => 'slack',
                'url' => env('LOG_SLACK_WEBHOOK_URL'),
                'username' => 'Exception Bot',
                'emoji' => ':boom:',
                'level' => 'critical',
            ],
        ],
    ],
    
    'exceptions' => [
        'report' => [
            'enabled' => true,
            'channels' => ['log', 'slack'],
        ],
        'dont_report' => [
            \Application\Exception\UserNotFoundException::class,
            \Application\Exception\ValidationException::class,
            \Application\Exception\AuthenticationException::class,
        ],
    ],
];
```

## 测试示例

### 单元测试

```php
<?php

namespace Tests\Unit\Application\Exception;

use Application\Exception\UserNotFoundException;
use Application\Exception\ValidationException;
use Application\Exception\AuthenticationException;
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{
    public function testUserNotFoundException(): void
    {
        $exception = new UserNotFoundException('123');
        
        $this->assertEquals('用户 ID \'123\' 不存在', $exception->getMessage());
        $this->assertEquals(404, $exception->getCode());
    }

    public function testValidationException(): void
    {
        $errors = ['email' => ['邮箱格式不正确']];
        $exception = new ValidationException('验证失败', $errors);
        
        $this->assertEquals('验证失败', $exception->getMessage());
        $this->assertEquals(422, $exception->getCode());
        $this->assertEquals($errors, $exception->errors);
    }

    public function testAuthenticationException(): void
    {
        $exception = new AuthenticationException('密码错误');
        
        $this->assertEquals('密码错误', $exception->getMessage());
        $this->assertEquals(401, $exception->getCode());
    }
}
```

### 集成测试

```php
<?php

namespace Tests\Integration\Application\Controllers;

use Application\Controllers\UserController;
use Application\Services\UserService;
use Hi\Http\Context;
use Hi\Http\Message\Request;
use Hi\Http\Message\Uri;
use PHPUnit\Framework\TestCase;

class UserControllerTest extends TestCase
{
    public function testShowUserNotFound(): void
    {
        $this->expectException(UserNotFoundException::class);
        
        $userService = $this->createMock(UserService::class);
        $userService->method('findById')
            ->willThrowException(new UserNotFoundException('999'));
        
        $controller = new UserController($userService);
        
        $request = new Request(
            method: 'GET',
            uri: new Uri('http://example.com/users/999')
        );
        
        $context = new Context($request);
        $context->request = $context->request->withAttribute('user_id', '999');
        
        $controller->show($context);
    }
}
```

## 部署和监控

### 生产环境配置

```php
<?php

// 生产环境异常处理配置

// 禁用调试模式
define('APP_DEBUG', false);

// 配置异常报告
$handler = new Handler();

// 只报告严重异常
$handler->dontReport([
    UserNotFoundException::class,
    ValidationException::class,
    AuthenticationException::class,
    \PDOException::class, // 数据库连接异常
]);

// 添加生产环境报告器
$handler->addReporter(new ProductionLogReporter());
$handler->addReporter(new EmailAlertReporter('admin@company.com'));
$handler->addReporter(new SlackNotificationReporter());

// 注册处理器
$handler->register();
```

### 监控和告警

```php
<?php

// 异常频率监控
$monitor = new ExceptionFrequencyMonitor();

// 设置告警阈值
$monitor->addThreshold(
    \PDOException::class,
    10, // 10分钟内超过10次
    function (\Throwable $th, int $count) {
        // 发送紧急告警
        $this->sendEmergencyAlert($th, $count);
    }
);

$monitor->addThreshold(
    \ErrorException::class,
    5, // 10分钟内超过5次
    function (\Throwable $th, int $count) {
        // 发送警告通知
        $this->sendWarningNotification($th, $count);
    }
);
```

## 总结

这个完整示例展示了：

1. **异常类设计**：为不同业务场景创建专门的异常类
2. **异常处理器**：自定义异常处理逻辑和响应格式
3. **报告器实现**：日志记录和外部通知（Slack）
4. **业务逻辑**：在服务层抛出异常，在控制器中处理
5. **配置管理**：环境相关的异常处理配置
6. **测试覆盖**：单元测试和集成测试
7. **生产部署**：生产环境的异常监控和告警

通过这些实践，可以构建健壮、可维护的异常处理系统，提供良好的用户体验和开发者体验。
