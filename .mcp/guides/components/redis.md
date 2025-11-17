# Redis 连接池

Hi Framework 提供了高性能的 Redis 连接池组件，通过复用连接减少连接开销，提高并发处理能力。连接池支持连接管理、健康检查、负载均衡等高级功能。

## 基本概念

Redis 连接池的核心特性：

- **连接复用** - 避免频繁创建和销毁连接
- **并发控制** - 管理最大连接数
- **健康检查** - 自动检测和移除无效连接
- **负载均衡** - 支持多个 Redis 实例的负载分发
- **故障转移** - 主从切换和故障恢复

## 配置

### 基本配置

```php
<?php

// config/redis_pool.php
return [
    'default' => [
        'host' => env('REDIS_HOST', '127.0.0.1'),
        'port' => env('REDIS_PORT', 6379),
        'password' => env('REDIS_PASSWORD', null),
        'database' => env('REDIS_DB', 0),
        'timeout' => 5.0,
        'read_timeout' => 2.0,
        'retry_interval' => 100,
        
        // 连接池配置
        'pool' => [
            'min_connections' => 1,
            'max_connections' => 10,
            'connection_timeout' => 10.0,
            'wait_timeout' => 3.0,
            'heartbeat' => 30,
            'max_idle_time' => 60,
        ],
    ],
    
    'cluster' => [
        'nodes' => [
            [
                'host' => '192.168.1.10',
                'port' => 6379,
                'password' => env('REDIS_PASSWORD', null),
            ],
            [
                'host' => '192.168.1.11', 
                'port' => 6379,
                'password' => env('REDIS_PASSWORD', null),
            ],
            [
                'host' => '192.168.1.12',
                'port' => 6379,
                'password' => env('REDIS_PASSWORD', null),
            ],
        ],
        
        'pool' => [
            'min_connections' => 2,
            'max_connections' => 20,
            'connection_timeout' => 10.0,
            'wait_timeout' => 5.0,
        ],
    ],
];
```

### 高级配置

```php
<?php

// config/redis_pool.php - 高级配置
return [
    'production' => [
        'master' => [
            'host' => '192.168.1.100',
            'port' => 6379,
            'role' => 'master',
        ],
        
        'slaves' => [
            [
                'host' => '192.168.1.101',
                'port' => 6379,
                'role' => 'slave',
            ],
            [
                'host' => '192.168.1.102',
                'port' => 6379, 
                'role' => 'slave',
            ],
        ],
        
        'sentinel' => [
            'enabled' => true,
            'master_name' => 'mymaster',
            'sentinels' => [
                ['host' => '192.168.1.110', 'port' => 26379],
                ['host' => '192.168.1.111', 'port' => 26379],
                ['host' => '192.168.1.112', 'port' => 26379],
            ],
        ],
        
        'pool' => [
            'min_connections' => 5,
            'max_connections' => 50,
            'connection_timeout' => 10.0,
            'wait_timeout' => 5.0,
            'heartbeat' => 30,
            'max_idle_time' => 300,
            'max_lifetime' => 3600,
        ],
        
        'retry' => [
            'max_attempts' => 3,
            'delay' => 100,
            'multiplier' => 2,
        ],
    ],
];
```

## 连接池实现

### 基础连接池

```php
<?php

namespace Hi\Redis\Pool;

use Hi\Redis\RedisConnection;

class RedisConnectionPool
{
    private array $config;
    private array $connections = [];
    private array $available = [];
    private array $used = [];
    private int $totalConnections = 0;
    
    public function __construct(array $config)
    {
        $this->config = $config;
        $this->initializePool();
    }
    
    private function initializePool(): void
    {
        $minConnections = $this->config['pool']['min_connections'] ?? 1;
        
        for ($i = 0; $i < $minConnections; $i++) {
            $connection = $this->createConnection();
            $this->available[] = $connection;
            $this->connections[] = $connection;
            $this->totalConnections++;
        }
    }
    
    public function getConnection(): RedisConnection
    {
        // 优先使用可用连接
        if (!empty($this->available)) {
            $connection = array_pop($this->available);
            
            if ($this->isConnectionValid($connection)) {
                $this->used[] = $connection;
                return $connection;
            } else {
                $this->removeConnection($connection);
            }
        }
        
        // 创建新连接
        if ($this->canCreateNewConnection()) {
            $connection = $this->createConnection();
            $this->connections[] = $connection;
            $this->used[] = $connection;
            $this->totalConnections++;
            return $connection;
        }
        
        // 等待可用连接
        return $this->waitForConnection();
    }
    
    public function releaseConnection(RedisConnection $connection): void
    {
        $key = array_search($connection, $this->used, true);
        
        if ($key !== false) {
            unset($this->used[$key]);
            
            if ($this->isConnectionValid($connection)) {
                $this->available[] = $connection;
            } else {
                $this->removeConnection($connection);
            }
        }
    }
    
    private function createConnection(): RedisConnection
    {
        $connection = new RedisConnection(
            $this->config['host'],
            $this->config['port'],
            $this->config['timeout'] ?? 5.0
        );
        
        if (!empty($this->config['password'])) {
            $connection->auth($this->config['password']);
        }
        
        if (isset($this->config['database'])) {
            $connection->select($this->config['database']);
        }
        
        $connection->setCreatedAt(time());
        
        return $connection;
    }
    
    private function isConnectionValid(RedisConnection $connection): bool
    {
        try {
            // 检查连接是否存活
            $connection->ping();
            
            // 检查连接年龄
            $maxLifetime = $this->config['pool']['max_lifetime'] ?? 3600;
            if (time() - $connection->getCreatedAt() > $maxLifetime) {
                return false;
            }
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    private function canCreateNewConnection(): bool
    {
        $maxConnections = $this->config['pool']['max_connections'] ?? 10;
        return $this->totalConnections < $maxConnections;
    }
    
    private function waitForConnection(): RedisConnection
    {
        $waitTimeout = $this->config['pool']['wait_timeout'] ?? 3.0;
        $startTime = microtime(true);
        
        while (microtime(true) - $startTime < $waitTimeout) {
            if (!empty($this->available)) {
                return $this->getConnection();
            }
            
            usleep(10000); // 等待10毫秒
        }
        
        throw new \RuntimeException('等待连接超时');
    }
    
    private function removeConnection(RedisConnection $connection): void
    {
        $connection->close();
        
        $key = array_search($connection, $this->connections, true);
        if ($key !== false) {
            unset($this->connections[$key]);
            $this->totalConnections--;
        }
    }
    
    public function getStats(): array
    {
        return [
            'total_connections' => $this->totalConnections,
            'available_connections' => count($this->available),
            'used_connections' => count($this->used),
            'max_connections' => $this->config['pool']['max_connections'] ?? 10,
            'min_connections' => $this->config['pool']['min_connections'] ?? 1,
        ];
    }
    
    public function close(): void
    {
        foreach ($this->connections as $connection) {
            $connection->close();
        }
        
        $this->connections = [];
        $this->available = [];
        $this->used = [];
        $this->totalConnections = 0;
    }
}
```

### 协程安全连接池

```php
<?php

namespace Hi\Redis\Pool;

use Hi\Coroutine\Channel;

class CoroutineRedisPool
{
    private array $config;
    private Channel $channel;
    private int $connectionCount = 0;
    
    public function __construct(array $config)
    {
        $this->config = $config;
        $maxConnections = $config['pool']['max_connections'] ?? 10;
        $this->channel = new Channel($maxConnections);
        
        $this->initializeConnections();
    }
    
    private function initializeConnections(): void
    {
        $minConnections = $this->config['pool']['min_connections'] ?? 1;
        
        for ($i = 0; $i < $minConnections; $i++) {
            $connection = $this->createConnection();
            $this->channel->push($connection);
            $this->connectionCount++;
        }
    }
    
    public function getConnection(float $timeout = 3.0): RedisConnection
    {
        // 尝试从通道获取连接
        $connection = $this->channel->pop($timeout);
        
        if ($connection === false) {
            // 通道为空，尝试创建新连接
            if ($this->canCreateNewConnection()) {
                return $this->createConnection();
            }
            
            throw new \RuntimeException('获取连接超时');
        }
        
        // 验证连接有效性
        if (!$this->isConnectionValid($connection)) {
            $this->connectionCount--;
            return $this->getConnection($timeout);
        }
        
        return $connection;
    }
    
    public function releaseConnection(RedisConnection $connection): void
    {
        if ($this->isConnectionValid($connection)) {
            $this->channel->push($connection);
        } else {
            $this->connectionCount--;
            
            // 如果连接数低于最小值，创建新连接
            if ($this->connectionCount < $this->config['pool']['min_connections']) {
                $newConnection = $this->createConnection();
                $this->channel->push($newConnection);
                $this->connectionCount++;
            }
        }
    }
    
    public function execute(callable $callback, float $timeout = 3.0)
    {
        $connection = $this->getConnection($timeout);
        
        try {
            return $callback($connection);
        } finally {
            $this->releaseConnection($connection);
        }
    }
    
    private function createConnection(): RedisConnection
    {
        $connection = new RedisConnection(
            $this->config['host'],
            $this->config['port'],
            $this->config['timeout'] ?? 5.0
        );
        
        if (!empty($this->config['password'])) {
            $connection->auth($this->config['password']);
        }
        
        if (isset($this->config['database'])) {
            $connection->select($this->config['database']);
        }
        
        $connection->setCreatedAt(time());
        $this->connectionCount++;
        
        return $connection;
    }
    
    private function canCreateNewConnection(): bool
    {
        $maxConnections = $this->config['pool']['max_connections'] ?? 10;
        return $this->connectionCount < $maxConnections;
    }
    
    private function isConnectionValid(RedisConnection $connection): bool
    {
        try {
            $connection->ping();
            
            $maxLifetime = $this->config['pool']['max_lifetime'] ?? 3600;
            if (time() - $connection->getCreatedAt() > $maxLifetime) {
                return false;
            }
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function getStats(): array
    {
        return [
            'total_connections' => $this->connectionCount,
            'available_connections' => $this->channel->length(),
            'max_connections' => $this->config['pool']['max_connections'] ?? 10,
            'min_connections' => $this->config['pool']['min_connections'] ?? 1,
        ];
    }
}
```

## 使用方式

### 基本使用

```php
<?php

use Hi\Redis\Pool\RedisPoolManager;

class UserService
{
    private RedisPoolManager $redis;
    
    public function __construct(RedisPoolManager $redis)
    {
        $this->redis = $redis;
    }
    
    public function getUser(int $userId): ?array
    {
        return $this->redis->execute(function ($connection) use ($userId) {
            $key = "user:{$userId}";
            $data = $connection->get($key);
            
            return $data ? json_decode($data, true) : null;
        });
    }
    
    public function setUser(int $userId, array $userData, int $ttl = 3600): void
    {
        $this->redis->execute(function ($connection) use ($userId, $userData, $ttl) {
            $key = "user:{$userId}";
            $connection->setex($key, $ttl, json_encode($userData));
        });
    }
    
    public function deleteUser(int $userId): void
    {
        $this->redis->execute(function ($connection) use ($userId) {
            $key = "user:{$userId}";
            $connection->del($key);
        });
    }
}
```

### 批量操作

```php
<?php

class BatchRedisOperations
{
    private RedisPoolManager $redis;
    
    public function batchGet(array $keys): array
    {
        return $this->redis->execute(function ($connection) use ($keys) {
            return $connection->mget($keys);
        });
    }
    
    public function batchSet(array $keyValues, int $ttl = 0): void
    {
        $this->redis->execute(function ($connection) use ($keyValues, $ttl) {
            $connection->pipeline(function ($pipe) use ($keyValues, $ttl) {
                foreach ($keyValues as $key => $value) {
                    if ($ttl > 0) {
                        $pipe->setex($key, $ttl, $value);
                    } else {
                        $pipe->set($key, $value);
                    }
                }
            });
        });
    }
    
    public function batchDelete(array $keys): int
    {
        return $this->redis->execute(function ($connection) use ($keys) {
            return $connection->del(...$keys);
        });
    }
}
```

### 事务操作

```php
<?php

class RedisTransactionService
{
    private RedisPoolManager $redis;
    
    public function transferPoints(int $fromUserId, int $toUserId, int $points): bool
    {
        return $this->redis->execute(function ($connection) use ($fromUserId, $toUserId, $points) {
            $fromKey = "user:{$fromUserId}:points";
            $toKey = "user:{$toUserId}:points";
            
            $connection->watch($fromKey);
            
            $fromPoints = (int) $connection->get($fromKey);
            
            if ($fromPoints < $points) {
                $connection->unwatch();
                return false;
            }
            
            $connection->multi();
            $connection->decrby($fromKey, $points);
            $connection->incrby($toKey, $points);
            
            $result = $connection->exec();
            
            return $result !== false;
        });
    }
}
```

## 最佳实践

### 1. 配置优化

```php
<?php

// 根据应用特点调整连接池配置
$config = [
    'pool' => [
        // 高并发应用
        'min_connections' => 10,
        'max_connections' => 100,
        'connection_timeout' => 5.0,
        'wait_timeout' => 3.0,
        
        // 低延迟要求
        'heartbeat' => 10,
        'max_idle_time' => 30,
        'max_lifetime' => 1800,
    ]
];
```

### 2. 错误处理

```php
<?php

class ResilientRedisService
{
    private RedisPoolManager $redis;
    private int $maxRetries = 3;
    
    public function safeExecute(callable $callback, $default = null)
    {
        $attempts = 0;
        
        while ($attempts < $this->maxRetries) {
            try {
                return $this->redis->execute($callback);
            } catch (\Exception $e) {
                $attempts++;
                
                if ($attempts >= $this->maxRetries) {
                    logger()->error('Redis操作失败', [
                        'error' => $e->getMessage(),
                        'attempts' => $attempts
                    ]);
                    
                    return $default;
                }
                
                // 指数退避
                usleep(pow(2, $attempts) * 10000);
            }
        }
        
        return $default;
    }
}
```

### 3. 资源管理

```php
<?php

class RedisResourceManager
{
    private RedisConnectionPool $pool;
    
    public function withConnection(callable $callback)
    {
        $connection = null;
        
        try {
            $connection = $this->pool->getConnection();
            return $callback($connection);
        } finally {
            if ($connection) {
                $this->pool->releaseConnection($connection);
            }
        }
    }
    
    public function batchWithConnection(array $operations): array
    {
        return $this->withConnection(function ($connection) use ($operations) {
            $results = [];
            
            foreach ($operations as $operation) {
                $results[] = $operation($connection);
            }
            
            return $results;
        });
    }
}
```

## 总结

Redis 连接池的核心价值：

- **性能提升** - 减少连接创建开销
- **资源管理** - 控制并发连接数
- **高可用性** - 自动故障检测和恢复
- **可监控性** - 完整的指标和健康检查
- **易用性** - 简单的 API 和自动管理

通过合理使用 Redis 连接池，可以显著提高应用程序的性能和稳定性。 