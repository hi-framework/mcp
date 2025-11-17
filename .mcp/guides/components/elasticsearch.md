# Elasticsearch 搜索

Elasticsearch 组件提供强大的全文搜索、数据分析和聚合能力，支持复杂查询、实时索引、分布式搜索和性能优化，为应用程序提供企业级的搜索解决方案。

## 设计思路

### 核心特性

1. **全文搜索**: 支持复杂的全文检索和相关性评分
2. **实时索引**: 近实时的数据索引和搜索能力
3. **分布式架构**: 支持集群部署和水平扩展
4. **聚合分析**: 强大的数据聚合和统计分析功能
5. **高可用性**: 自动故障转移和数据复制
6. **灵活映射**: 动态和静态字段映射管理

### 架构组件

- **ElasticsearchManager**: ES 管理器，负责连接和配置管理
- **IndexManager**: 索引管理器，处理索引创建、删除和配置
- **DocumentManager**: 文档管理器，处理文档的 CRUD 操作
- **SearchBuilder**: 搜索构建器，构建复杂的搜索查询
- **BulkProcessor**: 批量处理器，优化大量数据操作

## 基本配置

### Elasticsearch 配置文件

```php
// config/elasticsearch.php
return [
    'default' => 'main',
    
    'connections' => [
        'main' => [
            'hosts' => [
                env('ELASTICSEARCH_HOST', 'localhost:9200'),
            ],
            'username' => env('ELASTICSEARCH_USERNAME', ''),
            'password' => env('ELASTICSEARCH_PASSWORD', ''),
            'ssl_verification' => env('ELASTICSEARCH_SSL_VERIFY', false),
            'ca_bundle' => env('ELASTICSEARCH_CA_BUNDLE', ''),
            'timeout' => 30,
            'connection_pool' => 'StaticConnectionPool',
            'retries' => 3,
            'logger' => 'default',
        ],
        
        'analytics' => [
            'hosts' => [
                'analytics1.es.local:9200',
                'analytics2.es.local:9200',
                'analytics3.es.local:9200',
            ],
            'timeout' => 60,
            'retries' => 5,
        ],
        
        'logs' => [
            'hosts' => [
                env('ELASTICSEARCH_LOGS_HOST', 'logs.es.local:9200'),
            ],
            'index_prefix' => 'logs-',
            'timeout' => 10,
        ],
    ],
    
    // 索引配置
    'indices' => [
        'products' => [
            'settings' => [
                'number_of_shards' => 3,
                'number_of_replicas' => 1,
                'analysis' => [
                    'analyzer' => [
                        'chinese_analyzer' => [
                            'type' => 'custom',
                            'tokenizer' => 'ik_max_word',
                            'filter' => ['lowercase', 'stop'],
                        ],
                    ],
                ],
            ],
            'mappings' => [
                'properties' => [
                    'name' => [
                        'type' => 'text',
                        'analyzer' => 'chinese_analyzer',
                        'fields' => [
                            'keyword' => [
                                'type' => 'keyword',
                            ],
                        ],
                    ],
                    'description' => [
                        'type' => 'text',
                        'analyzer' => 'chinese_analyzer',
                    ],
                    'price' => [
                        'type' => 'double',
                    ],
                    'category_id' => [
                        'type' => 'integer',
                    ],
                    'tags' => [
                        'type' => 'keyword',
                    ],
                    'created_at' => [
                        'type' => 'date',
                        'format' => 'yyyy-MM-dd HH:mm:ss',
                    ],
                ],
            ],
        ],
    ],
];
```

## 基本使用

### 索引管理

```php
use Hi\Elasticsearch\ElasticsearchManager;
use Hi\Elasticsearch\IndexManager;

// 获取索引管理器
$indexManager = $esManager->indexManager('main');

// 创建索引
$indexManager->createIndex('products', [
    'settings' => [
        'number_of_shards' => 3,
        'number_of_replicas' => 1,
    ],
    'mappings' => [
        'properties' => [
            'name' => ['type' => 'text'],
            'price' => ['type' => 'double'],
            'created_at' => ['type' => 'date'],
        ],
    ],
]);

// 删除索引
$indexManager->deleteIndex('old_products');

// 检查索引是否存在
if ($indexManager->existsIndex('products')) {
    echo "索引已存在\n";
}

// 获取索引信息
$indexInfo = $indexManager->getIndex('products');
$mapping = $indexManager->getMapping('products');
$settings = $indexManager->getSettings('products');

// 更新映射
$indexManager->putMapping('products', [
    'properties' => [
        'new_field' => ['type' => 'keyword'],
    ],
]);

// 索引别名管理
$indexManager->addAlias('products', 'current_products');
$indexManager->removeAlias('products', 'old_alias');
```

### 文档操作

```php
use Hi\Elasticsearch\DocumentManager;

// 获取文档管理器
$docManager = $esManager->documentManager('main');

// 创建文档
$productData = [
    'name' => 'iPhone 15 Pro',
    'description' => '最新的苹果手机，配备A17 Pro芯片',
    'price' => 8999.00,
    'category_id' => 1,
    'tags' => ['手机', '苹果', '5G'],
    'created_at' => date('Y-m-d H:i:s'),
];

$docId = $docManager->create('products', $productData);

// 带自定义ID创建
$docManager->create('products', $productData, 'product_12345');

// 获取文档
$product = $docManager->get('products', $docId);

// 更新文档
$docManager->update('products', $docId, [
    'price' => 7999.00,
    'updated_at' => date('Y-m-d H:i:s'),
]);

// 部分更新
$docManager->partialUpdate('products', $docId, [
    'doc' => ['price' => 7499.00],
    'upsert' => ['created_at' => date('Y-m-d H:i:s')],
]);

// 删除文档
$docManager->delete('products', $docId);

// 批量操作
$bulkData = [
    ['index' => ['_id' => '1']],
    ['name' => 'Product 1', 'price' => 100],
    ['index' => ['_id' => '2']],
    ['name' => 'Product 2', 'price' => 200],
    ['update' => ['_id' => '3']],
    ['doc' => ['price' => 150]],
    ['delete' => ['_id' => '4']],
];

$response = $docManager->bulk('products', $bulkData);
```

### 搜索查询

```php
use Hi\Elasticsearch\SearchBuilder;

// 获取搜索构建器
$search = $esManager->search('main');

// 简单搜索
$results = $search->index('products')
    ->query([
        'match' => [
            'name' => 'iPhone',
        ],
    ])
    ->execute();

// 复合查询
$results = $search->index('products')
    ->query([
        'bool' => [
            'must' => [
                ['match' => ['name' => 'iPhone']],
                ['range' => ['price' => ['gte' => 5000, 'lte' => 10000]]],
            ],
            'should' => [
                ['term' => ['tags' => '5G']],
                ['term' => ['category_id' => 1]],
            ],
            'must_not' => [
                ['term' => ['status' => 'deleted']],
            ],
        ],
    ])
    ->size(20)
    ->from(0)
    ->sort([
        ['price' => ['order' => 'desc']],
        ['_score' => ['order' => 'desc']],
    ])
    ->execute();

// 高亮搜索
$results = $search->index('products')
    ->query(['match' => ['description' => '手机']])
    ->highlight([
        'fields' => [
            'description' => [
                'pre_tags' => ['<em>'],
                'post_tags' => ['</em>'],
            ],
        ],
    ])
    ->execute();

// 搜索建议
$suggestions = $search->index('products')
    ->suggest([
        'name_suggestion' => [
            'text' => 'iPhon',
            'term' => [
                'field' => 'name',
            ],
        ],
    ])
    ->execute();
```

## 高级查询

### 全文搜索

```php
// 多字段搜索
$search->query([
    'multi_match' => [
        'query' => 'iPhone 手机',
        'fields' => ['name^2', 'description', 'tags'],
        'type' => 'best_fields',
        'fuzziness' => 'AUTO',
    ],
]);

// 模糊搜索
$search->query([
    'fuzzy' => [
        'name' => [
            'value' => 'iPhon',
            'fuzziness' => 2,
            'prefix_length' => 1,
        ],
    ],
]);

// 通配符搜索
$search->query([
    'wildcard' => [
        'name' => '*Phone*',
    ],
]);

// 正则表达式搜索
$search->query([
    'regexp' => [
        'name' => 'iPhone.*',
    ],
]);
```

### 过滤查询

```php
// 范围过滤
$search->filter([
    'range' => [
        'price' => [
            'gte' => 1000,
            'lte' => 5000,
        ],
    ],
]);

// 词条过滤
$search->filter([
    'terms' => [
        'category_id' => [1, 2, 3],
    ],
]);

// 存在性过滤
$search->filter([
    'exists' => [
        'field' => 'description',
    ],
]);

// 地理位置过滤
$search->filter([
    'geo_distance' => [
        'distance' => '10km',
        'location' => [
            'lat' => 40.7128,
            'lon' => -74.0060,
        ],
    ],
]);
```

### 聚合分析

```php
// 词条聚合
$search->aggregation([
    'categories' => [
        'terms' => [
            'field' => 'category_id',
            'size' => 10,
        ],
    ],
]);

// 统计聚合
$search->aggregation([
    'price_stats' => [
        'stats' => [
            'field' => 'price',
        ],
    ],
]);

// 直方图聚合
$search->aggregation([
    'price_histogram' => [
        'histogram' => [
            'field' => 'price',
            'interval' => 1000,
        ],
    ],
]);

// 日期直方图
$search->aggregation([
    'sales_over_time' => [
        'date_histogram' => [
            'field' => 'created_at',
            'calendar_interval' => 'month',
        ],
        'aggs' => [
            'total_sales' => [
                'sum' => [
                    'field' => 'price',
                ],
            ],
        ],
    ],
]);

// 嵌套聚合
$search->aggregation([
    'categories' => [
        'terms' => [
            'field' => 'category_id',
        ],
        'aggs' => [
            'avg_price' => [
                'avg' => [
                    'field' => 'price',
                ],
            ],
            'price_ranges' => [
                'range' => [
                    'field' => 'price',
                    'ranges' => [
                        ['to' => 1000],
                        ['from' => 1000, 'to' => 5000],
                        ['from' => 5000],
                    ],
                ],
            ],
        ],
    ],
]);
```

## 性能优化

### 索引优化

```php
// 批量索引优化
use Hi\Elasticsearch\BulkProcessor;

$bulkProcessor = new BulkProcessor($esManager, [
    'batch_size' => 1000,
    'flush_interval' => 30, // 秒
    'max_retries' => 3,
]);

// 批量添加文档
for ($i = 0; $i < 10000; $i++) {
    $bulkProcessor->add('products', [
        'name' => "Product {$i}",
        'price' => rand(100, 9999),
        'category_id' => rand(1, 10),
    ]);
}

// 手动刷新
$bulkProcessor->flush();

// 索引设置优化
$indexManager->updateSettings('products', [
    'refresh_interval' => '30s',     // 降低刷新频率
    'number_of_replicas' => 0,       // 索引时禁用副本
    'translog.durability' => 'async', // 异步事务日志
]);

// 完成后恢复设置
$indexManager->updateSettings('products', [
    'refresh_interval' => '1s',
    'number_of_replicas' => 1,
    'translog.durability' => 'request',
]);
```

### 搜索优化

```php
// 使用过滤器上下文（不计算评分）
$search->query([
    'bool' => [
        'filter' => [
            ['term' => ['category_id' => 1]],
            ['range' => ['price' => ['gte' => 100]]],
        ],
    ],
]);

// 禁用评分
$search->query([
    'constant_score' => [
        'filter' => [
            'term' => ['category_id' => 1],
        ],
        'boost' => 1.0,
    ],
]);

// 源字段过滤
$search->source(['name', 'price', 'category_id']);

// 结果大小限制
$search->size(100); // 不要超过 10,000

// 使用搜索后过滤
$search->postFilter([
    'term' => ['tags' => 'featured'],
]);
```

### 缓存策略

```php
use Hi\Cache\CacheManager;

class SearchService
{
    public function __construct(
        private ElasticsearchManager $es,
        private CacheManager $cache
    ) {}
    
    public function search(array $params): array
    {
        $cacheKey = 'search:' . md5(json_encode($params));
        
        return $this->cache->storage('default')->remember($cacheKey, 300, function () use ($params) {
            return $this->es->search('main')
                ->index('products')
                ->query($params['query'])
                ->size($params['size'] ?? 20)
                ->from($params['from'] ?? 0)
                ->execute();
        });
    }
    
    public function popularSearches(): array
    {
        return $this->cache->storage('default')->remember('popular_searches', 3600, function () {
            return $this->es->search('main')
                ->index('search_logs')
                ->aggregation([
                    'popular_terms' => [
                        'terms' => [
                            'field' => 'query.keyword',
                            'size' => 10,
                        ],
                    ],
                ])
                ->size(0)
                ->execute();
        });
    }
}
```

## 监控和调试

### 性能监控

```php
use Hi\Elasticsearch\Metrics\ElasticsearchMetrics;

class ElasticsearchMonitor
{
    private ElasticsearchMetrics $metrics;
    
    public function collectClusterStats(): array
    {
        $stats = $this->es->client()->cluster()->stats();
        
        return [
            'status' => $stats['status'],
            'nodes' => $stats['nodes']['count']['total'],
            'indices' => $stats['indices']['count'],
            'docs_count' => $stats['indices']['docs']['count'],
            'store_size' => $stats['indices']['store']['size_in_bytes'],
        ];
    }
    
    public function collectIndexStats(string $index): array
    {
        $stats = $this->es->client()->indices()->stats(['index' => $index]);
        
        return [
            'docs_count' => $stats['indices'][$index]['total']['docs']['count'],
            'store_size' => $stats['indices'][$index]['total']['store']['size_in_bytes'],
            'search_time' => $stats['indices'][$index]['total']['search']['time_in_millis'],
            'search_count' => $stats['indices'][$index]['total']['search']['query_total'],
            'indexing_time' => $stats['indices'][$index]['total']['indexing']['time_in_millis'],
        ];
    }
    
    public function healthCheck(): array
    {
        try {
            $health = $this->es->client()->cluster()->health();
            
            return [
                'status' => $health['status'],
                'cluster_name' => $health['cluster_name'],
                'number_of_nodes' => $health['number_of_nodes'],
                'active_primary_shards' => $health['active_primary_shards'],
                'active_shards' => $health['active_shards'],
                'unassigned_shards' => $health['unassigned_shards'],
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => $e->getMessage(),
            ];
        }
    }
}
```

### 慢查询监控

```php
class SlowQueryMonitor
{
    public function enableSlowQueryLogging(string $index): void
    {
        $this->es->indexManager()->updateSettings($index, [
            'index.search.slowlog.threshold.query.warn' => '10s',
            'index.search.slowlog.threshold.query.info' => '5s',
            'index.search.slowlog.threshold.query.debug' => '2s',
            'index.search.slowlog.threshold.query.trace' => '500ms',
            'index.search.slowlog.threshold.fetch.warn' => '1s',
            'index.search.slowlog.threshold.fetch.info' => '800ms',
        ]);
    }
    
    public function getSlowQueries(): array
    {
        // 从日志中提取慢查询
        return $this->parseSlowQueryLogs();
    }
}
```

### 搜索分析

```php
class SearchAnalyzer
{
    public function explainQuery(string $index, string $id, array $query): array
    {
        return $this->es->client()->explain([
            'index' => $index,
            'id' => $id,
            'body' => ['query' => $query],
        ]);
    }
    
    public function analyzeText(string $index, string $text, string $analyzer = null): array
    {
        $params = [
            'index' => $index,
            'body' => ['text' => $text],
        ];
        
        if ($analyzer) {
            $params['body']['analyzer'] = $analyzer;
        }
        
        return $this->es->client()->indices()->analyze($params);
    }
    
    public function validateQuery(array $query): array
    {
        return $this->es->client()->indices()->validateQuery([
            'index' => '_all',
            'body' => ['query' => $query],
            'explain' => true,
        ]);
    }
}
```

## 数据同步

### 数据库同步

```php
class DatabaseSync
{
    public function syncProducts(): void
    {
        $bulkProcessor = new BulkProcessor($this->es, [
            'batch_size' => 1000,
        ]);
        
        // 从数据库分批获取数据
        $this->db->table('products')
            ->chunk(1000, function ($products) use ($bulkProcessor) {
                foreach ($products as $product) {
                    $bulkProcessor->add('products', [
                        'name' => $product['name'],
                        'description' => $product['description'],
                        'price' => $product['price'],
                        'category_id' => $product['category_id'],
                        'tags' => json_decode($product['tags'], true),
                        'created_at' => $product['created_at'],
                    ], $product['id']);
                }
            });
        
        $bulkProcessor->flush();
    }
    
    public function incrementalSync(): void
    {
        $lastSyncTime = $this->cache->get('last_es_sync', '1970-01-01 00:00:00');
        
        $updates = $this->db->table('products')
            ->where('updated_at', '>', $lastSyncTime)
            ->get();
        
        foreach ($updates as $product) {
            if ($product['deleted_at']) {
                $this->es->documentManager()->delete('products', $product['id']);
            } else {
                $this->es->documentManager()->index('products', [
                    'name' => $product['name'],
                    'price' => $product['price'],
                    // ... 其他字段
                ], $product['id']);
            }
        }
        
        $this->cache->set('last_es_sync', date('Y-m-d H:i:s'));
    }
}
```

### 实时同步

```php
use Hi\Event\EventDispatcher;

class RealtimeSync
{
    public function __construct(
        private ElasticsearchManager $es,
        private EventDispatcher $events
    ) {
        $this->registerEventListeners();
    }
    
    private function registerEventListeners(): void
    {
        $this->events->listen(ProductCreatedEvent::class, [$this, 'onProductCreated']);
        $this->events->listen(ProductUpdatedEvent::class, [$this, 'onProductUpdated']);
        $this->events->listen(ProductDeletedEvent::class, [$this, 'onProductDeleted']);
    }
    
    public function onProductCreated(ProductCreatedEvent $event): void
    {
        $this->es->documentManager()->create('products', [
            'name' => $event->product['name'],
            'price' => $event->product['price'],
            // ... 其他字段
        ], $event->product['id']);
    }
    
    public function onProductUpdated(ProductUpdatedEvent $event): void
    {
        $this->es->documentManager()->update('products', $event->productId, [
            'doc' => $event->changes,
        ]);
    }
    
    public function onProductDeleted(ProductDeletedEvent $event): void
    {
        $this->es->documentManager()->delete('products', $event->productId);
    }
}
```

## 注意事项和最佳实践

### 索引设计

1. **映射设计**: 仔细设计字段映射，避免动态映射导致的性能问题
2. **分片策略**: 合理设置分片数量，避免过多或过少的分片
3. **副本配置**: 根据查询负载和容错需求设置副本数量
4. **字段优化**: 对不需要搜索的字段设置 `"index": false`

### 查询优化

1. **过滤优先**: 优先使用过滤器而不是查询，减少评分计算
2. **结果限制**: 限制返回结果数量，避免深度分页
3. **字段选择**: 只返回需要的字段，减少网络传输
4. **缓存利用**: 合理使用查询缓存和结果缓存

### 数据管理

1. **索引生命周期**: 实施索引生命周期管理，自动删除过期数据
2. **数据热度**: 根据数据访问频率配置不同存储层
3. **备份恢复**: 定期备份重要索引数据
4. **监控告警**: 建立完善的监控和告警机制

```php
// 最佳实践示例
class OptimizedProductSearch
{
    public function search(array $params): array
    {
        $search = $this->es->search('main')->index('products');
        
        // 使用过滤器而不是查询（当不需要评分时）
        if (isset($params['category_id'])) {
            $search->filter(['term' => ['category_id' => $params['category_id']]]);
        }
        
        if (isset($params['price_range'])) {
            $search->filter(['range' => ['price' => $params['price_range']]]);
        }
        
        // 只有在需要全文搜索时才使用查询
        if (isset($params['keyword'])) {
            $search->query(['multi_match' => [
                'query' => $params['keyword'],
                'fields' => ['name^2', 'description'],
            ]]);
        }
        
        // 限制返回字段
        $search->source(['id', 'name', 'price', 'thumbnail']);
        
        // 合理的分页大小
        $search->size(min($params['size'] ?? 20, 100));
        
        return $search->execute();
    }
}
``` 