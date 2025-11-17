# 最佳实践

本文档汇总了使用 Typing PHP Framework 开发高质量应用程序的最佳实践和推荐模式。

## 代码组织和架构

### 目录结构最佳实践

```
app/
├── Controllers/           # 控制器
│   ├── Api/              # API 控制器
│   └── Web/              # Web 控制器
├── Services/             # 业务逻辑服务
├── Repositories/         # 数据访问层
├── Models/               # 数据模型
├── Events/               # 事件定义
├── Listeners/            # 事件监听器
├── Jobs/                 # 后台任务
├── Middleware/           # 中间件
├── Validators/           # 验证器
├── Exceptions/           # 自定义异常
└── Providers/            # 服务提供者

config/                   # 配置文件
routes/                   # 路由定义
resources/                # 资源文件
storage/                  # 存储目录
tests/                    # 测试文件
```

### 分层架构实践

```php
<?php

// 控制器只负责请求处理和响应
class ProductController
{
    public function __construct(private ProductService $productService) {}
    
    public function index(Request $request): Response
    {
        $filters = $request->validated();
        $products = $this->productService->getProducts($filters);
        
        return new Response($products);
    }
}

// 服务层处理业务逻辑
class ProductService
{
    public function __construct(
        private ProductRepository $repository,
        private CacheManager $cache,
        private EventDispatcher $events
    ) {}
    
    public function getProducts(array $filters): array
    {
        $cacheKey = $this->buildCacheKey($filters);
        
        return $this->cache->remember($cacheKey, 3600, function() use ($filters) {
            $products = $this->repository->findByFilters($filters);
            
            $this->events->dispatch(new ProductsQueriedEvent($filters, count($products)));
            
            return $products;
        });
    }
}

// 仓储层负责数据访问
class ProductRepository
{
    public function __construct(private DatabaseManager $db) {}
    
    public function findByFilters(array $filters): array
    {
        $query = $this->db->table('products');
        
        $this->applyFilters($query, $filters);
        
        return $query->get()->toArray();
    }
    
    private function applyFilters($query, array $filters): void
    {
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        
        if (!empty($filters['price_range'])) {
            [$min, $max] = $filters['price_range'];
            $query->whereBetween('price', [$min, $max]);
        }
    }
}
```

## 错误处理和异常管理

### 自定义异常类

```php
<?php
// app/Exceptions/BusinessException.php

namespace App\Exceptions;

class BusinessException extends \Exception
{
    public function __construct(
        string $message,
        private array $context = [],
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
    
    public function getContext(): array
    {
        return $this->context;
    }
}

// 具体的业务异常
class InsufficientStockException extends BusinessException
{
    public function __construct(int $productId, int $requested, int $available)
    {
        parent::__construct(
            '库存不足',
            [
                'product_id' => $productId,
                'requested' => $requested,
                'available' => $available,
            ]
        );
    }
}

class ProductNotFoundException extends BusinessException
{
    public function __construct(int $productId)
    {
        parent::__construct(
            '产品不存在',
            ['product_id' => $productId],
            404
        );
    }
}
```

### 全局异常处理器

```php
<?php
// app/Exceptions/Handler.php

namespace App\Exceptions;

use Hi\Http\Request;
use Hi\Http\Response;

class Handler
{
    public function handle(\Throwable $e, Request $request): Response
    {
        // 记录异常
        $this->logException($e, $request);
        
        // 业务异常
        if ($e instanceof BusinessException) {
            return new Response([
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'context' => $e->getContext(),
            ], $e->getCode() ?: 400);
        }
        
        // HTTP 异常
        if ($e instanceof HttpException) {
            return new Response([
                'error' => $e->getMessage(),
            ], $e->getStatusCode());
        }
        
        // 生产环境隐藏详细错误信息
        if (config('app.env') === 'production') {
            return new Response([
                'error' => '服务器内部错误',
            ], 500);
        }
        
        // 开发环境显示详细错误
        return new Response([
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ], 500);
    }
    
    private function logException(\Throwable $e, Request $request): void
    {
        $context = [
            'url' => $request->getUri(),
            'method' => $request->getMethod(),
            'ip' => $request->getClientIp(),
            'user_agent' => $request->header('User-Agent'),
        ];
        
        if ($e instanceof BusinessException) {
            Log::warning($e->getMessage(), array_merge($context, $e->getContext()));
        } else {
            Log::error($e->getMessage(), array_merge($context, [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]));
        }
    }
}
```

## 数据库最佳实践

### 查询优化

```php
<?php

class OptimizedRepository
{
    // 使用索引和合适的查询条件
    public function findActiveProductsByCategory(int $categoryId): array
    {
        return $this->db->table('products')
            ->select(['id', 'name', 'price', 'stock']) // 只选择需要的字段
            ->where('category_id', $categoryId)        // 使用索引字段
            ->where('status', 'active')                // 过滤条件
            ->whereNotNull('price')                    // 避免 NULL 值
            ->orderBy('created_at', 'desc')           // 使用索引排序
            ->limit(100)                               // 限制结果数量
            ->get()
            ->toArray();
    }
    
    // 使用批量操作
    public function updateProductsPrices(array $updates): void
    {
        $this->db->transaction(function() use ($updates) {
            $chunks = array_chunk($updates, 100); // 分批处理
            
            foreach ($chunks as $chunk) {
                $cases = [];
                $ids = [];
                
                foreach ($chunk as $update) {
                    $cases[] = "WHEN {$update['id']} THEN {$update['price']}";
                    $ids[] = $update['id'];
                }
                
                $casesSql = implode(' ', $cases);
                $idsSql = implode(',', $ids);
                
                $this->db->statement("
                    UPDATE products 
                    SET price = CASE id {$casesSql} END,
                        updated_at = NOW()
                    WHERE id IN ({$idsSql})
                ");
            }
        });
    }
    
    // 使用预编译语句防止 SQL 注入
    public function searchProducts(string $keyword): array
    {
        return $this->db->select(
            "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?",
            ["%{$keyword}%", "%{$keyword}%"]
        );
    }
}
```

### 数据库迁移最佳实践

```php
<?php

class CreateProductsTable
{
    public function up(): void
    {
        $this->schema->create('products', function($table) {
            $table->id();
            $table->string('name', 255)->index();           // 常查询字段加索引
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2)->index();        // 价格字段索引
            $table->unsignedInteger('category_id')->index(); // 外键索引
            $table->enum('status', ['active', 'inactive'])
                  ->default('active')
                  ->index();                                 // 状态字段索引
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
            
            // 复合索引
            $table->index(['category_id', 'status', 'created_at']);
            
            // 外键约束
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }
}
```

## 缓存策略

### 分层缓存策略

```php
<?php

class ProductCacheService
{
    private const CACHE_TTL = [
        'short' => 300,    // 5 分钟
        'medium' => 3600,  // 1 小时
        'long' => 86400,   // 1 天
    ];
    
    public function __construct(
        private CacheManager $cache,
        private ProductRepository $repository
    ) {}
    
    // L1: 应用缓存（短期）
    public function getProduct(int $id): ?array
    {
        $key = "product:{$id}";
        
        return $this->cache->remember($key, self::CACHE_TTL['medium'], function() use ($id) {
            return $this->repository->find($id);
        });
    }
    
    // L2: 查询结果缓存（中期）
    public function getProductsByCategory(int $categoryId): array
    {
        $key = "products:category:{$categoryId}";
        
        return $this->cache->remember($key, self::CACHE_TTL['short'], function() use ($categoryId) {
            return $this->repository->findByCategory($categoryId);
        });
    }
    
    // L3: 计算结果缓存（长期）
    public function getProductStats(): array
    {
        $key = "products:stats";
        
        return $this->cache->remember($key, self::CACHE_TTL['long'], function() {
            return [
                'total_count' => $this->repository->count(),
                'avg_price' => $this->repository->averagePrice(),
                'categories_count' => $this->repository->categoriesCount(),
            ];
        });
    }
    
    // 缓存标签管理
    public function invalidateProductCaches(int $productId, int $categoryId): void
    {
        // 清除特定产品缓存
        $this->cache->forget("product:{$productId}");
        
        // 清除分类缓存
        $this->cache->forget("products:category:{$categoryId}");
        
        // 使用标签批量清除
        $this->cache->tags(['products', "category:{$categoryId}"])->flush();
    }
    
    // 缓存预热
    public function warmupCache(): void
    {
        $popularProducts = $this->repository->getPopularProducts(100);
        
        foreach ($popularProducts as $product) {
            $key = "product:{$product['id']}";
            $this->cache->put($key, $product, self::CACHE_TTL['medium']);
        }
    }
}
```

### 缓存键命名规范

```php
<?php

class CacheKeyBuilder
{
    private string $prefix;
    
    public function __construct(string $prefix = '')
    {
        $this->prefix = $prefix ?: config('app.name', 'app');
    }
    
    public function userKey(int $userId): string
    {
        return "{$this->prefix}:user:{$userId}";
    }
    
    public function userProfileKey(int $userId): string
    {
        return "{$this->prefix}:user:{$userId}:profile";
    }
    
    public function productListKey(array $filters): string
    {
        $filterKey = md5(json_encode($filters));
        return "{$this->prefix}:products:list:{$filterKey}";
    }
    
    public function sessionKey(string $sessionId): string
    {
        return "{$this->prefix}:session:{$sessionId}";
    }
    
    public function lockKey(string $resource): string
    {
        return "{$this->prefix}:lock:{$resource}";
    }
}
```

## 安全最佳实践

### 输入验证和清理

```php
<?php

class SecurityValidator
{
    // 输入验证
    public function validateProductData(array $data): array
    {
        $rules = [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-_]+$/',
            'price' => 'required|numeric|min:0|max:999999.99',
            'description' => 'string|max:5000',
            'category_id' => 'required|integer|exists:categories,id',
            'tags' => 'array|max:10',
            'tags.*' => 'string|max:50|regex:/^[a-zA-Z0-9\-_]+$/',
        ];
        
        return $this->validate($data, $rules);
    }
    
    // SQL 注入防护
    public function sanitizeSqlInput(string $input): string
    {
        return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    }
    
    // XSS 防护
    public function sanitizeOutput(string $output): string
    {
        return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
    }
    
    // CSRF 令牌验证
    public function validateCsrfToken(Request $request): bool
    {
        $token = $request->header('X-CSRF-Token') ?: $request->input('_token');
        $sessionToken = $request->session()->get('_token');
        
        return hash_equals($sessionToken, $token);
    }
}
```

### 认证和授权

```php
<?php

class AuthService
{
    // 安全的密码哈希
    public function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_ARGON2ID, [
            'memory_cost' => 65536,  // 64 MB
            'time_cost' => 4,        // 4 iterations
            'threads' => 3,          // 3 threads
        ]);
    }
    
    // 密码验证
    public function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
    
    // JWT 令牌生成
    public function generateJwtToken(array $payload): string
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $payload = json_encode(array_merge($payload, [
            'iat' => time(),
            'exp' => time() + 3600, // 1 小时有效期
        ]));
        
        $base64Header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        $base64Payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        
        $signature = hash_hmac('sha256', $base64Header . "." . $base64Payload, config('app.key'), true);
        $base64Signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        
        return $base64Header . "." . $base64Payload . "." . $base64Signature;
    }
    
    // 权限检查
    public function hasPermission(User $user, string $permission): bool
    {
        return $user->permissions()->contains($permission) ||
               $user->roles()->whereHas('permissions', function($query) use ($permission) {
                   $query->where('name', $permission);
               })->exists();
    }
}
```

## 性能优化

### 代码优化

```php
<?php

class PerformanceOptimizer
{
    // 懒加载
    private ?ProductService $productService = null;
    
    private function getProductService(): ProductService
    {
        return $this->productService ??= app(ProductService::class);
    }
    
    // 批量数据库操作
    public function bulkUpdateProducts(array $updates): void
    {
        $chunks = array_chunk($updates, 100);
        
        foreach ($chunks as $chunk) {
            $this->db->table('products')->upsert($chunk, ['id'], ['price', 'stock']);
        }
    }
    
    // 内存优化 - 使用生成器
    public function processLargeDataset(): \Generator
    {
        $offset = 0;
        $limit = 1000;
        
        do {
            $products = $this->db->table('products')
                ->offset($offset)
                ->limit($limit)
                ->get();
                
            foreach ($products as $product) {
                yield $product;
            }
            
            $offset += $limit;
        } while (count($products) === $limit);
    }
    
    // 缓存计算结果
    private array $memoizedResults = [];
    
    public function expensiveCalculation(int $value): float
    {
        if (!isset($this->memoizedResults[$value])) {
            $this->memoizedResults[$value] = $this->performCalculation($value);
        }
        
        return $this->memoizedResults[$value];
    }
}
```

### 数据库优化

```php
<?php

class DatabaseOptimizer
{
    // 查询优化
    public function optimizedProductQuery(array $filters): array
    {
        $query = $this->db->table('products')
            ->select([
                'products.id',
                'products.name',
                'products.price',
                'categories.name as category_name'
            ])
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.status', 'active');
            
        // 避免 N+1 查询，使用 JOIN
        if (!empty($filters['with_category'])) {
            $query->addSelect(['categories.description as category_description']);
        }
        
        // 使用索引字段进行过滤
        if (!empty($filters['category_ids'])) {
            $query->whereIn('products.category_id', $filters['category_ids']);
        }
        
        // 使用 LIMIT 减少数据传输
        $query->limit($filters['limit'] ?? 100);
        
        return $query->get()->toArray();
    }
    
    // 读写分离
    public function readFromSlave(): array
    {
        return $this->db->connection('slave')
            ->table('products')
            ->where('status', 'active')
            ->get()
            ->toArray();
    }
    
    public function writeToMaster(array $data): int
    {
        return $this->db->connection('master')
            ->table('products')
            ->insert($data);
    }
}
```

## 测试最佳实践

### 单元测试

```php
<?php

use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    private ProductService $productService;
    private ProductRepository $mockRepository;
    private CacheManager $mockCache;
    
    protected function setUp(): void
    {
        $this->mockRepository = $this->createMock(ProductRepository::class);
        $this->mockCache = $this->createMock(CacheManager::class);
        
        $this->productService = new ProductService(
            $this->mockRepository,
            $this->mockCache
        );
    }
    
    public function testGetProductReturnsProductWhenExists(): void
    {
        // Arrange
        $productId = 1;
        $expectedProduct = ['id' => 1, 'name' => 'Test Product'];
        
        $this->mockRepository
            ->expects($this->once())
            ->method('find')
            ->with($productId)
            ->willReturn($expectedProduct);
            
        $this->mockCache
            ->expects($this->once())
            ->method('remember')
            ->willReturnCallback(function($key, $ttl, $callback) {
                return $callback();
            });
        
        // Act
        $result = $this->productService->getProduct($productId);
        
        // Assert
        $this->assertEquals($expectedProduct, $result);
    }
    
    public function testGetProductThrowsExceptionWhenNotFound(): void
    {
        // Arrange
        $this->mockRepository
            ->method('find')
            ->willReturn(null);
            
        $this->expectException(ProductNotFoundException::class);
        
        // Act
        $this->productService->getProduct(999);
    }
}
```

### 集成测试

```php
<?php

class ProductApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
        $this->seedTestData();
    }
    
    public function testGetProductsReturnsCorrectResponse(): void
    {
        // Act
        $response = $this->get('/api/products');
        
        // Assert
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => ['id', 'name', 'price', 'category_name']
                    ],
                    'pagination' => ['page', 'per_page', 'total']
                ]);
    }
    
    public function testCreateProductRequiresAuthentication(): void
    {
        // Act
        $response = $this->post('/api/products', [
            'name' => 'New Product',
            'price' => 99.99
        ]);
        
        // Assert
        $response->assertStatus(401);
    }
    
    public function testCreateProductWithValidData(): void
    {
        // Arrange
        $user = $this->createUser();
        $this->actingAs($user);
        
        $productData = [
            'name' => 'New Product',
            'price' => 99.99,
            'category_id' => 1
        ];
        
        // Act
        $response = $this->post('/api/products', $productData);
        
        // Assert
        $response->assertStatus(201)
                ->assertJsonFragment([
                    'name' => 'New Product',
                    'price' => 99.99
                ]);
                
        $this->assertDatabaseHas('products', $productData);
    }
}
```

## 日志和监控

### 结构化日志

```php
<?php

class LoggingService
{
    private Logger $logger;
    
    public function logUserAction(User $user, string $action, array $context = []): void
    {
        $this->logger->info('User action performed', [
            'user_id' => $user->id,
            'user_email' => $user->email,
            'action' => $action,
            'ip_address' => request()->ip(),
            'user_agent' => request()->header('User-Agent'),
            'timestamp' => now()->toISOString(),
            'context' => $context,
        ]);
    }
    
    public function logDatabaseQuery(string $sql, array $bindings, float $time): void
    {
        if ($time > 1.0) { // 记录慢查询
            $this->logger->warning('Slow database query detected', [
                'sql' => $sql,
                'bindings' => $bindings,
                'execution_time' => $time,
                'threshold' => 1.0,
            ]);
        }
    }
    
    public function logBusinessEvent(string $event, array $data): void
    {
        $this->logger->info('Business event occurred', [
            'event' => $event,
            'data' => $data,
            'correlation_id' => request()->header('X-Correlation-ID'),
        ]);
    }
}
```

### 性能监控

```php
<?php

class PerformanceMonitor
{
    public function measureExecutionTime(callable $callback, string $operation): mixed
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage(true);
        
        try {
            $result = $callback();
            
            $this->recordMetrics($operation, $startTime, $startMemory, 'success');
            
            return $result;
            
        } catch (\Exception $e) {
            $this->recordMetrics($operation, $startTime, $startMemory, 'error');
            throw $e;
        }
    }
    
    private function recordMetrics(string $operation, float $startTime, int $startMemory, string $status): void
    {
        $executionTime = microtime(true) - $startTime;
        $memoryUsage = memory_get_usage(true) - $startMemory;
        
        // 记录到指标系统
        app(MetricsCollector::class)->record([
            'operation' => $operation,
            'execution_time' => $executionTime,
            'memory_usage' => $memoryUsage,
            'status' => $status,
        ]);
        
        // 记录慢操作
        if ($executionTime > 1.0) {
            Log::warning('Slow operation detected', [
                'operation' => $operation,
                'execution_time' => $executionTime,
                'memory_usage' => $memoryUsage,
            ]);
        }
    }
}
```

这些最佳实践涵盖了框架使用的各个方面，遵循这些实践可以构建更加健壮、安全和高性能的应用程序。 