# Kafka 消息队列

Hi Framework 提供了完整的 Kafka 消息队列集成，支持生产者、消费者、事务处理、分区管理等高级功能。Kafka 组件设计为高性能、高可用，支持大规模消息处理。

## 基本概念

Kafka 核心概念：

- **Topic** - 消息主题，消息的分类
- **Partition** - 分区，Topic 的物理分割
- **Producer** - 生产者，发送消息的客户端
- **Consumer** - 消费者，接收消息的客户端
- **Consumer Group** - 消费者组，负载均衡消费

## 配置

### 基本配置

```yaml
# application.yaml
kafka:
  default:
    brokers: 'localhost:9092'
    security_protocol: 'PLAINTEXT'
    sasl_mechanism: 'PLAIN'
    sasl_username: ''
    sasl_password: ''
    
    producer:
      acks: 'all'
      retries: 3
      batch_size: 16384
      linger_ms: 1
      buffer_memory: 33554432
      compression_type: 'lz4'
    
    consumer:
      group_id: 'hi-framework'
      auto_offset_reset: 'earliest'
      enable_auto_commit: true
      auto_commit_interval_ms: 1000
      session_timeout_ms: 30000
      max_poll_records: 500
  
  cluster:
    brokers: 
      - 'kafka1.example.com:9092'
      - 'kafka2.example.com:9092'
      - 'kafka3.example.com:9092'
    security_protocol: 'SASL_SSL'
    ssl_ca_location: '/path/to/ca-cert'
    ssl_certificate_location: '/path/to/client-cert'
    ssl_key_location: '/path/to/client-key'
```

### 高级配置

```php
<?php

// config/kafka.php - 生产环境配置
return [
    'production' => [
        'brokers' => [
            'kafka-prod-1.internal:9092',
            'kafka-prod-2.internal:9092',
            'kafka-prod-3.internal:9092',
        ],
        
        'producer' => [
            'acks' => 'all',
            'retries' => 10,
            'retry_backoff_ms' => 100,
            'batch_size' => 32768,
            'linger_ms' => 5,
            'buffer_memory' => 67108864, // 64MB
            'compression_type' => 'snappy',
            'max_in_flight_requests_per_connection' => 1,
            'enable_idempotence' => true,
        ],
        
        'consumer' => [
            'group_id' => 'hi-framework-prod',
            'auto_offset_reset' => 'earliest',
            'enable_auto_commit' => false, // 手动提交
            'fetch_min_bytes' => 1024,
            'fetch_max_wait_ms' => 500,
            'max_partition_fetch_bytes' => 1048576, // 1MB
            'isolation_level' => 'read_committed',
        ],
        
        'admin' => [
            'request_timeout_ms' => 30000,
            'default_topic_config' => [
                'num_partitions' => 12,
                'replication_factor' => 3,
                'min_insync_replicas' => 2,
                'cleanup_policy' => 'delete',
                'retention_ms' => 604800000, // 7天
            ],
        ],
    ],
];
```

## 生产者

### 基本生产者

```php
<?php

namespace Hi\Kafka;

use Hi\Kafka\Producer\KafkaProducer;

class MessageProducer
{
    private KafkaProducer $producer;
    
    public function __construct(KafkaProducer $producer)
    {
        $this->producer = $producer;
    }
    
    public function sendMessage(string $topic, $message, ?string $key = null): void
    {
        $this->producer->send($topic, [
            'key' => $key,
            'value' => json_encode($message),
            'headers' => [
                'Content-Type' => 'application/json',
                'Timestamp' => (string) time(),
            ],
        ]);
    }
    
    public function sendBatch(string $topic, array $messages): void
    {
        $batch = [];
        
        foreach ($messages as $message) {
            $batch[] = [
                'key' => $message['key'] ?? null,
                'value' => json_encode($message['data']),
                'headers' => $message['headers'] ?? [],
            ];
        }
        
        $this->producer->sendBatch($topic, $batch);
    }
}
```

### 事务生产者

```php
<?php

class TransactionalProducer
{
    private KafkaProducer $producer;
    
    public function __construct(KafkaProducer $producer)
    {
        $this->producer = $producer;
    }
    
    public function sendTransactional(array $operations): void
    {
        $this->producer->beginTransaction();
        
        try {
            foreach ($operations as $operation) {
                $this->producer->send(
                    $operation['topic'],
                    $operation['message']
                );
            }
            
            $this->producer->commitTransaction();
        } catch (\Exception $e) {
            $this->producer->abortTransaction();
            throw $e;
        }
    }
    
    public function transferMessage(string $fromTopic, string $toTopic, $message): void
    {
        $this->producer->beginTransaction();
        
        try {
            // 发送到新 topic
            $this->producer->send($toTopic, [
                'value' => json_encode($message),
                'headers' => ['transfer_from' => $fromTopic],
            ]);
            
            // 标记原消息为已处理（这里需要配合消费者确认）
            $this->producer->commitTransaction();
        } catch (\Exception $e) {
            $this->producer->abortTransaction();
            throw $e;
        }
    }
}
```

### 异步生产者

```php
<?php

class AsyncProducer
{
    private KafkaProducer $producer;
    private array $callbacks = [];
    
    public function sendAsync(string $topic, $message, ?callable $callback = null): void
    {
        $messageId = uniqid();
        
        if ($callback) {
            $this->callbacks[$messageId] = $callback;
        }
        
        $this->producer->sendAsync($topic, [
            'value' => json_encode($message),
            'headers' => ['message_id' => $messageId],
        ], function ($error, $result) use ($messageId) {
            $this->handleDeliveryReport($messageId, $error, $result);
        });
    }
    
    public function flush(int $timeoutMs = 10000): void
    {
        $this->producer->flush($timeoutMs);
    }
    
    private function handleDeliveryReport(string $messageId, $error, $result): void
    {
        if (isset($this->callbacks[$messageId])) {
            $callback = $this->callbacks[$messageId];
            unset($this->callbacks[$messageId]);
            
            $callback($error, $result);
        }
        
        if ($error) {
            logger()->error('Kafka message delivery failed', [
                'message_id' => $messageId,
                'error' => $error,
            ]);
        } else {
            logger()->debug('Kafka message delivered', [
                'message_id' => $messageId,
                'topic' => $result['topic'],
                'partition' => $result['partition'],
                'offset' => $result['offset'],
            ]);
        }
    }
}
```

## 消费者

### 基本消费者

```php
<?php

namespace Hi\Kafka\Consumer;

use Hi\Kafka\Consumer\KafkaConsumer;

class MessageConsumer
{
    private KafkaConsumer $consumer;
    private array $handlers = [];
    
    public function __construct(KafkaConsumer $consumer)
    {
        $this->consumer = $consumer;
    }
    
    public function subscribe(array $topics): void
    {
        $this->consumer->subscribe($topics);
    }
    
    public function registerHandler(string $topic, callable $handler): void
    {
        $this->handlers[$topic] = $handler;
    }
    
    public function consume(int $timeoutMs = 1000): void
    {
        while (true) {
            $message = $this->consumer->consume($timeoutMs);
            
            if ($message === null) {
                continue;
            }
            
            if ($message->err !== RD_KAFKA_RESP_ERR_NO_ERROR) {
                $this->handleError($message);
                continue;
            }
            
            $this->processMessage($message);
        }
    }
    
    private function processMessage($message): void
    {
        $topic = $message->topic_name;
        
        if (!isset($this->handlers[$topic])) {
            logger()->warning('No handler for topic', ['topic' => $topic]);
            return;
        }
        
        try {
            $handler = $this->handlers[$topic];
            $data = json_decode($message->payload, true);
            
            $result = $handler($data, $message);
            
            if ($result !== false) {
                $this->consumer->commit($message);
            }
        } catch (\Exception $e) {
            logger()->error('Message processing failed', [
                'topic' => $topic,
                'partition' => $message->partition,
                'offset' => $message->offset,
                'error' => $e->getMessage(),
            ]);
            
            $this->handleProcessingError($message, $e);
        }
    }
    
    private function handleError($message): void
    {
        switch ($message->err) {
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                logger()->debug('Reached end of partition');
                break;
                
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                logger()->debug('Consumer timeout');
                break;
                
            default:
                logger()->error('Kafka consumer error', [
                    'error_code' => $message->err,
                    'error_message' => rd_kafka_err2str($message->err),
                ]);
                break;
        }
    }
    
    private function handleProcessingError($message, \Exception $e): void
    {
        // 错误重试逻辑
        $retryCount = $message->headers['retry_count'] ?? 0;
        $maxRetries = 3;
        
        if ($retryCount < $maxRetries) {
            $this->retryMessage($message, $retryCount + 1);
        } else {
            $this->sendToDeadLetterQueue($message, $e);
        }
    }
}
```

### 并发消费者

```php
<?php

class ConcurrentConsumer
{
    private array $consumers = [];
    private int $workerCount;
    
    public function __construct(array $config, int $workerCount = 4)
    {
        $this->workerCount = $workerCount;
        
        for ($i = 0; $i < $workerCount; $i++) {
            $this->consumers[$i] = new KafkaConsumer($config);
        }
    }
    
    public function start(array $topics, callable $handler): void
    {
        $processes = [];
        
        for ($i = 0; $i < $this->workerCount; $i++) {
            $processes[$i] = AppRuntime::corotine()->create(function () use ($i, $topics, $handler) {
                $consumer = $this->consumers[$i];
                $consumer->subscribe($topics);
                
                while (true) {
                    $message = $consumer->consume(1000);
                    
                    if ($message && $message->err === RD_KAFKA_RESP_ERR_NO_ERROR) {
                        try {
                            $data = json_decode($message->payload, true);
                            $result = $handler($data, $message);
                            
                            if ($result !== false) {
                                $consumer->commit($message);
                            }
                        } catch (\Exception $e) {
                            logger()->error('Worker message processing failed', [
                                'worker_id' => $i,
                                'topic' => $message->topic_name,
                                'error' => $e->getMessage(),
                            ]);
                        }
                    }
                }
            });
        }
        
        // 等待所有协程完成
        foreach ($processes as $process) {
            $process->wait();
        }
    }
}
```

### 消费者组管理

```php
<?php

class ConsumerGroupManager
{
    private KafkaConsumer $consumer;
    private string $groupId;
    
    public function __construct(KafkaConsumer $consumer, string $groupId)
    {
        $this->consumer = $consumer;
        $this->groupId = $groupId;
    }
    
    public function getGroupMetadata(): array
    {
        $metadata = $this->consumer->getMetadata(true, null, 5000);
        
        $groups = [];
        foreach ($metadata->getBrokers() as $broker) {
            // 获取消费者组信息
            $groupInfo = $this->consumer->getConsumerGroupMetadata($this->groupId);
            $groups[] = [
                'group_id' => $this->groupId,
                'broker' => $broker->getHost() . ':' . $broker->getPort(),
                'members' => $this->getGroupMembers(),
            ];
        }
        
        return $groups;
    }
    
    public function getGroupMembers(): array
    {
        // 实现获取消费者组成员的逻辑
        return [];
    }
    
    public function rebalance(): void
    {
        // 触发消费者组重平衡
        $this->consumer->close();
        
        // 重新创建消费者
        $config = $this->consumer->getConfig();
        $this->consumer = new KafkaConsumer($config);
    }
    
    public function getOffsets(array $topicPartitions): array
    {
        return $this->consumer->getCommittedOffsets($topicPartitions, 5000);
    }
    
    public function resetOffsets(array $topicPartitions, int $offset): void
    {
        foreach ($topicPartitions as $topicPartition) {
            $topicPartition->setOffset($offset);
        }
        
        $this->consumer->commitAsync($topicPartitions);
    }
}
```

## 主题管理

### 主题管理器

```php
<?php

class TopicManager
{
    private KafkaAdmin $admin;
    
    public function __construct(KafkaAdmin $admin)
    {
        $this->admin = $admin;
    }
    
    public function createTopic(string $topicName, array $config = []): void
    {
        $defaultConfig = [
            'num_partitions' => 3,
            'replication_factor' => 2,
            'configs' => [
                'cleanup.policy' => 'delete',
                'retention.ms' => '604800000', // 7天
                'compression.type' => 'lz4',
            ],
        ];
        
        $config = array_merge($defaultConfig, $config);
        
        $topic = $this->admin->newTopic($topicName)
            ->setNumPartitions($config['num_partitions'])
            ->setReplicationFactor($config['replication_factor']);
        
        foreach ($config['configs'] as $key => $value) {
            $topic->setConfig($key, $value);
        }
        
        $result = $this->admin->createTopics([$topic], ['request_timeout_ms' => 30000]);
        
        foreach ($result as $topicResult) {
            if ($topicResult->error !== RD_KAFKA_RESP_ERR_NO_ERROR) {
                throw new \Exception("Failed to create topic: " . rd_kafka_err2str($topicResult->error));
            }
        }
    }
    
    public function deleteTopic(string $topicName): void
    {
        $result = $this->admin->deleteTopics([$topicName], ['request_timeout_ms' => 30000]);
        
        foreach ($result as $topicResult) {
            if ($topicResult->error !== RD_KAFKA_RESP_ERR_NO_ERROR) {
                throw new \Exception("Failed to delete topic: " . rd_kafka_err2str($topicResult->error));
            }
        }
    }
    
    public function listTopics(): array
    {
        $metadata = $this->admin->getMetadata(true, null, 5000);
        $topics = [];
        
        foreach ($metadata->getTopics() as $topic) {
            $topics[] = [
                'name' => $topic->getTopic(),
                'partitions' => count($topic->getPartitions()),
                'error' => $topic->getErr(),
            ];
        }
        
        return $topics;
    }
    
    public function getTopicConfig(string $topicName): array
    {
        $resource = $this->admin->newConfigResource(RD_KAFKA_RESOURCE_TOPIC, $topicName);
        $result = $this->admin->describeConfigs([$resource], ['request_timeout_ms' => 30000]);
        
        $configs = [];
        foreach ($result as $configResult) {
            if ($configResult->error === RD_KAFKA_RESP_ERR_NO_ERROR) {
                foreach ($configResult->configs as $config) {
                    $configs[$config['name']] = $config['value'];
                }
            }
        }
        
        return $configs;
    }
    
    public function updateTopicConfig(string $topicName, array $configs): void
    {
        $resource = $this->admin->newConfigResource(RD_KAFKA_RESOURCE_TOPIC, $topicName);
        
        foreach ($configs as $key => $value) {
            $resource->setConfig($key, $value);
        }
        
        $result = $this->admin->alterConfigs([$resource], ['request_timeout_ms' => 30000]);
        
        foreach ($result as $configResult) {
            if ($configResult->error !== RD_KAFKA_RESP_ERR_NO_ERROR) {
                throw new \Exception("Failed to update config: " . rd_kafka_err2str($configResult->error));
            }
        }
    }
}
```

## 消息模式

### 事件驱动架构

```php
<?php

class EventPublisher
{
    private KafkaProducer $producer;
    private string $topicPrefix;
    
    public function __construct(KafkaProducer $producer, string $topicPrefix = 'events.')
    {
        $this->producer = $producer;
        $this->topicPrefix = $topicPrefix;
    }
    
    public function publishEvent(string $eventType, array $eventData): void
    {
        $topic = $this->topicPrefix . $eventType;
        
        $event = [
            'event_id' => uniqid(),
            'event_type' => $eventType,
            'timestamp' => time(),
            'data' => $eventData,
            'version' => '1.0',
        ];
        
        $this->producer->send($topic, [
            'key' => $event['event_id'],
            'value' => json_encode($event),
            'headers' => [
                'Event-Type' => $eventType,
                'Event-Version' => '1.0',
                'Content-Type' => 'application/json',
            ],
        ]);
    }
    
    public function publishDomainEvent(string $aggregateId, string $eventType, array $eventData): void
    {
        $topic = $this->topicPrefix . 'domain.' . $eventType;
        
        $event = [
            'aggregate_id' => $aggregateId,
            'event_id' => uniqid(),
            'event_type' => $eventType,
            'sequence_number' => $this->getNextSequenceNumber($aggregateId),
            'timestamp' => time(),
            'data' => $eventData,
        ];
        
        $this->producer->send($topic, [
            'key' => $aggregateId,
            'value' => json_encode($event),
            'headers' => [
                'Aggregate-Id' => $aggregateId,
                'Event-Type' => $eventType,
            ],
        ]);
    }
    
    private function getNextSequenceNumber(string $aggregateId): int
    {
        // 实现获取聚合根下一个序列号的逻辑
        return time(); // 简化实现
    }
}
```

### 命令查询责任分离（CQRS）

```php
<?php

class CommandHandler
{
    private KafkaProducer $commandProducer;
    private KafkaProducer $eventProducer;
    
    public function __construct(KafkaProducer $commandProducer, KafkaProducer $eventProducer)
    {
        $this->commandProducer = $commandProducer;
        $this->eventProducer = $eventProducer;
    }
    
    public function sendCommand(string $commandType, array $commandData): void
    {
        $command = [
            'command_id' => uniqid(),
            'command_type' => $commandType,
            'timestamp' => time(),
            'data' => $commandData,
        ];
        
        $this->commandProducer->send('commands.' . $commandType, [
            'key' => $command['command_id'],
            'value' => json_encode($command),
        ]);
    }
    
    public function handleCommand(array $command): void
    {
        try {
            // 处理命令逻辑
            $result = $this->executeCommand($command);
            
            // 发布成功事件
            $this->publishCommandResult($command, $result, true);
        } catch (\Exception $e) {
            // 发布失败事件
            $this->publishCommandResult($command, ['error' => $e->getMessage()], false);
        }
    }
    
    private function executeCommand(array $command)
    {
        // 命令执行逻辑
        switch ($command['command_type']) {
            case 'create_user':
                return $this->createUser($command['data']);
            case 'update_user':
                return $this->updateUser($command['data']);
            default:
                throw new \Exception('Unknown command type: ' . $command['command_type']);
        }
    }
    
    private function publishCommandResult(array $command, $result, bool $success): void
    {
        $event = [
            'command_id' => $command['command_id'],
            'command_type' => $command['command_type'],
            'success' => $success,
            'result' => $result,
            'timestamp' => time(),
        ];
        
        $eventType = $success ? 'command_succeeded' : 'command_failed';
        
        $this->eventProducer->send('events.' . $eventType, [
            'key' => $command['command_id'],
            'value' => json_encode($event),
        ]);
    }
}
```

## 监控和运维

### 性能监控

```php
<?php

class KafkaMonitor
{
    private KafkaProducer $producer;
    private KafkaConsumer $consumer;
    
    public function getProducerMetrics(): array
    {
        // 获取生产者指标
        return [
            'messages_sent' => $this->producer->getMetric('messages_sent'),
            'bytes_sent' => $this->producer->getMetric('bytes_sent'),
            'send_rate' => $this->producer->getMetric('send_rate'),
            'batch_size_avg' => $this->producer->getMetric('batch_size_avg'),
            'request_latency_avg' => $this->producer->getMetric('request_latency_avg'),
            'buffer_available_bytes' => $this->producer->getMetric('buffer_available_bytes'),
        ];
    }
    
    public function getConsumerMetrics(): array
    {
        // 获取消费者指标
        return [
            'messages_consumed' => $this->consumer->getMetric('messages_consumed'),
            'bytes_consumed' => $this->consumer->getMetric('bytes_consumed'),
            'consume_rate' => $this->consumer->getMetric('consume_rate'),
            'fetch_latency_avg' => $this->consumer->getMetric('fetch_latency_avg'),
            'commit_rate' => $this->consumer->getMetric('commit_rate'),
        ];
    }
    
    public function getTopicMetrics(string $topicName): array
    {
        $metadata = $this->consumer->getMetadata(true, null, 5000);
        
        foreach ($metadata->getTopics() as $topic) {
            if ($topic->getTopic() === $topicName) {
                $partitions = [];
                
                foreach ($topic->getPartitions() as $partition) {
                    $partitions[] = [
                        'id' => $partition->getId(),
                        'leader' => $partition->getLeader(),
                        'replicas' => $partition->getReplicas(),
                        'isrs' => $partition->getIsrs(),
                    ];
                }
                
                return [
                    'topic' => $topicName,
                    'partitions' => $partitions,
                    'partition_count' => count($partitions),
                ];
            }
        }
        
        return [];
    }
    
    public function getConsumerLag(string $groupId, array $topics): array
    {
        $admin = new KafkaAdmin($this->getAdminConfig());
        
        $lags = [];
        foreach ($topics as $topic) {
            $partitions = $this->getTopicPartitions($topic);
            
            foreach ($partitions as $partition) {
                $highWaterMark = $this->getHighWaterMark($topic, $partition);
                $committedOffset = $this->getCommittedOffset($groupId, $topic, $partition);
                
                $lag = $highWaterMark - $committedOffset;
                
                $lags[] = [
                    'topic' => $topic,
                    'partition' => $partition,
                    'high_water_mark' => $highWaterMark,
                    'committed_offset' => $committedOffset,
                    'lag' => $lag,
                ];
            }
        }
        
        return $lags;
    }
}
```

### 健康检查

```php
<?php

class KafkaHealthCheck
{
    private array $config;
    
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    
    public function checkHealth(): array
    {
        $health = [
            'status' => 'healthy',
            'checks' => [],
            'timestamp' => time(),
        ];
        
        // 检查 Broker 连接
        $brokerCheck = $this->checkBrokerConnectivity();
        $health['checks']['broker_connectivity'] = $brokerCheck;
        
        // 检查生产者
        $producerCheck = $this->checkProducer();
        $health['checks']['producer'] = $producerCheck;
        
        // 检查消费者
        $consumerCheck = $this->checkConsumer();
        $health['checks']['consumer'] = $consumerCheck;
        
        // 综合评估
        $allHealthy = array_reduce($health['checks'], function ($carry, $check) {
            return $carry && $check['status'] === 'healthy';
        }, true);
        
        $health['status'] = $allHealthy ? 'healthy' : 'unhealthy';
        
        return $health;
    }
    
    private function checkBrokerConnectivity(): array
    {
        try {
            $producer = new KafkaProducer($this->config);
            $metadata = $producer->getMetadata(true, null, 5000);
            
            $brokers = [];
            foreach ($metadata->getBrokers() as $broker) {
                $brokers[] = $broker->getHost() . ':' . $broker->getPort();
            }
            
            return [
                'status' => 'healthy',
                'brokers' => $brokers,
                'broker_count' => count($brokers),
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'unhealthy',
                'error' => $e->getMessage(),
            ];
        }
    }
    
    private function checkProducer(): array
    {
        try {
            $producer = new KafkaProducer($this->config);
            
            $testTopic = 'health-check-' . uniqid();
            $testMessage = ['health_check' => true, 'timestamp' => time()];
            
            $startTime = microtime(true);
            $producer->send($testTopic, [
                'value' => json_encode($testMessage),
            ]);
            $producer->flush(5000);
            $duration = (microtime(true) - $startTime) * 1000;
            
            return [
                'status' => 'healthy',
                'send_duration_ms' => $duration,
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'unhealthy',
                'error' => $e->getMessage(),
            ];
        }
    }
    
    private function checkConsumer(): array
    {
        try {
            $consumer = new KafkaConsumer($this->config);
            $consumer->subscribe(['health-check-topic']);
            
            $startTime = microtime(true);
            $message = $consumer->consume(1000);
            $duration = (microtime(true) - $startTime) * 1000;
            
            return [
                'status' => 'healthy',
                'consume_duration_ms' => $duration,
                'message_received' => $message !== null,
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'unhealthy',
                'error' => $e->getMessage(),
            ];
        }
    }
}
```

## 错误处理和重试

### 错误处理策略

```php
<?php

class KafkaErrorHandler
{
    private KafkaProducer $deadLetterProducer;
    private array $retryConfig;
    
    public function __construct(KafkaProducer $deadLetterProducer, array $retryConfig = [])
    {
        $this->deadLetterProducer = $deadLetterProducer;
        $this->retryConfig = array_merge([
            'max_retries' => 3,
            'retry_delay_ms' => 1000,
            'backoff_multiplier' => 2,
            'max_delay_ms' => 30000,
        ], $retryConfig);
    }
    
    public function handleProcessingError($message, \Exception $exception): bool
    {
        $retryCount = $this->getRetryCount($message);
        
        if ($retryCount < $this->retryConfig['max_retries']) {
            return $this->scheduleRetry($message, $retryCount + 1);
        } else {
            return $this->sendToDeadLetterQueue($message, $exception);
        }
    }
    
    private function getRetryCount($message): int
    {
        return (int) ($message->headers['retry_count'] ?? 0);
    }
    
    private function scheduleRetry($message, int $retryCount): bool
    {
        $delay = min(
            $this->retryConfig['retry_delay_ms'] * pow($this->retryConfig['backoff_multiplier'], $retryCount - 1),
            $this->retryConfig['max_delay_ms']
        );
        
        $retryTopic = $message->topic_name . '.retry';
        
        $retryMessage = [
            'key' => $message->key,
            'value' => $message->payload,
            'headers' => array_merge($message->headers, [
                'retry_count' => (string) $retryCount,
                'original_topic' => $message->topic_name,
                'retry_at' => (string) (time() * 1000 + $delay),
            ]),
        ];
        
        try {
            $this->deadLetterProducer->send($retryTopic, $retryMessage);
            
            logger()->info('Message scheduled for retry', [
                'topic' => $message->topic_name,
                'partition' => $message->partition,
                'offset' => $message->offset,
                'retry_count' => $retryCount,
                'delay_ms' => $delay,
            ]);
            
            return true;
        } catch (\Exception $e) {
            logger()->error('Failed to schedule retry', [
                'error' => $e->getMessage(),
                'topic' => $message->topic_name,
            ]);
            
            return false;
        }
    }
    
    private function sendToDeadLetterQueue($message, \Exception $exception): bool
    {
        $dlqTopic = $message->topic_name . '.dlq';
        
        $dlqMessage = [
            'key' => $message->key,
            'value' => $message->payload,
            'headers' => array_merge($message->headers, [
                'error_message' => $exception->getMessage(),
                'error_class' => get_class($exception),
                'failed_at' => (string) time(),
                'original_topic' => $message->topic_name,
                'retry_count' => (string) $this->getRetryCount($message),
            ]),
        ];
        
        try {
            $this->deadLetterProducer->send($dlqTopic, $dlqMessage);
            
            logger()->error('Message sent to dead letter queue', [
                'topic' => $message->topic_name,
                'partition' => $message->partition,
                'offset' => $message->offset,
                'error' => $exception->getMessage(),
            ]);
            
            return true;
        } catch (\Exception $e) {
            logger()->critical('Failed to send to dead letter queue', [
                'error' => $e->getMessage(),
                'original_error' => $exception->getMessage(),
                'topic' => $message->topic_name,
            ]);
            
            return false;
        }
    }
}
```

## 最佳实践

### 1. 消息设计

```php
<?php

// 使用版本化的消息格式
class MessageV1
{
    public function toArray(): array
    {
        return [
            'version' => '1.0',
            'schema' => 'user_created',
            'data' => [
                'user_id' => $this->userId,
                'email' => $this->email,
                'created_at' => $this->createdAt,
            ],
        ];
    }
}

// 向后兼容的消息处理
class MessageProcessor
{
    public function process(array $message): void
    {
        $version = $message['version'] ?? '1.0';
        
        switch ($version) {
            case '1.0':
                $this->processV1($message);
                break;
            case '2.0':
                $this->processV2($message);
                break;
            default:
                throw new \Exception("Unsupported message version: {$version}");
        }
    }
}
```

### 2. 性能优化

```php
<?php

// 批量发送
class BatchProcessor
{
    private array $batch = [];
    private int $batchSize = 100;
    
    public function addMessage($message): void
    {
        $this->batch[] = $message;
        
        if (count($this->batch) >= $this->batchSize) {
            $this->flush();
        }
    }
    
    public function flush(): void
    {
        if (!empty($this->batch)) {
            $this->producer->sendBatch('batch_topic', $this->batch);
            $this->batch = [];
        }
    }
}

// 连接复用
class ConnectionPool
{
    private array $producers = [];
    private array $consumers = [];
    
    public function getProducer(): KafkaProducer
    {
        if (empty($this->producers)) {
            $this->producers[] = new KafkaProducer($this->config);
        }
        
        return array_pop($this->producers);
    }
    
    public function releaseProducer(KafkaProducer $producer): void
    {
        $this->producers[] = $producer;
    }
}
```

### 3. 错误处理

```php
<?php

// 幂等性处理
class IdempotentProcessor
{
    private array $processedMessages = [];
    
    public function process($message): void
    {
        $messageId = $message->headers['message_id'] ?? null;
        
        if (!$messageId) {
            throw new \Exception('Message ID is required for idempotent processing');
        }
        
        if (isset($this->processedMessages[$messageId])) {
            logger()->info('Duplicate message ignored', ['message_id' => $messageId]);
            return;
        }
        
        try {
            $this->doProcess($message);
            $this->processedMessages[$messageId] = true;
        } catch (\Exception $e) {
            logger()->error('Message processing failed', [
                'message_id' => $messageId,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }
}
```

## 总结

Kafka 消息队列的核心优势：

- **高吞吐量** - 支持大规模消息处理
- **持久化** - 消息可靠存储和重放
- **分布式** - 天然支持分布式架构
- **容错性** - 副本机制保证高可用
- **可扩展** - 水平扩展能力

通过合理使用 Kafka 组件，可以构建高性能、高可靠的消息驱动架构。 