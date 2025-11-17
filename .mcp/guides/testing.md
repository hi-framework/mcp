# 测试指南

Hi Framework 提供了完整的测试支持，包括单元测试、集成测试和功能测试。框架基于 PHPUnit 构建了测试基础设施，并提供了专门的测试工具和辅助类。

## 测试架构

### 测试目录结构

```
tests/
├── unit/                    # 单元测试
│   ├── ConnectionPool/      # 连接池测试
│   ├── Http/               # HTTP 组件测试
│   ├── Database/           # 数据库测试
│   └── ...                 # 其他组件测试
├── integration/            # 集成测试
├── support/                # 测试支持类
├── bootstrap.php           # 测试引导文件
├── helpers.php             # 测试辅助函数
└── make.sh                # 测试执行脚本
```

### 测试基类

框架提供了专门的测试基类 `Hi\Testing\TestCase`，集成了常用的测试功能：

```php
<?php

namespace Tests\Unit\MyComponent;

use Hi\Testing\TestCase;

class MyComponentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // 测试初始化
    }
    
    public function testBasicFunctionality(): void
    {
        // 测试代码
        $this->assertTrue(true);
    }
}
```

## 运行测试

### 基本命令

```bash
# 运行所有测试
make tests
# 或直接使用 PHPUnit
vendor/bin/phpunit

# 运行指定测试文件
vendor/bin/phpunit tests/unit/Http/ContextTest.php

# 运行指定测试方法
vendor/bin/phpunit --filter testMethodName

# 生成覆盖率报告
make coverage
# 或
XDEBUG_MODE=coverage vendor/bin/phpunit --coverage-html coverage
```

### 测试配置

PHPUnit 配置文件 `phpunit.xml` 包含以下关键设置：

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="tests/bootstrap.php"
         colors="true"
         verbose="true">
    
    <testsuites>
        <testsuite name="Unit">
            <directory>tests/unit</directory>
        </testsuite>
    </testsuites>
    
    <coverage>
        <include>
            <directory suffix=".php">src</directory>
        </include>
    </coverage>
</phpunit>
```

## HTTP 测试

### 测试 HTTP 控制器

```php
<?php

namespace Tests\Unit\Http;

use Hi\Http\Context;
use Hi\Testing\TestCase;
use Hi\Testing\ServerRequest;
use App\Transport\Http\Routes\UserController;

class UserControllerTest extends TestCase
{
    private UserController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new UserController();
    }

    public function testGetUserList(): void
    {
        // 创建测试请求
        $request = ServerRequest::create('GET', '/api/users')
            ->withQueryParams(['page' => '1', 'size' => '10']);
        
        $context = new Context($request);
        
        // 执行控制器方法
        $response = $this->controller->list($context);
        
        // 断言响应
        $this->assertIsArray($response);
        $this->assertArrayHasKey('data', $response);
        $this->assertArrayHasKey('pagination', $response);
    }

    public function testCreateUser(): void
    {
        // 测试数据
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        // 创建 POST 请求
        $request = ServerRequest::create('POST', '/api/users')
            ->withParsedBody($userData);
        
        $context = new Context($request);
        
        // 执行创建操作
        $response = $this->controller->create($context);
        
        // 断言响应
        $this->assertIsArray($response);
        $this->assertTrue($response['success']);
        $this->assertArrayHasKey('user_id', $response);
    }
}
```

### 测试中间件

```php
<?php

namespace Tests\Unit\Http\Middleware;

use Hi\Http\Context;
use Hi\Testing\TestCase;
use Hi\Testing\ServerRequest;
use App\Transport\Http\Middleware\AuthMiddleware;

class AuthMiddlewareTest extends TestCase
{
    private AuthMiddleware $middleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->middleware = new AuthMiddleware();
    }

    public function testValidToken(): void
    {
        $request = ServerRequest::create('GET', '/api/protected')
            ->withHeader('Authorization', 'Bearer valid-token');
        
        $context = new Context($request);
        $nextCalled = false;
        
        $next = function (Context $ctx) use (&$nextCalled) {
            $nextCalled = true;
            return ['message' => 'success'];
        };
        
        $response = $this->middleware->handle($context, $next);
        
        $this->assertTrue($nextCalled);
        $this->assertEquals(['message' => 'success'], $response);
    }

    public function testInvalidToken(): void
    {
        $this->expectException(\Hi\Http\Exception\UnauthorizedException::class);
        
        $request = ServerRequest::create('GET', '/api/protected');
        $context = new Context($request);
        
        $next = function (Context $ctx) {
            return ['message' => 'success'];
        };
        
        $this->middleware->handle($context, $next);
    }
}
```

## 数据库测试

### 数据库连接测试

```php
<?php

namespace Tests\Unit\Database;

use Hi\Database\DatabaseProviderInterface;
use Hi\Testing\TestCase;

class DatabaseConnectionTest extends TestCase
{
    private DatabaseProviderInterface $database;

    protected function setUp(): void
    {
        parent::setUp();
        $this->database = \construct(DatabaseProviderInterface::class);
    }

    public function testConnectionCreation(): void
    {
        $connection = $this->database->connection('default');
        $this->assertInstanceOf(\Hi\Database\Connection::class, $connection);
    }

    public function testSimpleQuery(): void
    {
        $connection = $this->database->connection('default');
        $result = $connection->query('SELECT 1 as test');
        
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals(1, $result[0]['test']);
    }
}
```

### Repository 测试

```php
<?php

namespace Tests\Unit\Repository;

use Hi\Testing\TestCase;
use App\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{
    private UserRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = \construct(UserRepository::class);
    }

    public function testFindById(): void
    {
        // 使用事务确保测试数据不影响数据库
        $this->database->transaction(function () {
            // 插入测试数据
            $userId = $this->repository->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

            // 测试查找功能
            $user = $this->repository->findById($userId);
            
            $this->assertNotNull($user);
            $this->assertEquals('Test User', $user['name']);
            $this->assertEquals('test@example.com', $user['email']);
            
            // 事务会自动回滚，不影响数据库
            throw new \Exception('Rollback transaction');
        });
    }
}
```

## 服务测试

### 依赖注入测试

```php
<?php

namespace Tests\Unit\Service;

use Hi\Testing\TestCase;
use App\Service\UserService;
use App\Repository\UserRepositoryInterface;

class UserServiceTest extends TestCase
{
    public function testServiceConstruction(): void
    {
        $service = \construct(UserService::class);
        $this->assertInstanceOf(UserService::class, $service);
    }

    public function testWithMockedDependency(): void
    {
        // 创建 Mock 对象
        $mockRepository = $this->createMock(UserRepositoryInterface::class);
        $mockRepository->method('findById')
            ->willReturn(['id' => 1, 'name' => 'Mock User']);

        // 在作用域中注入 Mock 对象
        $result = \scope(function () use ($mockRepository) {
            $service = \construct(UserService::class);
            return $service->getUser(1);
        }, bindings: [
            UserRepositoryInterface::class => $mockRepository,
        ]);

        $this->assertEquals(['id' => 1, 'name' => 'Mock User'], $result);
    }
}
```

## 控制台命令测试

### 命令测试

```php
<?php

namespace Tests\Unit\Console;

use Hi\Testing\TestCase;
use Hi\Kernel\Console\InputInterface;
use Hi\Kernel\Console\OutputInterface;
use App\Transport\Console\UserCommand;

class UserCommandTest extends TestCase
{
    private UserCommand $command;

    protected function setUp(): void
    {
        parent::setUp();
        $this->command = \construct(UserCommand::class);
    }

    public function testListCommand(): void
    {
        $input = $this->createMock(InputInterface::class);
        $output = $this->createMock(OutputInterface::class);
        
        $output->expects($this->once())
            ->method('writeln')
            ->with($this->stringContains('用户列表'));
        
        $this->command->list($input, $output);
    }

    public function testCreateCommand(): void
    {
        $input = $this->createMock(InputInterface::class);
        $input->method('getArgument')
            ->willReturnMap([
                ['name', 'Test User'],
                ['email', 'test@example.com'],
            ]);
        
        $output = $this->createMock(OutputInterface::class);
        $output->expects($this->once())
            ->method('writeln')
            ->with($this->stringContains('用户创建成功'));
        
        $this->command->create($input, $output);
    }
}
```

## 事件系统测试

### 事件和监听器测试

```php
<?php

namespace Tests\Unit\Event;

use Hi\Testing\TestCase;
use Hi\Event\EventDispatcherInterface;
use App\Event\UserCreatedEvent;
use App\Event\Listener\SendWelcomeEmailListener;

class EventSystemTest extends TestCase
{
    private EventDispatcherInterface $dispatcher;

    protected function setUp(): void
    {
        parent::setUp();
        $this->dispatcher = \construct(EventDispatcherInterface::class);
    }

    public function testEventDispatch(): void
    {
        $event = new UserCreatedEvent(userId: 123, email: 'test@example.com');
        
        $listenerCalled = false;
        $this->dispatcher->listen(UserCreatedEvent::class, function ($event) use (&$listenerCalled) {
            $listenerCalled = true;
            $this->assertEquals(123, $event->userId);
            $this->assertEquals('test@example.com', $event->email);
        });
        
        $this->dispatcher->dispatch($event);
        $this->assertTrue($listenerCalled);
    }
}
```

## 缓存测试

### 缓存功能测试

```php
<?php

namespace Tests\Unit\Cache;

use Hi\Testing\TestCase;
use Hi\Cache\CacheProviderInterface;

class CacheTest extends TestCase
{
    private CacheProviderInterface $cache;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cache = \construct(CacheProviderInterface::class);
    }

    public function testSetAndGet(): void
    {
        $key = 'test_key';
        $value = ['test' => 'data'];
        
        // 设置缓存
        $this->assertTrue($this->cache->set($key, $value, 60));
        
        // 获取缓存
        $retrieved = $this->cache->get($key);
        $this->assertEquals($value, $retrieved);
    }

    public function testExpiration(): void
    {
        $key = 'expire_test';
        $value = 'expire_value';
        
        // 设置 1 秒过期
        $this->cache->set($key, $value, 1);
        $this->assertEquals($value, $this->cache->get($key));
        
        // 等待过期
        sleep(2);
        $this->assertNull($this->cache->get($key));
    }
}
```

## 性能测试

### 基准测试

```php
<?php

namespace Tests\Unit\Performance;

use Hi\Testing\TestCase;

class PerformanceTest extends TestCase
{
    public function testRouterPerformance(): void
    {
        $router = \construct(\Hi\Http\Router\RouterInterface::class);
        
        $startTime = microtime(true);
        
        // 执行 1000 次路由匹配
        for ($i = 0; $i < 1000; $i++) {
            $router->dispatch('GET', '/api/users/list');
        }
        
        $endTime = microtime(true);
        $duration = $endTime - $startTime;
        
        // 断言性能要求（例如：1000 次匹配应在 100ms 内完成）
        $this->assertLessThan(0.1, $duration, 'Router performance degraded');
    }
}
```

## 测试最佳实践

### 1. 测试隔离

每个测试都应该是独立的，不依赖其他测试的结果：

```php
public function testIsolation(): void
{
    // 每个测试都应该设置自己的数据
    $testData = $this->createTestData();
    
    // 执行测试
    $result = $this->service->process($testData);
    
    // 清理测试数据（如果需要）
    $this->cleanupTestData($testData);
    
    $this->assertNotNull($result);
}
```

### 2. 使用数据提供者

为同一个逻辑提供多组测试数据：

```php
/**
 * @dataProvider validationDataProvider
 */
public function testValidation(array $input, bool $expected): void
{
    $validator = new InputValidator();
    $result = $validator->validate($input);
    $this->assertEquals($expected, $result);
}

public function validationDataProvider(): array
{
    return [
        'valid email' => [['email' => 'user@example.com'], true],
        'invalid email' => [['email' => 'invalid-email'], false],
        'empty email' => [['email' => ''], false],
    ];
}
```

### 3. Mock 外部依赖

测试时应该隔离外部系统：

```php
public function testExternalService(): void
{
    $mockHttpClient = $this->createMock(HttpClientInterface::class);
    $mockHttpClient->method('get')
        ->willReturn(['status' => 'success']);
    
    $result = \scope(function () {
        $service = \construct(ExternalApiService::class);
        return $service->fetchData();
    }, bindings: [
        HttpClientInterface::class => $mockHttpClient,
    ]);
    
    $this->assertEquals(['status' => 'success'], $result);
}
```

### 4. 测试边界条件

确保测试覆盖各种边界情况：

```php
public function testEdgeCases(): void
{
    $calculator = new Calculator();
    
    // 测试正常情况
    $this->assertEquals(5, $calculator->add(2, 3));
    
    // 测试边界条件
    $this->assertEquals(0, $calculator->add(0, 0));
    $this->assertEquals(-1, $calculator->add(1, -2));
    $this->assertEquals(PHP_INT_MAX, $calculator->add(PHP_INT_MAX, 0));
}
```

## 持续集成

### GitHub Actions 配置示例

```yaml
name: Tests

on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v2
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: '8.2'
        extensions: swoole, xdebug
        coverage: xdebug
    
    - name: Install dependencies
      run: composer install --prefer-dist --no-progress
    
    - name: Run tests
      run: vendor/bin/phpunit --coverage-clover=coverage.xml
    
    - name: Upload coverage
      uses: codecov/codecov-action@v1
      with:
        file: ./coverage.xml
```

通过遵循这些测试实践，您可以构建可靠、可维护的 Hi Framework 应用程序，确保代码质量和系统稳定性。