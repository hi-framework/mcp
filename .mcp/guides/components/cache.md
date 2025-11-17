# Cache 缓存

Cache 组件提供了统一的缓存接口，支持多种缓存后端，实现了 PSR-16 Simple Cache 标准，为应用程序提供高性能的数据缓存解决方案。

## 设计思路

### 核心特性

1. **多后端支持**: 支持文件、Redis、APCu、数组等多种缓存驱动
2. **PSR-16 兼容**: 完全遵循 PSR-16 Simple Cache 标准
3. **灵活配置**: 支持多个缓存实例和按需配置
4. **高性能**: 优化的序列化和连接池管理
5. **容错机制**: 缓存失败时的降级策略

### 架构组件

- **CacheManager**: 缓存管理器，负责创建和管理缓存实例
- **Storage**: 具体的缓存存储实现
- **Serializer**: 数据序列化和反序列化
- **TaggedCache**: 支持标签的缓存系统

## 基本配置

### 缓存配置文件

```yaml
# application.yaml
cache:
  default:
    type: redis
    host: 127.0.0.1
    port: 6379
    database: 0
    prefix: 'app_cache:'
    ttl: 3600
  
  file:
    type: file
    path: '/tmp/cache'
    prefix: 'app_'
    ttl: 3600
  
  memory:
    type: array
    prefix: 'mem_'
    ttl: 1800
  
  apcu:
    type: apcu
    prefix: 'apcu_'
    ttl: 3600
```

### 基本使用

```php
use Hi\Cache\CacheManager;

// 获取默认缓存实例
$cache = $cacheManager->storage('default');

// 基本操作
$cache->set('user:123', $userData, 3600);
$user = $cache->get('user:123');
$exists = $cache->has('user:123');
$cache->delete('user:123');

// 批量操作
$cache->setMultiple([
    'user:1' => $user1,
    'user:2' => $user2,
], 3600);

$users = $cache->getMultiple(['user:1', 'user:2']);
$cache->deleteMultiple(['user:1', 'user:2']);

// 清空缓存
$cache->clear();
```

## 缓存存储类型

### Redis 缓存

```php
use Hi\Cache\CacheManager;

// Redis 配置
$config = [
    'redis' => [
        'type' => 'redis',
        'host' => '127.0.0.1',
        'port' => 6379,
        'password' => null,
        'database' => 0,
        'prefix' => 'app:',
        'ttl' => 3600,
        'serializer' => 'php', // php, json, igbinary
        'compression' => false,
    ],
];

$cacheManager = new CacheManager($config, $container);
$redis = $cacheManager->storage('redis');

// 使用 Redis 特有功能
$redis->increment('counter', 1);
$redis->decrement('counter', 1);
$redis->expire('key', 3600);
```

### 文件缓存

```php
// 文件缓存配置
$config = [
    'file' => [
        'type' => 'file',
        'path' => '/var/cache/app',
        'prefix' => 'cache_',
        'ttl' => 3600,
        'permissions' => 0755,
        'gc_probability' => 100, // 垃圾回收概率
    ],
];

$fileCache = $cacheManager->storage('file');

// 文件缓存自动清理过期文件
$fileCache->gc(); // 手动触发垃圾回收
```

### APCu 缓存

```php
// APCu 内存缓存
$config = [
    'apcu' => [
        'type' => 'apcu',
        'prefix' => 'app_',
        'ttl' => 1800,
    ],
];

$apcu = $cacheManager->storage('apcu');

// APCu 特有功能
$apcu->add('key', 'value', 3600); // 仅当键不存在时设置
$info = $apcu->info(); // 获取缓存统计信息
```

### 数组缓存（内存）

```php
// 进程内存缓存
$config = [
    'array' => [
        'type' => 'array',
        'prefix' => 'mem_',
        'max_items' => 1000, // 最大缓存项数
        'ttl' => 3600,
    ],
];

$memory = $cacheManager->storage('array');

// 适用于单次请求内的临时缓存
$memory->set('temp_data', $data);
```

## 高级用法

### 缓存标签

```php
use Hi\Cache\TaggedCache;

// 创建带标签的缓存
$tagged = new TaggedCache($cache, ['users', 'posts']);

// 设置带标签的缓存
$tagged->set('user:123', $userData);
$tagged->set('post:456', $postData);

// 按标签清空缓存
$tagged->flush(); // 清空所有带 'users' 或 'posts' 标签的缓存

// 多标签操作
$cache->tags(['users', 'active'])->set('active_users', $activeUsers);
$cache->tags(['users'])->flush(); // 清空所有用户相关缓存
```

### 缓存序列化

```php
use Hi\Cache\Serializer\JsonSerializer;
use Hi\Cache\Serializer\IgbinarySerializer;

// 自定义序列化器
class CustomSerializer implements SerializerInterface
{
    public function serialize($data): string
    {
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    
    public function unserialize(string $data)
    {
        return json_decode($data, true);
    }
}

// 配置序列化器
$config = [
    'redis' => [
        'type' => 'redis',
        'serializer' => CustomSerializer::class,
        // 其他配置...
    ],
];
```

### 缓存锁

```php
use Hi\Cache\Lock\CacheLock;

// 分布式锁
$lock = new CacheLock($cache, 'process_data', 10); // 10秒超时

if ($lock->acquire()) {
    try {
        // 执行需要锁保护的代码
        processData();
    } finally {
        $lock->release();
    }
} else {
    throw new RuntimeException('无法获取锁');
}

// 自动释放锁
$lock->block(5, function () {
    // 最多等待5秒获取锁
    processData();
});
```

## 缓存策略

### 缓存穿透防护

```php
class UserService
{
    public function __construct(
        private CacheManager $cache,
        private DatabaseManager $db
    ) {}
    
    public function getUser(int $id): ?array
    {
        $cache = $this->cache->storage('default');
        $key = "user:{$id}";
        
        // 尝试从缓存获取
        $user = $cache->get($key);
        
        if ($user === null) {
            // 从数据库获取
            $user = $this->db->connection()
                ->prepare('SELECT * FROM users WHERE id = ?')
                ->execute([$id])
                ->fetch();
                
            if ($user) {
                // 缓存用户数据
                $cache->set($key, $user, 3600);
            } else {
                // 缓存空结果防止穿透
                $cache->set($key, false, 300);
            }
        }
        
        return $user ?: null;
    }
}
```

### 缓存雪崩防护

```php
class ProductService
{
    public function getProducts(): array
    {
        $cache = $this->cache->storage('default');
        $key = 'products:all';
        
        $products = $cache->get($key);
        
        if ($products === null) {
            // 使用锁防止并发重建
            $lock = new CacheLock($cache, 'rebuild_products', 30);
            
            if ($lock->acquire()) {
                try {
                    $products = $this->loadProductsFromDatabase();
                    
                    // 随机TTL防止雪崩
                    $ttl = 3600 + random_int(0, 600);
                    $cache->set($key, $products, $ttl);
                } finally {
                    $lock->release();
                }
            } else {
                // 等待其他进程重建缓存
                sleep(1);
                $products = $cache->get($key) ?: $this->loadProductsFromDatabase();
            }
        }
        
        return $products;
    }
}
```

### 缓存预热

```php
class CacheWarmupService
{
    public function warmup(): void
    {
        $cache = $this->cache->storage('default');
        
        // 预热热点数据
        $this->warmupUsers($cache);
        $this->warmupProducts($cache);
        $this->warmupConfigs($cache);
    }
    
    private function warmupUsers(CacheInterface $cache): void
    {
        $activeUsers = $this->db->query('SELECT * FROM users WHERE active = 1')->fetchAll();
        
        foreach ($activeUsers as $user) {
            $cache->set("user:{$user['id']}", $user, 3600);
        }
    }
    
    private function warmupProducts(CacheInterface $cache): void
    {
        $products = $this->db->query('SELECT * FROM products WHERE status = "active"')->fetchAll();
        $cache->set('products:active', $products, 1800);
    }
}
```

## 性能优化

### 连接池配置

```php
// Redis 连接池配置
$config = [
    'redis' => [
        'type' => 'redis',
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 20,
            'connect_timeout' => 1.0,
            'wait_timeout' => 3.0,
            'heartbeat' => 30,
            'max_idle_time' => 60,
        ],
        // 其他配置...
    ],
];
```

### 批量操作优化

```php
// 批量获取优化
class OptimizedUserService
{
    public function getUsers(array $ids): array
    {
        $cache = $this->cache->storage('default');
        
        // 构建缓存键
        $keys = array_map(fn($id) => "user:{$id}", $ids);
        
        // 批量获取缓存
        $cached = $cache->getMultiple($keys);
        
        // 找出缓存未命中的ID
        $missingIds = [];
        foreach ($ids as $id) {
            if (!isset($cached["user:{$id}"])) {
                $missingIds[] = $id;
            }
        }
        
        // 批量查询数据库
        if ($missingIds) {
            $placeholders = str_repeat('?,', count($missingIds) - 1) . '?';
            $users = $this->db->connection()
                ->prepare("SELECT * FROM users WHERE id IN ({$placeholders})")
                ->execute($missingIds)
                ->fetchAll();
                
            // 批量写入缓存
            $toCache = [];
            foreach ($users as $user) {
                $toCache["user:{$user['id']}"] = $user;
            }
            $cache->setMultiple($toCache, 3600);
            
            // 合并结果
            $cached = array_merge($cached, $toCache);
        }
        
        return array_values($cached);
    }
}
```

### 内存使用优化

```php
// 大对象缓存优化
class OptimizedCache
{
    public function setLargeObject(string $key, $data, int $ttl = 3600): bool
    {
        $cache = $this->cache->storage('default');
        
        // 压缩大对象
        if (is_array($data) && count($data) > 100) {
            $data = gzcompress(serialize($data));
            $key .= ':compressed';
        }
        
        return $cache->set($key, $data, $ttl);
    }
    
    public function getLargeObject(string $key)
    {
        $cache = $this->cache->storage('default');
        
        $data = $cache->get($key);
        if ($data === null) {
            // 尝试压缩版本
            $data = $cache->get($key . ':compressed');
            if ($data) {
                $data = unserialize(gzuncompress($data));
            }
        }
        
        return $data;
    }
}
```

## 监控和调试

### 缓存统计

```php
class CacheMonitor
{
    public function getStats(string $storeName): array
    {
        $cache = $this->cacheManager->storage($storeName);
        
        return [
            'hits' => $cache->getHits(),
            'misses' => $cache->getMisses(),
            'hit_ratio' => $cache->getHitRatio(),
            'memory_usage' => $cache->getMemoryUsage(),
            'items_count' => $cache->getItemsCount(),
        ];
    }
    
    public function logSlowQueries(): void
    {
        $cache = $this->cacheManager->storage('default');
        
        // 启用慢查询日志
        $cache->enableSlowLog(100); // 记录超过100ms的操作
    }
}
```

### 缓存调试

```php
class CacheDebugger
{
    public function debugKey(string $key): array
    {
        $cache = $this->cache->storage('default');
        
        return [
            'exists' => $cache->has($key),
            'value' => $cache->get($key),
            'ttl' => $cache->ttl($key),
            'size' => strlen(serialize($cache->get($key))),
            'created_at' => $cache->getMetadata($key)['created_at'] ?? null,
        ];
    }
    
    public function listKeys(string $pattern = '*'): array
    {
        $cache = $this->cache->storage('default');
        return $cache->keys($pattern);
    }
}
```

## 注意事项

### 1. 序列化安全

```php
// ❌ 避免缓存不可序列化的对象
$cache->set('resource', fopen('file.txt', 'r')); // 错误

// ✅ 缓存可序列化的数据
$cache->set('user', ['id' => 1, 'name' => 'John']);
```

### 2. 缓存键命名

```php
// ✅ 使用有意义的键名
$cache->set('user:123:profile', $profile);
$cache->set('product:456:inventory', $inventory);

// ❌ 避免键名冲突
$cache->set('123', $user); // 不清楚是什么数据
```

### 3. TTL 设置

```php
// ✅ 根据数据特性设置合适的TTL
$cache->set('user:session', $session, 1800); // 会话数据30分钟
$cache->set('product:info', $product, 3600); // 产品信息1小时
$cache->set('system:config', $config, 86400); // 系统配置1天
```

### 4. 异常处理

```php
// ✅ 缓存操作异常处理
try {
    $data = $cache->get('key');
    if ($data === null) {
        $data = $this->loadFromDatabase();
        $cache->set('key', $data, 3600);
    }
} catch (CacheException $e) {
    // 缓存失败时直接访问数据源
    $this->logger->warning('Cache operation failed', ['error' => $e->getMessage()]);
    $data = $this->loadFromDatabase();
}
```

## 最佳实践

1. **分层缓存**: 使用多级缓存策略（L1: 内存, L2: Redis, L3: 数据库）
2. **合理TTL**: 根据数据更新频率设置合适的过期时间
3. **缓存预热**: 在应用启动时预加载热点数据
4. **监控指标**: 监控缓存命中率、响应时间等关键指标
5. **容错设计**: 缓存不可用时要有降级方案
6. **内存管理**: 避免缓存过大对象导致内存问题
7. **安全考虑**: 敏感数据加密存储，设置合适的访问权限
8. **版本管理**: 数据结构变化时要考虑缓存兼容性 