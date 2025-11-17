# 服务容器

服务容器是 Hi Framework 基于 [Spiral Container](https://spiral.dev/docs/container-overview/current/en) 开发的的核心组件，它提供了强大的依赖注入和服务管理功能。通过服务容器，您可以轻松管理应用程序的依赖关系，实现松耦合的架构。

## 概览

服务容器的主要功能包括：

- **依赖注入** - 自动解析和注入依赖
- **服务绑定** - 注册服务到容器
- **单例管理** - 控制服务的生命周期
- **自动装配** - 基于类型自动解析依赖

## 基本用法

### 获取容器实例

```php
<?php

use Hi\Container\Container;

// 获取全局容器实例
$container = app();

// 或者创建新的容器实例
$container = new Container();
```

### 服务绑定

#### 基本绑定

```php
<?php

// 绑定具体实现
$container->bind('cache', function () {
    return new RedisCache();
});

// 绑定接口到实现
$container->bind(CacheInterface::class, RedisCache::class);

// 使用闭包绑定
$container->bind('database', function (Container $container) {
    $config = $container->get('config')['database'];
    return new DatabaseManager($config);
});
```

#### 单例绑定

```php
<?php

// 单例绑定 - 整个应用生命周期中只创建一次
$container->singleton('logger', function () {
    return new Logger('app');
});

// 绑定已存在的实例
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$container->instance('redis', $redis);
```

#### 条件绑定

```php
<?php

// 只有在没有绑定时才绑定
$container->bindIf('cache', function () {
    return new ArrayCache();
});

// 基于环境的条件绑定
if ($env->isTesting()) {
    $container->bind('mail', TestMailer::class);
} else {
    $container->bind('mail', SmtpMailer::class);
}
```

## 服务解析

### 基本解析

```php
<?php

// 通过键名解析
$cache = $container->get('cache');

// 通过类名解析
$userService = $container->get(UserService::class);

// 使用 make 方法（每次都创建新实例）
$newInstance = $container->make(UserService::class);
```

### 参数传递

```php
<?php

// 解析时传递参数
$userService = $container->make(UserService::class, [
    'config' => ['timeout' => 30]
]);
```

## 自动装配

### 构造函数注入

```php
<?php

class UserService
{
    public function __construct(
        private UserRepository $repository,
        private CacheInterface $cache,
        private Logger $logger
    ) {}
}

// 容器会自动解析所有依赖
$userService = $container->get(UserService::class);
```

## 总结

Hi Framework 的服务容器提供了：

- **强大的依赖注入** - 自动解析复杂的依赖关系
- **灵活的绑定方式** - 支持多种绑定策略
- **生命周期管理** - 控制服务的创建和销毁
- **优秀的测试支持** - 易于模拟和测试
- **高性能** - 支持编译优化

通过合理使用服务容器，您可以构建松耦合、易测试、可维护的应用程序。 

更多说明，请参考 [Spiral Container](https://spiral.dev/docs/container-overview/current/en) 官方文档。