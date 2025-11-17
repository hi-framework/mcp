# Database 数据库

Database 组件提供高性能的数据库连接池管理、类型安全的查询构建器和强大的事务处理能力，支持多种数据库驱动和连接策略。

## 设计思路

### 核心特性

1. **连接池管理**: 高效的数据库连接池，支持连接复用和自动回收
2. **多数据库支持**: 支持 MySQL、ClickHouse 等主流数据库
3. **类型安全**: 强类型查询构建器，编译期类型检查
4. **事务管理**: 自动事务管理和分布式事务支持
5. **性能监控**: 内置查询性能监控和慢查询日志
6. **连接恢复**: 自动检测和恢复丢失的数据库连接

### 架构组件

- **DatabaseManager**: 数据库管理器，负责连接池创建和管理
- **ConnectionPool**: 连接池实现，管理数据库连接的生命周期
- **QueryBuilder**: 类型安全的查询构建器
- **Transaction**: 事务管理器
- **Migrator**: 数据库迁移工具

## 基本配置

### 数据库配置

```yaml
# application.yaml
database:
  default:
    driver: mysql
    host: localhost
    port: 3306
    database: app
    username: root
    password: ''
    charset: utf8mb4
    collation: utf8mb4_unicode_ci
    options:
      ATTR_ERRMODE: ERRMODE_EXCEPTION
      ATTR_DEFAULT_FETCH_MODE: FETCH_ASSOC
      ATTR_EMULATE_PREPARES: false
    pool:
      min_connections: 1
      max_connections: 20
      connect_timeout: 3.0
      wait_timeout: 5.0
      heartbeat: 30
      max_idle_time: 60
  
  clickhouse:
    driver: clickhouse
    host: localhost
    port: 8123
    database: default
    username: default
    password: ''
    pool:
      min_connections: 1
      max_connections: 10
      connect_timeout: 2.0
      wait_timeout: 3.0
  
  read_replica:
    driver: mysql
    host: read.mysql.local
    port: 3306
    database: app
    username: readonly
    password: ''
    charset: utf8mb4
    pool:
      min_connections: 1
      max_connections: 15
```

## 基本使用

### 连接管理

```php
use Hi\Database\DatabaseManager;

// 获取默认连接
$db = $databaseManager->connection();

// 获取指定连接
$mysql = $databaseManager->connection('mysql');
$clickhouse = $databaseManager->connection('clickhouse');
$readReplica = $databaseManager->connection('read_replica');

// 原生 PDO 操作
$stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([123]);
$user = $stmt->fetch();

// 简化查询
$users = $db->query('SELECT * FROM users LIMIT 10')->fetchAll();
$userCount = $db->query('SELECT COUNT(*) FROM users')->fetchColumn();
```

### 查询构建器

```php
use Hi\Database\Query\Builder;

$query = new Builder($db);

// 基础查询
$users = $query->table('users')
    ->select(['id', 'name', 'email'])
    ->where('active', true)
    ->orderBy('created_at', 'desc')
    ->limit(10)
    ->get();

// 条件查询
$activeUsers = $query->table('users')
    ->where('active', true)
    ->where('email_verified', true)
    ->whereBetween('age', [18, 65])
    ->whereIn('role', ['user', 'admin'])
    ->get();

// 联表查询
$userPosts = $query->table('users')
    ->join('posts', 'users.id', '=', 'posts.user_id')
    ->select(['users.name', 'posts.title', 'posts.created_at'])
    ->where('posts.status', 'published')
    ->get();

// 聚合查询
$stats = $query->table('orders')
    ->select([
        $query->raw('COUNT(*) as total_orders'),
        $query->raw('SUM(amount) as total_amount'),
        $query->raw('AVG(amount) as avg_amount'),
    ])
    ->where('status', 'completed')
    ->first();
```

### 插入操作

```php
// 单条插入
$userId = $query->table('users')->insert([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => password_hash('secret', PASSWORD_DEFAULT),
    'created_at' => new DateTime(),
]);

// 批量插入
$query->table('users')->insertMany([
    ['name' => 'Alice', 'email' => 'alice@example.com'],
    ['name' => 'Bob', 'email' => 'bob@example.com'],
    ['name' => 'Charlie', 'email' => 'charlie@example.com'],
]);

// 插入或更新
$query->table('users')->upsert([
    'email' => 'john@example.com',
    'name' => 'John Updated',
    'updated_at' => new DateTime(),
], ['email']); // 唯一键
```

### 更新操作

```php
// 条件更新
$affected = $query->table('users')
    ->where('id', 123)
    ->update([
        'name' => 'John Updated',
        'updated_at' => new DateTime(),
    ]);

// 批量更新
$query->table('users')
    ->whereIn('id', [1, 2, 3])
    ->update(['status' => 'inactive']);

// 增量更新
$query->table('posts')
    ->where('id', 456)
    ->increment('views', 1);

$query->table('users')
    ->where('id', 123)
    ->decrement('credits', 10);
```

### 删除操作

```php
// 条件删除
$deleted = $query->table('users')
    ->where('active', false)
    ->where('last_login', '<', new DateTime('-1 year'))
    ->delete();

// 软删除
$query->table('posts')
    ->where('id', 456)
    ->update(['deleted_at' => new DateTime()]);

// 清空表
$query->table('temp_data')->truncate();
```

## 事务管理

### 基本事务

```php
use Hi\Database\Transaction;

// 自动事务
$result = $db->transaction(function ($connection) {
    // 创建用户
    $userId = $connection->table('users')->insert([
        'name' => 'John Doe',
        'email' => 'john@example.com',
    ]);
    
    // 创建用户配置
    $connection->table('user_profiles')->insert([
        'user_id' => $userId,
        'bio' => 'Hello, I am John!',
    ]);
    
    // 发送欢迎邮件
    $this->emailService->sendWelcome('john@example.com');
    
    return $userId;
});

// 手动事务控制
$transaction = new Transaction($db);

try {
    $transaction->begin();
    
    $orderId = $db->table('orders')->insert([
        'user_id' => 123,
        'amount' => 99.99,
        'status' => 'pending',
    ]);
    
    $db->table('order_items')->insertMany([
        ['order_id' => $orderId, 'product_id' => 1, 'quantity' => 2],
        ['order_id' => $orderId, 'product_id' => 2, 'quantity' => 1],
    ]);
    
    $transaction->commit();
    
} catch (\Exception $e) {
    $transaction->rollback();
    throw $e;
}
```

### 嵌套事务

```php
class OrderService
{
    public function createOrder(array $orderData): int
    {
        return $this->db->transaction(function ($db) use ($orderData) {
            // 创建订单
            $orderId = $this->createOrderRecord($db, $orderData);
            
            // 处理库存（嵌套事务）
            $this->updateInventory($db, $orderData['items']);
            
            return $orderId;
        });
    }
    
    private function updateInventory($db, array $items): void
    {
        $db->transaction(function ($db) use ($items) {
            foreach ($items as $item) {
                $db->table('inventory')
                    ->where('product_id', $item['product_id'])
                    ->decrement('stock', $item['quantity']);
            }
        });
    }
}
```

### 分布式事务

```php
use Hi\Database\DistributedTransaction;

class PaymentService
{
    public function processPayment(int $orderId, float $amount): bool
    {
        $distributedTx = new DistributedTransaction([
            'orders_db' => $this->ordersDb,
            'payments_db' => $this->paymentsDb,
            'inventory_db' => $this->inventoryDb,
        ]);
        
        return $distributedTx->execute(function ($connections) use ($orderId, $amount) {
            // 更新订单状态
            $connections['orders_db']->table('orders')
                ->where('id', $orderId)
                ->update(['status' => 'paid']);
            
            // 记录支付
            $connections['payments_db']->table('payments')->insert([
                'order_id' => $orderId,
                'amount' => $amount,
                'status' => 'completed',
            ]);
            
            // 更新库存
            $connections['inventory_db']->table('inventory')
                ->where('order_id', $orderId)
                ->update(['reserved' => false]);
            
            return true;
        });
    }
}
```

## 模型定义

### 基础模型

```php
use Hi\Database\Model;

class User extends Model
{
    protected string $table = 'users';
    protected string $primaryKey = 'id';
    protected array $fillable = ['name', 'email', 'password'];
    protected array $hidden = ['password', 'remember_token'];
    protected array $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // 关联关系
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }
    
    // 访问器
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
    // 修改器
    public function setPasswordAttribute(string $value): void
    {
        $this->attributes['password'] = password_hash($value, PASSWORD_DEFAULT);
    }
    
    // 查询作用域
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
    
    public function scopeVerified(Builder $query): Builder
    {
        return $query->whereNotNull('email_verified_at');
    }
}

// 使用模型
$users = User::active()->verified()->get();
$user = User::find(123);
$user->name = 'John Updated';
$user->save();
```

### 模型关联

```php
class Post extends Model
{
    protected array $fillable = ['title', 'content', 'user_id'];
    protected array $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];
    
    // 属于用户
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    // 多对多关联标签
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
    
    // 多态关联评论
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

// 预加载关联
$posts = Post::with(['user', 'tags', 'comments'])
    ->where('published_at', '<=', now())
    ->get();

// 懒加载
$post = Post::find(1);
$user = $post->user; // 自动加载用户
$tags = $post->tags; // 自动加载标签
```

## 数据库迁移

### 创建迁移

```php
use Hi\Database\Migration\Migration;
use Hi\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        $this->schema->create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            
            $table->index('email');
        });
    }
    
    public function down(): void
    {
        $this->schema->dropIfExists('users');
    }
}

class CreatePostsTable extends Migration
{
    public function up(): void
    {
        $this->schema->create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->fullText(['title', 'content']);
        });
    }
    
    public function down(): void
    {
        $this->schema->dropIfExists('posts');
    }
}
```

### 运行迁移

```php
use Hi\Database\Migrator;

$migrator = new Migrator($db, $migrationPath);

// 运行所有待执行的迁移
$migrator->migrate();

// 回滚最后一批迁移
$migrator->rollback();

// 重置数据库
$migrator->reset();

// 刷新数据库（重置 + 迁移）
$migrator->refresh();

// 检查迁移状态
$status = $migrator->status();
```

## 性能优化

### 连接池优化

```php
// 配置连接池参数
$config = [
    'pool' => [
        'min_connections' => 2,        // 最小连接数
        'max_connections' => 50,       // 最大连接数
        'connect_timeout' => 3.0,      // 连接超时
        'wait_timeout' => 5.0,         // 等待连接超时
        'heartbeat' => 30,             // 心跳检测间隔
        'max_idle_time' => 300,        // 最大空闲时间
        'validation_query' => 'SELECT 1', // 连接验证查询
    ],
];
```

### 查询优化

```php
// 使用索引提示
$users = $query->table('users')
    ->useIndex('idx_email')
    ->where('email', 'john@example.com')
    ->first();

// 批量加载
$userIds = [1, 2, 3, 4, 5];
$users = $query->table('users')
    ->whereIn('id', $userIds)
    ->get()
    ->keyBy('id');

// 分页查询
$posts = $query->table('posts')
    ->where('status', 'published')
    ->orderBy('created_at', 'desc')
    ->paginate(20);

// 游标分页（大数据集）
$posts = $query->table('posts')
    ->where('id', '>', $lastId)
    ->orderBy('id')
    ->limit(100)
    ->get();
```

### 缓存查询

```php
use Hi\Cache\CacheManager;

class UserRepository
{
    public function __construct(
        private DatabaseManager $db,
        private CacheManager $cache
    ) {}
    
    public function find(int $id): ?array
    {
        $cacheKey = "user:{$id}";
        
        return $this->cache->storage('default')->remember($cacheKey, 3600, function () use ($id) {
            return $this->db->connection()
                ->table('users')
                ->where('id', $id)
                ->first();
        });
    }
    
    public function getActiveUsers(): array
    {
        return $this->cache->storage('default')->remember('users:active', 1800, function () {
            return $this->db->connection()
                ->table('users')
                ->where('active', true)
                ->get();
        });
    }
}
```

## 监控和调试

### 慢查询日志

```php
use Hi\Database\Logger\QueryLogger;

$logger = new QueryLogger($this->logger);

// 设置慢查询阈值
$logger->setSlowQueryThreshold(100); // 100ms

// 记录所有查询
$db->enableQueryLog($logger);

// 获取查询日志
$queries = $db->getQueryLog();
foreach ($queries as $query) {
    echo sprintf(
        "SQL: %s | Time: %.2fms | Bindings: %s\n",
        $query['sql'],
        $query['time'],
        json_encode($query['bindings'])
    );
}
```

### 连接池监控

```php
class DatabaseMonitor
{
    public function getConnectionStats(string $name): array
    {
        $pool = $this->dbManager->getPool($name);
        
        return [
            'active_connections' => $pool->getActiveConnectionCount(),
            'idle_connections' => $pool->getIdleConnectionCount(),
            'total_connections' => $pool->getTotalConnectionCount(),
            'max_connections' => $pool->getMaxConnections(),
            'wait_queue_size' => $pool->getWaitQueueSize(),
            'total_requests' => $pool->getTotalRequests(),
            'failed_requests' => $pool->getFailedRequests(),
        ];
    }
    
    public function healthCheck(): array
    {
        $connections = ['mysql', 'clickhouse', 'read_replica'];
        $results = [];
        
        foreach ($connections as $name) {
            try {
                $db = $this->dbManager->connection($name);
                $db->query('SELECT 1')->fetch();
                $results[$name] = 'healthy';
            } catch (\Exception $e) {
                $results[$name] = 'unhealthy: ' . $e->getMessage();
            }
        }
        
        return $results;
    }
}
```

## 注意事项

### 1. 连接泄漏

```php
// ❌ 避免长时间持有连接
function badExample() {
    $db = $this->dbManager->connection();
    // 长时间处理，占用连接
    sleep(30);
    return $db->query('SELECT 1');
}

// ✅ 及时释放连接
function goodExample() {
    $data = $this->dbManager->connection()->query('SELECT * FROM users')->fetchAll();
    // 连接自动归还到池中
    
    // 处理数据
    return processData($data);
}
```

### 2. 事务嵌套

```php
// ✅ 正确处理嵌套事务
class OrderService
{
    public function createOrder(array $data): int
    {
        return $this->db->transaction(function ($db) use ($data) {
            $orderId = $this->createOrderRecord($db, $data);
            
            // 检查是否已在事务中
            if ($db->inTransaction()) {
                $this->updateInventory($db, $data['items']);
            } else {
                $db->transaction(fn($db) => $this->updateInventory($db, $data['items']));
            }
            
            return $orderId;
        });
    }
}
```

### 3. 大批量操作

```php
// ✅ 分批处理大量数据
function processBulkData(array $records): void
{
    $chunks = array_chunk($records, 1000);
    
    foreach ($chunks as $chunk) {
        $this->db->transaction(function ($db) use ($chunk) {
            $db->table('processed_data')->insertMany($chunk);
        });
        
        // 释放内存
        unset($chunk);
    }
}
```

## 最佳实践

1. **连接池配置**: 根据应用负载合理配置连接池参数
2. **读写分离**: 使用主从数据库分离读写操作
3. **事务控制**: 保持事务尽可能短小，避免长事务
4. **索引优化**: 为查询条件创建合适的索引
5. **预处理语句**: 始终使用参数化查询防止SQL注入
6. **监控告警**: 监控数据库性能指标和连接池状态
7. **备份策略**: 制定完善的数据备份和恢复策略
8. **版本控制**: 使用迁移管理数据库结构变更 