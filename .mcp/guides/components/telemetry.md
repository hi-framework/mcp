# Telemetry 遥测

Telemetry 组件提供全面的应用程序可观测性解决方案，支持链路追踪、指标收集、日志关联和性能监控，帮助开发者深入了解应用程序的运行状态和性能表现。

## 设计思路

### 核心特性

1. **分布式追踪**: 支持跨服务的请求链路追踪
2. **指标收集**: 实时收集和聚合应用程序指标
3. **结构化日志**: 与追踪信息关联的结构化日志记录
4. **性能监控**: 自动监控关键性能指标
5. **错误追踪**: 详细的错误和异常追踪
6. **自定义埋点**: 灵活的自定义监控点

### 架构组件

- **TracingManager**: 链路追踪管理器
- **SpanBuilder**: 跨度构建器，创建和管理追踪跨度
- **MetricsCollector**: 指标收集器
- **Logger**: 结构化日志记录器
- **Exporter**: 数据导出器，支持多种后端

## 基本配置

### Telemetry 配置文件

```php
// config/telemetry.php
return [
    'enabled' => env('TELEMETRY_ENABLED', true),
    'service_name' => env('SERVICE_NAME', 'typing-php-app'),
    'service_version' => env('SERVICE_VERSION', '1.0.0'),
    'environment' => env('APP_ENV', 'production'),
    
    // 链路追踪配置
    'tracing' => [
        'enabled' => env('TRACING_ENABLED', true),
        'sampler' => [
            'type' => 'probability', // always, never, probability
            'probability' => env('TRACING_SAMPLE_RATE', 0.1), // 10% 采样率
        ],
        'exporters' => [
            'jaeger' => [
                'enabled' => env('JAEGER_ENABLED', true),
                'endpoint' => env('JAEGER_ENDPOINT', 'http://localhost:14268/api/traces'),
                'agent_host' => env('JAEGER_AGENT_HOST', 'localhost'),
                'agent_port' => env('JAEGER_AGENT_PORT', 6832),
            ],
            'zipkin' => [
                'enabled' => env('ZIPKIN_ENABLED', false),
                'endpoint' => env('ZIPKIN_ENDPOINT', 'http://localhost:9411/api/v2/spans'),
            ],
            'console' => [
                'enabled' => env('TRACING_CONSOLE_DEBUG', false),
            ],
        ],
    ],
    
    // 指标配置
    'metrics' => [
        'enabled' => env('METRICS_ENABLED', true),
        'default_labels' => [
            'service' => env('SERVICE_NAME', 'typing-php-app'),
            'version' => env('SERVICE_VERSION', '1.0.0'),
            'environment' => env('APP_ENV', 'production'),
        ],
        'exporters' => [
            'prometheus' => [
                'enabled' => env('PROMETHEUS_ENABLED', true),
                'push_gateway' => env('PROMETHEUS_PUSH_GATEWAY', 'http://localhost:9091'),
                'job_name' => env('PROMETHEUS_JOB_NAME', 'typing-php-app'),
            ],
            'statsd' => [
                'enabled' => env('STATSD_ENABLED', false),
                'host' => env('STATSD_HOST', 'localhost'),
                'port' => env('STATSD_PORT', 8125),
                'prefix' => env('STATSD_PREFIX', 'app'),
            ],
        ],
    ],
    
    // 日志配置
    'logging' => [
        'enabled' => env('TELEMETRY_LOGGING_ENABLED', true),
        'correlation' => true, // 是否关联追踪信息
        'structured' => true,  // 是否使用结构化日志
        'exporters' => [
            'elasticsearch' => [
                'enabled' => env('ELASTICSEARCH_LOGGING_ENABLED', false),
                'hosts' => [env('ELASTICSEARCH_HOST', 'localhost:9200')],
                'index_prefix' => 'app-logs-',
            ],
            'file' => [
                'enabled' => true,
                'path' => env('LOG_FILE_PATH', '/var/log/app/telemetry.log'),
                'level' => env('LOG_LEVEL', 'info'),
            ],
        ],
    ],
    
    // 资源配置
    'resource' => [
        'service.name' => env('SERVICE_NAME', 'typing-php-app'),
        'service.version' => env('SERVICE_VERSION', '1.0.0'),
        'service.namespace' => env('SERVICE_NAMESPACE', 'default'),
        'deployment.environment' => env('APP_ENV', 'production'),
        'host.name' => gethostname(),
        'process.pid' => getmypid(),
    ],
];
```

## 基本使用

### 链路追踪

```php
use Hi\Telemetry\TracingManager;
use Hi\Telemetry\Span;

// 获取追踪管理器
$tracing = $telemetryManager->tracing();

// 创建根跨度
$span = $tracing->startSpan('http_request', [
    'http.method' => 'GET',
    'http.url' => '/api/users',
    'http.route' => '/api/users',
]);

try {
    // 业务逻辑
    $users = $this->userService->getUsers();
    
    // 添加事件
    $span->addEvent('users_loaded', [
        'user_count' => count($users),
    ]);
    
    // 设置标签
    $span->setTag('user.count', count($users));
    $span->setTag('response.size', strlen(json_encode($users)));
    
    return $users;
    
} catch (\Exception $e) {
    // 记录错误
    $span->recordException($e);
    $span->setStatus(Span::STATUS_ERROR, $e->getMessage());
    throw $e;
    
} finally {
    // 结束跨度
    $span->end();
}
```

### 子跨度追踪

```php
class UserService
{
    public function getUsers(): array
    {
        $tracing = app(TracingManager::class);
        
        // 创建子跨度
        $span = $tracing->startSpan('user_service.get_users');
        
        try {
            // 数据库查询跨度
            $dbSpan = $tracing->startSpan('db.query', [
                'db.system' => 'mysql',
                'db.statement' => 'SELECT * FROM users WHERE active = 1',
                'db.table' => 'users',
            ]);
            
            $users = $this->db->query('SELECT * FROM users WHERE active = 1')->fetchAll();
            
            $dbSpan->setTag('db.rows_affected', count($users));
            $dbSpan->end();
            
            // 缓存跨度
            $cacheSpan = $tracing->startSpan('cache.set', [
                'cache.key' => 'users:active',
                'cache.ttl' => 3600,
            ]);
            
            $this->cache->set('users:active', $users, 3600);
            $cacheSpan->end();
            
            return $users;
            
        } finally {
            $span->end();
        }
    }
}
```

### 指标收集

```php
use Hi\Telemetry\Metrics\MetricsCollector;
use Hi\Telemetry\Metrics\Counter;
use Hi\Telemetry\Metrics\Histogram;
use Hi\Telemetry\Metrics\Gauge;

// 获取指标收集器
$metrics = $telemetryManager->metrics();

// 计数器 - 请求总数
$requestCounter = $metrics->counter('http_requests_total', '处理的 HTTP 请求总数');
$requestCounter->increment(['method' => 'GET', 'endpoint' => '/api/users']);

// 直方图 - 请求耗时
$requestDuration = $metrics->histogram('http_request_duration_seconds', '请求处理时间', [
    'buckets' => [0.1, 0.5, 1.0, 2.5, 5.0, 10.0],
]);

$startTime = microtime(true);
// ... 处理请求
$duration = microtime(true) - $startTime;
$requestDuration->observe($duration, ['method' => 'GET', 'status' => '200']);

// 仪表盘 - 当前活跃连接数
$activeConnections = $metrics->gauge('active_connections', '当前活跃连接数');
$activeConnections->set(45);

// 业务指标
$orderTotal = $metrics->counter('orders_total', '订单总数');
$orderTotal->increment(['status' => 'completed']);

$orderValue = $metrics->histogram('order_value_dollars', '订单金额', [
    'buckets' => [10, 50, 100, 500, 1000, 5000],
]);
$orderValue->observe(299.99, ['category' => 'electronics']);
```

### 自动化监控

```php
use Hi\Telemetry\Middleware\TelemetryMiddleware;

// HTTP 中间件自动追踪
class TelemetryMiddleware
{
    public function handle($request, $next)
    {
        $tracing = app(TracingManager::class);
        $metrics = app(MetricsCollector::class);
        
        $startTime = microtime(true);
        
        // 开始 HTTP 请求跨度
        $span = $tracing->startSpan('http_request', [
            'http.method' => $request->getMethod(),
            'http.url' => (string) $request->getUri(),
            'http.user_agent' => $request->getHeaderLine('User-Agent'),
            'http.scheme' => $request->getUri()->getScheme(),
        ]);
        
        try {
            $response = $next($request);
            
            $duration = microtime(true) - $startTime;
            $statusCode = $response->getStatusCode();
            
            // 设置响应信息
            $span->setTag('http.status_code', $statusCode);
            $span->setTag('http.response.size', $response->getHeaderLine('Content-Length'));
            
            if ($statusCode >= 400) {
                $span->setStatus(Span::STATUS_ERROR);
            }
            
            // 记录指标
            $metrics->counter('http_requests_total')->increment([
                'method' => $request->getMethod(),
                'status' => (string) $statusCode,
            ]);
            
            $metrics->histogram('http_request_duration_seconds')->observe($duration, [
                'method' => $request->getMethod(),
                'status' => (string) $statusCode,
            ]);
            
            return $response;
            
        } catch (\Exception $e) {
            $span->recordException($e);
            $span->setStatus(Span::STATUS_ERROR, $e->getMessage());
            
            // 错误指标
            $metrics->counter('http_errors_total')->increment([
                'method' => $request->getMethod(),
                'error_type' => get_class($e),
            ]);
            
            throw $e;
            
        } finally {
            $span->end();
        }
    }
}
```

## 高级功能

### 自定义采样器

```php
use Hi\Telemetry\Sampling\SamplerInterface;

class CustomSampler implements SamplerInterface
{
    public function shouldSample(
        string $traceId,
        string $spanName,
        array $attributes = []
    ): bool {
        // 错误请求始终采样
        if (isset($attributes['http.status_code']) && $attributes['http.status_code'] >= 400) {
            return true;
        }
        
        // 慢请求始终采样
        if (isset($attributes['duration']) && $attributes['duration'] > 1.0) {
            return true;
        }
        
        // 重要端点高采样率
        $importantEndpoints = ['/api/orders', '/api/payments'];
        if (isset($attributes['http.route']) && in_array($attributes['http.route'], $importantEndpoints)) {
            return random_int(1, 100) <= 50; // 50% 采样率
        }
        
        // 其他请求低采样率
        return random_int(1, 100) <= 10; // 10% 采样率
    }
}
```

### 分布式上下文传播

```php
use Hi\Telemetry\Context\ContextPropagator;

class HttpClientDecorator
{
    public function __construct(
        private HttpClientInterface $client,
        private ContextPropagator $propagator
    ) {}
    
    public function request(string $method, string $uri, array $options = []): ResponseInterface
    {
        $tracing = app(TracingManager::class);
        
        // 创建客户端请求跨度
        $span = $tracing->startSpan('http_client_request', [
            'http.method' => $method,
            'http.url' => $uri,
            'span.kind' => 'client',
        ]);
        
        // 将追踪上下文注入到请求头
        $headers = $options['headers'] ?? [];
        $this->propagator->inject($headers);
        $options['headers'] = $headers;
        
        try {
            $response = $this->client->request($method, $uri, $options);
            
            $span->setTag('http.status_code', $response->getStatusCode());
            
            return $response;
            
        } catch (\Exception $e) {
            $span->recordException($e);
            $span->setStatus(Span::STATUS_ERROR);
            throw $e;
            
        } finally {
            $span->end();
        }
    }
}
```

### 业务事件追踪

```php
use Hi\Telemetry\BusinessTracing;

class OrderService
{
    public function createOrder(array $orderData): Order
    {
        $businessTracing = app(BusinessTracing::class);
        
        // 开始业务流程跨度
        $orderSpan = $businessTracing->startBusinessSpan('order.create', [
            'order.customer_id' => $orderData['customer_id'],
            'order.total_amount' => $orderData['total_amount'],
            'order.item_count' => count($orderData['items']),
        ]);
        
        try {
            // 验证订单
            $validationSpan = $businessTracing->startSpan('order.validate');
            $this->validateOrder($orderData);
            $validationSpan->addEvent('validation_completed');
            $validationSpan->end();
            
            // 计算价格
            $pricingSpan = $businessTracing->startSpan('order.calculate_pricing');
            $totalAmount = $this->calculateTotalAmount($orderData['items']);
            $pricingSpan->setTag('calculated_amount', $totalAmount);
            $pricingSpan->end();
            
            // 创建订单
            $createSpan = $businessTracing->startSpan('order.persist');
            $order = $this->persistOrder($orderData);
            $createSpan->setTag('order.id', $order->getId());
            $createSpan->end();
            
            // 发送确认
            $notificationSpan = $businessTracing->startSpan('order.send_confirmation');
            $this->sendOrderConfirmation($order);
            $notificationSpan->end();
            
            // 业务指标
            $businessTracing->recordBusinessMetric('order.created', [
                'customer_type' => $this->getCustomerType($orderData['customer_id']),
                'order_value_range' => $this->getValueRange($totalAmount),
            ]);
            
            return $order;
            
        } finally {
            $orderSpan->end();
        }
    }
}
```

### 性能基准测试

```php
use Hi\Telemetry\Profiling\Profiler;

class PerformanceProfiler
{
    public function profileFunction(callable $function, string $name, array $tags = [])
    {
        $profiler = app(Profiler::class);
        
        $profile = $profiler->startProfiling($name, $tags);
        
        try {
            $result = $function();
            
            $profile->addTag('execution.status', 'success');
            
            return $result;
            
        } catch (\Exception $e) {
            $profile->addTag('execution.status', 'error');
            $profile->addTag('error.type', get_class($e));
            throw $e;
            
        } finally {
            $profile->end();
        }
    }
    
    public function profileDatabaseQuery(callable $query, string $sql): mixed
    {
        return $this->profileFunction($query, 'db.query', [
            'db.statement' => $sql,
            'db.system' => 'mysql',
        ]);
    }
    
    public function profileCacheOperation(callable $operation, string $key, string $op): mixed
    {
        return $this->profileFunction($operation, 'cache.' . $op, [
            'cache.key' => $key,
            'cache.operation' => $op,
        ]);
    }
}
```

## 错误和异常追踪

### 异常自动追踪

```php
use Hi\Telemetry\ExceptionTracker;

class TelemetryExceptionHandler
{
    public function __construct(
        private ExceptionTracker $tracker
    ) {}
    
    public function handle(\Throwable $throwable): void
    {
        // 记录异常到追踪系统
        $this->tracker->recordException($throwable, [
            'error.type' => get_class($throwable),
            'error.message' => $throwable->getMessage(),
            'error.file' => $throwable->getFile(),
            'error.line' => $throwable->getLine(),
            'error.stack_trace' => $throwable->getTraceAsString(),
        ]);
        
        // 记录错误指标
        $metrics = app(MetricsCollector::class);
        $metrics->counter('application_errors_total')->increment([
            'error_type' => get_class($throwable),
            'error_severity' => $this->getErrorSeverity($throwable),
        ]);
        
        // 如果有活跃的跨度，记录异常信息
        $span = $this->tracker->getActiveSpan();
        if ($span) {
            $span->recordException($throwable);
            $span->setStatus(Span::STATUS_ERROR, $throwable->getMessage());
        }
    }
    
    private function getErrorSeverity(\Throwable $throwable): string
    {
        if ($throwable instanceof \Error) {
            return 'fatal';
        }
        
        if ($throwable instanceof \RuntimeException) {
            return 'error';
        }
        
        return 'warning';
    }
}
```

### 业务错误追踪

```php
class BusinessErrorTracker
{
    public function trackValidationError(array $errors, array $context = []): void
    {
        $span = app(TracingManager::class)->getActiveSpan();
        
        if ($span) {
            $span->addEvent('validation_error', [
                'error.count' => count($errors),
                'error.fields' => array_keys($errors),
            ]);
            
            $span->setTag('validation.failed', true);
        }
        
        // 记录业务错误指标
        app(MetricsCollector::class)
            ->counter('business_validation_errors_total')
            ->increment(['error_type' => 'validation']);
    }
    
    public function trackBusinessRuleViolation(string $rule, array $context = []): void
    {
        $span = app(TracingManager::class)->getActiveSpan();
        
        if ($span) {
            $span->addEvent('business_rule_violation', [
                'rule.name' => $rule,
                'rule.context' => $context,
            ]);
        }
        
        app(MetricsCollector::class)
            ->counter('business_rule_violations_total')
            ->increment(['rule' => $rule]);
    }
}
```

## 监控和告警

### 健康检查集成

```php
use Hi\Telemetry\HealthCheck\TelemetryHealthCheck;

class ApplicationHealthCheck
{
    public function check(): array
    {
        $telemetryHealth = app(TelemetryHealthCheck::class);
        
        return [
            'tracing' => $telemetryHealth->checkTracing(),
            'metrics' => $telemetryHealth->checkMetrics(),
            'exporters' => $telemetryHealth->checkExporters(),
        ];
    }
}

class TelemetryHealthCheck
{
    public function checkTracing(): array
    {
        try {
            $tracing = app(TracingManager::class);
            $testSpan = $tracing->startSpan('health_check');
            $testSpan->end();
            
            return ['status' => 'healthy', 'last_check' => time()];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'error' => $e->getMessage()];
        }
    }
    
    public function checkMetrics(): array
    {
        try {
            $metrics = app(MetricsCollector::class);
            $testCounter = $metrics->counter('health_check_test');
            $testCounter->increment();
            
            return ['status' => 'healthy', 'last_check' => time()];
        } catch (\Exception $e) {
            return ['status' => 'unhealthy', 'error' => $e->getMessage()];
        }
    }
}
```

### 自动告警

```php
use Hi\Telemetry\Alerting\AlertManager;

class TelemetryAlerting
{
    public function setupAlerts(): void
    {
        $alertManager = app(AlertManager::class);
        
        // 错误率告警
        $alertManager->addRule([
            'name' => 'high_error_rate',
            'metric' => 'http_requests_total',
            'condition' => [
                'error_rate' => '> 0.05', // 错误率超过 5%
                'duration' => '5m',       // 持续 5 分钟
            ],
            'actions' => [
                'webhook' => 'https://alerts.example.com/webhook',
                'email' => 'dev-team@example.com',
            ],
        ]);
        
        // 响应时间告警
        $alertManager->addRule([
            'name' => 'slow_response_time',
            'metric' => 'http_request_duration_seconds',
            'condition' => [
                'p95' => '> 2.0',         // P95 响应时间超过 2 秒
                'duration' => '3m',
            ],
            'actions' => [
                'slack' => '#dev-alerts',
            ],
        ]);
        
        // 业务指标告警
        $alertManager->addRule([
            'name' => 'order_failure_spike',
            'metric' => 'orders_total',
            'condition' => [
                'failure_rate' => '> 0.1', // 订单失败率超过 10%
                'duration' => '2m',
            ],
            'actions' => [
                'pagerduty' => 'service-key-123',
            ],
        ]);
    }
}
```

## 数据导出和可视化

### 自定义导出器

```php
use Hi\Telemetry\Exporters\ExporterInterface;

class CustomMetricsExporter implements ExporterInterface
{
    public function export(array $metrics): bool
    {
        try {
            foreach ($metrics as $metric) {
                $this->sendToCustomBackend([
                    'name' => $metric->getName(),
                    'value' => $metric->getValue(),
                    'labels' => $metric->getLabels(),
                    'timestamp' => $metric->getTimestamp(),
                ]);
            }
            
            return true;
        } catch (\Exception $e) {
            $this->logger->error('Failed to export metrics', ['error' => $e->getMessage()]);
            return false;
        }
    }
    
    private function sendToCustomBackend(array $data): void
    {
        // 发送到自定义后端
        $this->httpClient->post('https://metrics-api.example.com/metrics', [
            'json' => $data,
        ]);
    }
}
```

### 仪表板集成

```php
class DashboardDataProvider
{
    public function getApplicationMetrics(): array
    {
        $metrics = app(MetricsCollector::class);
        
        return [
            'request_rate' => $this->getRequestRate(),
            'error_rate' => $this->getErrorRate(),
            'response_time' => $this->getResponseTimePercentiles(),
            'business_kpis' => $this->getBusinessKPIs(),
        ];
    }
    
    private function getRequestRate(): array
    {
        // 获取最近 1 小时的请求速率
        return $this->queryMetrics('rate(http_requests_total[1h])');
    }
    
    private function getErrorRate(): array
    {
        // 计算错误率
        return $this->queryMetrics('
            rate(http_requests_total{status=~"4..|5.."}[5m]) /
            rate(http_requests_total[5m])
        ');
    }
    
    private function getResponseTimePercentiles(): array
    {
        // 获取响应时间分位数
        return [
            'p50' => $this->queryMetrics('histogram_quantile(0.5, http_request_duration_seconds)'),
            'p95' => $this->queryMetrics('histogram_quantile(0.95, http_request_duration_seconds)'),
            'p99' => $this->queryMetrics('histogram_quantile(0.99, http_request_duration_seconds)'),
        ];
    }
}
```

## 注意事项和最佳实践

### 性能考虑

1. **采样策略**: 合理设置采样率，避免过度追踪影响性能
2. **异步导出**: 使用异步方式导出遥测数据，减少对主流程的影响
3. **缓冲机制**: 实施数据缓冲，批量发送遥测数据
4. **资源限制**: 设置合理的内存和 CPU 使用限制

### 数据管理

1. **数据保留**: 设置合适的数据保留期，避免存储空间过度消耗
2. **隐私保护**: 避免在遥测数据中包含敏感信息
3. **数据压缩**: 使用压缩减少网络传输和存储成本
4. **去重机制**: 实施数据去重，避免重复数据

### 监控策略

1. **分层监控**: 区分基础设施、应用程序和业务层面的监控
2. **关键路径**: 重点监控关键业务流程和用户路径
3. **阈值设置**: 根据历史数据和业务需求设置合理的告警阈值
4. **告警降噪**: 实施智能告警策略，减少误报和告警疲劳

```php
// 最佳实践示例
class OptimizedTelemetry
{
    public function trackCriticalOperation(callable $operation, string $operationName): mixed
    {
        $startTime = microtime(true);
        $tracing = app(TracingManager::class);
        $metrics = app(MetricsCollector::class);
        
        // 只对关键操作进行详细追踪
        $shouldTrace = $this->shouldTraceOperation($operationName);
        
        $span = $shouldTrace ? $tracing->startSpan($operationName) : null;
        
        try {
            $result = $operation();
            
            $duration = microtime(true) - $startTime;
            
            // 始终记录基本指标
            $metrics->histogram('operation_duration_seconds')
                ->observe($duration, ['operation' => $operationName]);
            
            if ($span) {
                $span->setTag('operation.duration', $duration);
            }
            
            return $result;
            
        } catch (\Exception $e) {
            $metrics->counter('operation_errors_total')
                ->increment(['operation' => $operationName, 'error_type' => get_class($e)]);
            
            if ($span) {
                $span->recordException($e);
            }
            
            throw $e;
            
        } finally {
            if ($span) {
                $span->end();
            }
        }
    }
    
    private function shouldTraceOperation(string $operationName): bool
    {
        // 关键操作始终追踪
        $criticalOperations = ['order.payment', 'user.authentication', 'data.backup'];
        
        if (in_array($operationName, $criticalOperations)) {
            return true;
        }
        
        // 其他操作根据采样率决定
        return random_int(1, 100) <= 10; // 10% 采样率
    }
}
``` 