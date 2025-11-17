# 什么是 Hi Framework

Hi Framework 是一个低学习成本、轻量化的现代化 PHP 框架。专注于类型安全、系统性能和开发体验。您可以借助项目骨架快速进行开发，也可以通过文档指导一步步利用组件搭配出适合自己的项目结构。

本文档将为您介绍框架的整体架构、设计原则和核心特性。

## 设计原则

### 类型安全优先

框架所有代码全面采用 PHP 8+ 的类型系统，鼓励业务使用中使用显式类型限制，提供编译期类型检查，减少运行时错误，见如下示例（HTTP 路由定义）：

```php
use Hi\Attributes\Http\Get;
use Hi\Attributes\Http\Route;
use Hi\Http\Context;
use Psr\Log\LoggerInterface;

#[Route(prefix: '/api/users')]
class User
{
    #[Get(pattern: '/info', desc: '获取用户信息')]
    public function info(Context $context, LoggerInterface $logger): string
    {
        $logger->info('query_string', $context->request->getQueryParams());

        return 'ok';
    }
}
```

### PSR 标准

完全遵循 PHP-FIG 制定的 PSR 标准，实现了以下标准：

- PSR-3: Logger Interface
- PSR-7: HTTP Message Interface
- PSR-11: Container Interface
- PSR-14: Event Dispatcher
- PSR-15: HTTP Server Request Handlers
- PSR-16: Simple Cache

### 云原生优先

Hi Framework 从设计之初就考虑了云原生环境的需求，提供了完整的云原生解决方案。基于注解自动生成 `Ingress`、`Deployment`、`CronJob` 等资源，降低 k8s 使用成本。

### 可观测性

- **结构化日志**: 统一的 JSON 格式日志输出，便于日志聚合分析
- **指标监控**: 内置各类服务运行 Prometheus 指标导出，提供应用全面的性能监控

## 核心特性

### 注解优先

框架采用注解驱动的开发模式，通过 PHP 8+ 的 Attribute 特性实现声明式编程，让代码更加简洁、可读和可维护。见如下示例(k8s ingress 生成命令)：

```php
<?php

namespace Demo\Console;

use Hi\Attributes\Console\Action;
use Hi\Attributes\Console\Command;
use Hi\Kernel\Console\InputInterface;
use Hi\Kernel\Console\OutputInterface;
use Hi\Kernel\ConsoleInterface;

#[Command('cron', desc: 'CronJob 任务管理')]
class CronJobGenerator
{
    #[Action('generate', desc: '生成用于 k8s 的 CronJob 定时任务 YAML')]
    public function generate(ConsoleInterface $console, InputInterface $input, OutputInterface $output): void
    {
        if (\isStaging() || (\isLocal() && true !== $input->getOption('f'))) {
            $output->writeln(AppEnv . ' 环境不生成 CronJob YAML');
            return;
        }

        // Daemon Deployment 模板文件
        $cronjobFile = \base_path('deploy/base/deployments/cronjob.yaml');
        if (! \file_exists($cronjobFile)) {
            $output->writeWarning('跳过, 没有找到 cronjob.yaml 模板文件');
            return;
        }

        // more
    }
}

```

### 性能优秀

框架自身消耗极低，在 AWS c7g.large(4c8g) 实例上使用 wrk 压测框架自身可轻松处理 25w+/QPS 请求，结合协程，多进程组件等特性，无论是同步业务还是异步业务都能够轻松驾驭。

### 内置丰富组件

- **多运行时支持**: 支持 `swoole`、`swow`、`workerman`、`reactPHP`、`php-fpm` 等主流 PHP 运行时
- **连接池支持**: 通用连接池组件，内置数据库、Redis 等资源的高效连接池
- **零拷贝路由**: 优化的路由匹配算法
- **异步支持**: 集成 Swoole/ReactPHP 的异步处理能力
- **内存优化**: 精心设计的内存使用模式

### 生产可用

Hi Framework 已经在生产环境（社交与游戏业务）运行多年，日处理数十亿请求。同时在 arm64 与 x86 环境下运行良好，如遇到问题欢迎反馈。
