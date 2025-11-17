# Metric 指标

Metric 组件提供强大的应用程序指标收集、聚合和导出能力，支持多种指标类型、实时监控和多后端导出，为应用程序性能监控和业务分析提供全面的数据支持。

## 设计思路

### 核心特性

1. **多指标类型**: 支持计数器、仪表盘、直方图和摘要指标
2. **实时聚合**: 高效的内存指标聚合和计算
3. **多后端导出**: 支持 Prometheus、StatsD、InfluxDB 等多种后端
4. **标签支持**: 灵活的多维度标签系统
5. **性能优化**: 低延迟的指标收集和处理
6. **自动发现**: 自动发现和注册指标

### 架构组件

- **MetricRegistry**: 指标注册表，管理所有指标实例
- **MetricCollector**: 指标收集器，负责数据收集和聚合
- **MetricExporter**: 指标导出器，支持多种导出后端
- **MetricTypes**: 各种指标类型的实现
- **MetricProcessor**: 指标处理器，执行计算和转换

## 基本配置

### Metric 配置文件

```php
// config/metric.php
return [
    'enabled' => env('METRICS_ENABLED', true),
    'default_labels' => [
        'service' => env('SERVICE_NAME', 'typing-php-app'),
        'version' => env('SERVICE_VERSION', '1.0.0'),
        'environment' => env('APP_ENV', 'production'),
        'instance' => gethostname(),
    ],
    
    // 收集器配置
    'collector' => [
        'buffer_size' => 10000,      // 缓冲区大小
        'flush_interval' => 30,      // 刷新间隔（秒）
        'batch_size' => 1000,        // 批处理大小
        'memory_limit' => '128M',    // 内存限制
    ],
    
    // 导出器配置
    'exporters' => [
        'prometheus' => [
            'enabled' => env('PROMETHEUS_ENABLED', true),
            'push_gateway' => [
                'url' => env('PROMETHEUS_PUSH_GATEWAY', 'http://localhost:9091'),
                'job' => env('PROMETHEUS_JOB_NAME', 'typing-php-app'),
                'timeout' => 5,
                'interval' => 15, // 推送间隔（秒）
            ],
            'pull_server' => [
                'enabled' => env('PROMETHEUS_PULL_ENABLED', false),
                'host' => env('PROMETHEUS_PULL_HOST', '0.0.0.0'),
                'port' => env('PROMETHEUS_PULL_PORT', 9464),
                'path' => '/metrics',
            ],
        ],
        
        'statsd' => [
            'enabled' => env('STATSD_ENABLED', false),
            'host' => env('STATSD_HOST', 'localhost'),
            'port' => env('STATSD_PORT', 8125),
            'prefix' => env('STATSD_PREFIX', 'app'),
            'tags_format' => 'datadog', // datadog, influxdb
        ],
        
        'influxdb' => [
            'enabled' => env('INFLUXDB_ENABLED', false),
            'url' => env('INFLUXDB_URL', 'http://localhost:8086'),
            'database' => env('INFLUXDB_DATABASE', 'metrics'),
            'username' => env('INFLUXDB_USERNAME', ''),
            'password' => env('INFLUXDB_PASSWORD', ''),
            'retention_policy' => 'default',
        ],
        
        'console' => [
            'enabled' => env('METRICS_CONSOLE_DEBUG', false),
            'format' => 'table', // table, json, plain
        ],
    ],
    
    // 预定义指标
    'predefined_metrics' => [
        'http_requests_total' => [
            'type' => 'counter',
            'description' => 'HTTP 请求总数',
            'labels' => ['method', 'status', 'endpoint'],
        ],
        'http_request_duration_seconds' => [
            'type' => 'histogram',
            'description' => 'HTTP 请求处理时间',
            'labels' => ['method', 'status'],
            'buckets' => [0.005, 0.01, 0.025, 0.05, 0.1, 0.25, 0.5, 1, 2.5, 5, 10],
        ],
        'memory_usage_bytes' => [
            'type' => 'gauge',
            'description' => '内存使用量',
        ],
        'active_connections' => [
            'type' => 'gauge',
            'description' => '活跃连接数',
        ],
    ],
];
```

## 基本使用

### 计数器（Counter）

```php
use Hi\Metric\MetricRegistry;
use Hi\Metric\Counter;

// 获取指标注册表
$registry = app(MetricRegistry::class);

// 创建计数器
$requestCounter = $registry->counter('http_requests_total', 'HTTP 请求总数', [
    'method', 'status', 'endpoint'
]);

// 增加计数
$requestCounter->increment(); // 增加 1
$requestCounter->increment(['method' => 'GET', 'status' => '200', 'endpoint' => '/api/users']);

// 增加指定值
$requestCounter->add(5, ['method' => 'POST', 'status' => '201', 'endpoint' => '/api/orders']);

// 业务计数器
$orderCounter = $registry->counter('orders_total', '订单总数', ['status', 'channel']);
$orderCounter->increment(['status' => 'completed', 'channel' => 'web']);

$errorCounter = $registry->counter('errors_total', '错误总数', ['type', 'severity']);
$errorCounter->increment(['type' => 'validation', 'severity' => 'warning']);
```

### 仪表盘（Gauge）

```php
use Hi\Metric\Gauge;

// 创建仪表盘
$memoryGauge = $registry->gauge('memory_usage_bytes', '内存使用量');
$connectionsGauge = $registry->gauge('active_connections', '活跃连接数');
$queueGauge = $registry->gauge('queue_size', '队列大小', ['queue_name']);

// 设置值
$memoryGauge->set(memory_get_usage(true));
$connectionsGauge->set(45);
$queueGauge->set(123, ['queue_name' => 'orders']);

// 增加/减少值
$connectionsGauge->increment(); // +1
$connectionsGauge->decrement(); // -1
$connectionsGauge->add(5);      // +5
$connectionsGauge->subtract(3); // -3

// 业务仪表盘
$inventoryGauge = $registry->gauge('inventory_count', '库存数量', ['product_id', 'warehouse']);
$inventoryGauge->set(500, ['product_id' => 'ABC123', 'warehouse' => 'main']);

$balanceGauge = $registry->gauge('account_balance', '账户余额', ['account_id']);
$balanceGauge->set(1500.50, ['account_id' => 'user_123']);
```

### 直方图（Histogram）

```php
use Hi\Metric\Histogram;

// 创建直方图
$durationHistogram = $registry->histogram('http_request_duration_seconds', 'HTTP 请求处理时间', [
    'method', 'status'
], [
    'buckets' => [0.005, 0.01, 0.025, 0.05, 0.1, 0.25, 0.5, 1, 2.5, 5, 10]
]);

// 观察值
$startTime = microtime(true);
// ... 处理请求
$duration = microtime(true) - $startTime;
$durationHistogram->observe($duration, ['method' => 'GET', 'status' => '200']);

// 数据库查询时间
$dbQueryHistogram = $registry->histogram('db_query_duration_seconds', '数据库查询时间', [
    'table', 'operation'
], [
    'buckets' => [0.001, 0.005, 0.01, 0.025, 0.05, 0.1, 0.25, 0.5, 1]
]);

$startTime = microtime(true);
$users = $db->query('SELECT * FROM users WHERE active = 1');
$queryTime = microtime(true) - $startTime;
$dbQueryHistogram->observe($queryTime, ['table' => 'users', 'operation' => 'select']);

// 业务处理时间
$orderProcessHistogram = $registry->histogram('order_processing_duration_seconds', '订单处理时间', [
    'order_type'
]);
$orderProcessHistogram->observe(2.5, ['order_type' => 'standard']);
```

### 摘要（Summary）

```php
use Hi\Metric\Summary;

// 创建摘要
$responseSizeSummary = $registry->summary('http_response_size_bytes', 'HTTP 响应大小', [
    'method', 'status'
], [
    'quantiles' => [0.5, 0.9, 0.95, 0.99]
]);

// 观察值
$responseSize = strlen($responseBody);
$responseSizeSummary->observe($responseSize, ['method' => 'GET', 'status' => '200']);

// 文件大小统计
$fileSizeSummary = $registry->summary('uploaded_file_size_bytes', '上传文件大小');
$fileSizeSummary->observe($fileSize);

// 批处理统计
$batchSizeSummary = $registry->summary('batch_size', '批处理记录数', ['batch_type']);
$batchSizeSummary->observe(1000, ['batch_type' => 'user_export']);
```

## 高级功能

### 自动化指标收集

```php
use Hi\Metric\Middleware\MetricMiddleware;

class MetricMiddleware
{
    public function handle($request, $next)
    {
        $registry = app(MetricRegistry::class);
        $startTime = microtime(true);
        
        // 请求计数器
        $requestCounter = $registry->counter('http_requests_total');
        $requestCounter->increment([
            'method' => $request->getMethod(),
            'endpoint' => $this->getEndpoint($request),
        ]);
        
        try {
            $response = $next($request);
            $statusCode = $response->getStatusCode();
            
        } catch (\Exception $e) {
            $statusCode = 500;
            
            // 错误计数
            $errorCounter = $registry->counter('http_errors_total');
            $errorCounter->increment([
                'method' => $request->getMethod(),
                'error_type' => get_class($e),
            ]);
            
            throw $e;
            
        } finally {
            $duration = microtime(true) - $startTime;
            
            // 请求时间
            $durationHistogram = $registry->histogram('http_request_duration_seconds');
            $durationHistogram->observe($duration, [
                'method' => $request->getMethod(),
                'status' => (string) $statusCode,
            ]);
            
            // 响应大小
            if (isset($response)) {
                $responseSize = $response->getHeaderLine('Content-Length') ?: 0;
                $sizeHistogram = $registry->histogram('http_response_size_bytes');
                $sizeHistogram->observe((float) $responseSize, [
                    'method' => $request->getMethod(),
                    'status' => (string) $statusCode,
                ]);
            }
        }
        
        return $response;
    }
}
```

### 业务指标装饰器

```php
use Hi\Metric\MetricDecorator;

class MetricDecorator
{
    public function __construct(
        private MetricRegistry $registry
    ) {}
    
    public function measureExecution(callable $callback, string $operation, array $labels = [])
    {
        $startTime = microtime(true);
        $memoryBefore = memory_get_usage(true);
        
        // 操作计数器
        $operationCounter = $this->registry->counter('operations_total');
        $operationCounter->increment(array_merge(['operation' => $operation], $labels));
        
        try {
            $result = $callback();
            
            // 成功计数器
            $successCounter = $this->registry->counter('operations_success_total');
            $successCounter->increment(array_merge(['operation' => $operation], $labels));
            
            return $result;
            
        } catch (\Exception $e) {
            // 失败计数器
            $failureCounter = $this->registry->counter('operations_failure_total');
            $failureCounter->increment(array_merge([
                'operation' => $operation,
                'error_type' => get_class($e),
            ], $labels));
            
            throw $e;
            
        } finally {
            $duration = microtime(true) - $startTime;
            $memoryUsed = memory_get_usage(true) - $memoryBefore;
            
            // 执行时间
            $durationHistogram = $this->registry->histogram('operation_duration_seconds');
            $durationHistogram->observe($duration, array_merge(['operation' => $operation], $labels));
            
            // 内存使用
            $memoryHistogram = $this->registry->histogram('operation_memory_bytes');
            $memoryHistogram->observe($memoryUsed, array_merge(['operation' => $operation], $labels));
        }
    }
    
    public function measureDatabaseQuery(callable $query, string $table, string $operation): mixed
    {
        return $this->measureExecution($query, 'db_query', [
            'table' => $table,
            'operation' => $operation,
        ]);
    }
    
    public function measureCacheOperation(callable $operation, string $key, string $op): mixed
    {
        return $this->measureExecution($operation, 'cache_operation', [
            'operation' => $op,
            'key_prefix' => $this->getKeyPrefix($key),
        ]);
    }
}
```

### 系统指标收集器

```php
use Hi\Metric\SystemMetrics;

class SystemMetricsCollector
{
    private MetricRegistry $registry;
    
    public function __construct(MetricRegistry $registry)
    {
        $this->registry = $registry;
        $this->setupSystemMetrics();
    }
    
    private function setupSystemMetrics(): void
    {
        // 内存指标
        $this->registry->gauge('process_memory_usage_bytes', '进程内存使用量');
        $this->registry->gauge('process_memory_peak_bytes', '进程内存峰值');
        
        // CPU 指标
        $this->registry->gauge('process_cpu_usage_percent', 'CPU 使用率');
        
        // 文件描述符
        $this->registry->gauge('process_open_fds', '打开的文件描述符数量');
        
        // PHP 指标
        $this->registry->gauge('php_opcache_hit_rate', 'OPCache 命中率');
        $this->registry->gauge('php_opcache_memory_usage_bytes', 'OPCache 内存使用量');
    }
    
    public function collect(): void
    {
        // 收集内存指标
        $memoryUsage = $this->registry->gauge('process_memory_usage_bytes');
        $memoryUsage->set(memory_get_usage(true));
        
        $memoryPeak = $this->registry->gauge('process_memory_peak_bytes');
        $memoryPeak->set(memory_get_peak_usage(true));
        
        // 收集 OPCache 指标
        if (function_exists('opcache_get_status')) {
            $opcacheStatus = opcache_get_status();
            if ($opcacheStatus) {
                $hitRate = $this->registry->gauge('php_opcache_hit_rate');
                $totalRequests = $opcacheStatus['opcache_statistics']['hits'] + $opcacheStatus['opcache_statistics']['misses'];
                if ($totalRequests > 0) {
                    $hitRate->set($opcacheStatus['opcache_statistics']['hits'] / $totalRequests * 100);
                }
                
                $memoryUsage = $this->registry->gauge('php_opcache_memory_usage_bytes');
                $memoryUsage->set($opcacheStatus['memory_usage']['used_memory']);
            }
        }
        
        // 收集文件描述符信息（Linux）
        if (is_readable('/proc/self/fd')) {
            $fds = count(scandir('/proc/self/fd')) - 2; // 减去 . 和 ..
            $openFds = $this->registry->gauge('process_open_fds');
            $openFds->set($fds);
        }
    }
}
```

### 自定义指标类型

```php
use Hi\Metric\MetricInterface;

class RateMeter implements MetricInterface
{
    private array $samples = [];
    private int $windowSize;
    
    public function __construct(
        private string $name,
        private string $description = '',
        private array $labels = [],
        int $windowSize = 60
    ) {
        $this->windowSize = $windowSize;
    }
    
    public function mark(int $count = 1, array $labels = []): void
    {
        $now = time();
        $this->samples[] = ['time' => $now, 'count' => $count, 'labels' => $labels];
        
        // 清理过期样本
        $this->samples = array_filter($this->samples, function($sample) use ($now) {
            return ($now - $sample['time']) <= $this->windowSize;
        });
    }
    
    public function getRate(array $labels = []): float
    {
        $now = time();
        $windowStart = $now - $this->windowSize;
        
        $count = 0;
        foreach ($this->samples as $sample) {
            if ($sample['time'] >= $windowStart && $this->labelsMatch($sample['labels'], $labels)) {
                $count += $sample['count'];
            }
        }
        
        return $count / $this->windowSize;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getDescription(): string
    {
        return $this->description;
    }
    
    public function getLabels(): array
    {
        return $this->labels;
    }
    
    public function getValue(): mixed
    {
        return $this->getRate();
    }
    
    private function labelsMatch(array $sampleLabels, array $filterLabels): bool
    {
        foreach ($filterLabels as $key => $value) {
            if (!isset($sampleLabels[$key]) || $sampleLabels[$key] !== $value) {
                return false;
            }
        }
        return true;
    }
}
```

## 数据导出

### Prometheus 导出

```php
use Hi\Metric\Exporters\PrometheusExporter;

class PrometheusExporter
{
    public function export(MetricRegistry $registry): string
    {
        $output = '';
        
        foreach ($registry->getMetrics() as $metric) {
            $output .= $this->formatMetric($metric);
        }
        
        return $output;
    }
    
    private function formatMetric(MetricInterface $metric): string
    {
        $output = '';
        $name = $this->sanitizeName($metric->getName());
        $description = $metric->getDescription();
        
        // HELP 行
        if ($description) {
            $output .= "# HELP {$name} {$description}\n";
        }
        
        // TYPE 行
        $output .= "# TYPE {$name} " . $this->getPrometheusType($metric) . "\n";
        
        // 数据行
        if ($metric instanceof Counter) {
            $output .= $this->formatCounter($metric);
        } elseif ($metric instanceof Gauge) {
            $output .= $this->formatGauge($metric);
        } elseif ($metric instanceof Histogram) {
            $output .= $this->formatHistogram($metric);
        } elseif ($metric instanceof Summary) {
            $output .= $this->formatSummary($metric);
        }
        
        return $output . "\n";
    }
    
    private function formatCounter(Counter $counter): string
    {
        $output = '';
        $name = $this->sanitizeName($counter->getName());
        
        foreach ($counter->getSamples() as $sample) {
            $labels = $this->formatLabels($sample['labels']);
            $output .= "{$name}{$labels} {$sample['value']}\n";
        }
        
        return $output;
    }
    
    private function formatHistogram(Histogram $histogram): string
    {
        $output = '';
        $name = $this->sanitizeName($histogram->getName());
        
        foreach ($histogram->getSamples() as $sample) {
            $labels = $sample['labels'];
            $labelStr = $this->formatLabels($labels);
            
            // 桶计数
            foreach ($sample['buckets'] as $le => $count) {
                $bucketLabels = array_merge($labels, ['le' => $le]);
                $bucketLabelStr = $this->formatLabels($bucketLabels);
                $output .= "{$name}_bucket{$bucketLabelStr} {$count}\n";
            }
            
            // 总计数
            $output .= "{$name}_count{$labelStr} {$sample['count']}\n";
            
            // 总和
            $output .= "{$name}_sum{$labelStr} {$sample['sum']}\n";
        }
        
        return $output;
    }
}
```

### StatsD 导出

```php
use Hi\Metric\Exporters\StatsDExporter;

class StatsDExporter
{
    private string $host;
    private int $port;
    private string $prefix;
    
    public function __construct(string $host, int $port, string $prefix = '')
    {
        $this->host = $host;
        $this->port = $port;
        $this->prefix = $prefix;
    }
    
    public function export(MetricRegistry $registry): void
    {
        $socket = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        
        foreach ($registry->getMetrics() as $metric) {
            $packets = $this->formatMetric($metric);
            
            foreach ($packets as $packet) {
                socket_sendto($socket, $packet, strlen($packet), 0, $this->host, $this->port);
            }
        }
        
        socket_close($socket);
    }
    
    private function formatMetric(MetricInterface $metric): array
    {
        $packets = [];
        $name = $this->prefix . $metric->getName();
        
        if ($metric instanceof Counter) {
            foreach ($metric->getSamples() as $sample) {
                $tags = $this->formatTags($sample['labels']);
                $packets[] = "{$name}:{$sample['value']}|c{$tags}";
            }
        } elseif ($metric instanceof Gauge) {
            foreach ($metric->getSamples() as $sample) {
                $tags = $this->formatTags($sample['labels']);
                $packets[] = "{$name}:{$sample['value']}|g{$tags}";
            }
        } elseif ($metric instanceof Histogram) {
            foreach ($metric->getSamples() as $sample) {
                $tags = $this->formatTags($sample['labels']);
                
                // 发送每个观察值作为计时器
                foreach ($sample['values'] as $value) {
                    $milliseconds = $value * 1000;
                    $packets[] = "{$name}:{$milliseconds}|ms{$tags}";
                }
            }
        }
        
        return $packets;
    }
    
    private function formatTags(array $labels): string
    {
        if (empty($labels)) {
            return '';
        }
        
        $tags = [];
        foreach ($labels as $key => $value) {
            $tags[] = "{$key}:{$value}";
        }
        
        return '|#' . implode(',', $tags);
    }
}
```

## 性能优化

### 批量处理

```php
use Hi\Metric\BatchProcessor;

class BatchProcessor
{
    private array $buffer = [];
    private int $batchSize;
    private int $flushInterval;
    private float $lastFlush;
    
    public function __construct(int $batchSize = 1000, int $flushInterval = 30)
    {
        $this->batchSize = $batchSize;
        $this->flushInterval = $flushInterval;
        $this->lastFlush = microtime(true);
    }
    
    public function addMetric(MetricInterface $metric): void
    {
        $this->buffer[] = $metric;
        
        // 检查是否需要刷新
        if (count($this->buffer) >= $this->batchSize || 
            (microtime(true) - $this->lastFlush) >= $this->flushInterval) {
            $this->flush();
        }
    }
    
    public function flush(): void
    {
        if (empty($this->buffer)) {
            return;
        }
        
        // 批量处理指标
        $this->processBatch($this->buffer);
        
        // 清空缓冲区
        $this->buffer = [];
        $this->lastFlush = microtime(true);
    }
    
    private function processBatch(array $metrics): void
    {
        // 聚合相同指标
        $aggregated = [];
        
        foreach ($metrics as $metric) {
            $key = $this->getMetricKey($metric);
            
            if (!isset($aggregated[$key])) {
                $aggregated[$key] = $metric;
            } else {
                $aggregated[$key] = $this->mergeMetrics($aggregated[$key], $metric);
            }
        }
        
        // 导出聚合后的指标
        foreach ($aggregated as $metric) {
            $this->exportMetric($metric);
        }
    }
}
```

### 内存优化

```php
use Hi\Metric\MemoryOptimizer;

class MemoryOptimizer
{
    private int $maxSamples;
    private int $retentionPeriod;
    
    public function __construct(int $maxSamples = 10000, int $retentionPeriod = 300)
    {
        $this->maxSamples = $maxSamples;
        $this->retentionPeriod = $retentionPeriod;
    }
    
    public function optimizeRegistry(MetricRegistry $registry): void
    {
        foreach ($registry->getMetrics() as $metric) {
            $this->optimizeMetric($metric);
        }
        
        // 强制垃圾回收
        if (gc_enabled()) {
            gc_collect_cycles();
        }
    }
    
    private function optimizeMetric(MetricInterface $metric): void
    {
        if ($metric instanceof Histogram || $metric instanceof Summary) {
            $this->optimizeTimeSeriesMetric($metric);
        }
    }
    
    private function optimizeTimeSeriesMetric($metric): void
    {
        $now = time();
        $cutoff = $now - $this->retentionPeriod;
        
        // 清理过期样本
        $metric->clearSamplesBefore($cutoff);
        
        // 限制样本数量
        if ($metric->getSampleCount() > $this->maxSamples) {
            $metric->limitSamples($this->maxSamples);
        }
    }
}
```

## 监控和告警

### 指标健康检查

```php
use Hi\Metric\HealthCheck\MetricsHealthCheck;

class MetricsHealthCheck
{
    public function check(): array
    {
        $registry = app(MetricRegistry::class);
        
        return [
            'metrics_count' => $registry->getMetricCount(),
            'memory_usage' => $this->getMemoryUsage(),
            'exporters' => $this->checkExporters(),
            'collectors' => $this->checkCollectors(),
        ];
    }
    
    private function getMemoryUsage(): array
    {
        return [
            'current' => memory_get_usage(true),
            'peak' => memory_get_peak_usage(true),
            'limit' => ini_get('memory_limit'),
        ];
    }
    
    private function checkExporters(): array
    {
        $exporters = [];
        
        // 检查 Prometheus 导出器
        try {
            $prometheus = app(PrometheusExporter::class);
            $exporters['prometheus'] = 'healthy';
        } catch (\Exception $e) {
            $exporters['prometheus'] = 'error: ' . $e->getMessage();
        }
        
        // 检查 StatsD 导出器
        try {
            $statsd = app(StatsDExporter::class);
            $exporters['statsd'] = 'healthy';
        } catch (\Exception $e) {
            $exporters['statsd'] = 'error: ' . $e->getMessage();
        }
        
        return $exporters;
    }
}
```

### 指标阈值监控

```php
class MetricThresholdMonitor
{
    private array $thresholds = [];
    
    public function addThreshold(string $metricName, array $conditions, callable $callback): void
    {
        $this->thresholds[$metricName] = [
            'conditions' => $conditions,
            'callback' => $callback,
        ];
    }
    
    public function checkThresholds(MetricRegistry $registry): void
    {
        foreach ($this->thresholds as $metricName => $threshold) {
            $metric = $registry->getMetric($metricName);
            
            if ($metric && $this->evaluateConditions($metric, $threshold['conditions'])) {
                call_user_func($threshold['callback'], $metric);
            }
        }
    }
    
    private function evaluateConditions(MetricInterface $metric, array $conditions): bool
    {
        $value = $metric->getValue();
        
        foreach ($conditions as $operator => $threshold) {
            switch ($operator) {
                case 'gt':
                    if ($value <= $threshold) return false;
                    break;
                case 'lt':
                    if ($value >= $threshold) return false;
                    break;
                case 'eq':
                    if ($value != $threshold) return false;
                    break;
                case 'gte':
                    if ($value < $threshold) return false;
                    break;
                case 'lte':
                    if ($value > $threshold) return false;
                    break;
            }
        }
        
        return true;
    }
}

// 使用示例
$monitor = new MetricThresholdMonitor();

// 高错误率告警
$monitor->addThreshold('http_errors_total', ['gt' => 100], function($metric) {
    // 发送告警
    $this->alertManager->sendAlert('High error rate detected', [
        'metric' => $metric->getName(),
        'value' => $metric->getValue(),
    ]);
});

// 内存使用告警
$monitor->addThreshold('process_memory_usage_bytes', ['gt' => 1024*1024*512], function($metric) {
    // 内存使用超过 512MB
    $this->logger->warning('High memory usage', ['memory' => $metric->getValue()]);
});
```

## 注意事项和最佳实践

### 性能考虑

1. **标签限制**: 避免使用高基数标签，防止指标爆炸
2. **批量处理**: 使用批量处理减少网络和 I/O 开销
3. **内存管理**: 定期清理过期指标数据
4. **采样策略**: 对高频指标进行合理采样

### 指标设计

1. **命名规范**: 使用一致的命名约定
2. **标签选择**: 选择有意义且有限的标签维度
3. **指标类型**: 根据数据特性选择合适的指标类型
4. **聚合友好**: 设计易于聚合和分析的指标

### 监控策略

1. **分层监控**: 区分系统、应用和业务指标
2. **关键指标**: 重点监控核心业务指标
3. **阈值设置**: 根据历史数据设置合理阈值
4. **告警降噪**: 避免告警风暴和疲劳

```php
// 最佳实践示例
class OptimizedMetrics
{
    private MetricRegistry $registry;
    private array $rateLimiters = [];
    
    public function recordWithRateLimit(string $metricName, $value, array $labels = [], int $maxPerSecond = 1000): void
    {
        $key = $metricName . ':' . md5(json_encode($labels));
        
        if (!isset($this->rateLimiters[$key])) {
            $this->rateLimiters[$key] = ['count' => 0, 'window' => time()];
        }
        
        $limiter = &$this->rateLimiters[$key];
        $currentWindow = time();
        
        // 重置窗口
        if ($currentWindow > $limiter['window']) {
            $limiter['count'] = 0;
            $limiter['window'] = $currentWindow;
        }
        
        // 检查速率限制
        if ($limiter['count'] < $maxPerSecond) {
            $metric = $this->registry->getOrCreateMetric($metricName);
            $metric->record($value, $labels);
            $limiter['count']++;
        }
    }
    
    public function recordBusinessMetric(string $operation, $value, array $context = []): void
    {
        // 标准化标签
        $labels = [
            'operation' => $operation,
            'environment' => config('app.env'),
            'service' => config('app.name'),
        ];
        
        // 添加有限的上下文标签
        foreach (['user_type', 'channel', 'region'] as $key) {
            if (isset($context[$key])) {
                $labels[$key] = $context[$key];
            }
        }
        
        $this->recordWithRateLimit('business_operations', $value, $labels);
    }
}
``` 