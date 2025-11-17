# 注解

Hi Framework 采用注解优先的原则，为此设计了强大的注解系统，用于简化配置和代码组织。我们希望通过注解提供所见即所得效果，将业务规则和业务实现做一定程度上绑定，但是二者又不至于相互干扰。

注解是 PHP 8.0+ 新增的特性，提供了类型安全和更好的开发体验。

## 架构理念

### 1. 声明式编程

Hi Framework 的注解系统基于**声明式编程**的理念，通过注解将业务规则、配置信息和代码结构进行声明式绑定。

传统命令式编程

```php
class UserController 
{
    public function index() 
    {
        // 业务逻辑
    }
}

// 在路由文件中注册
$router->get('/users', [UserController::class, 'index']);
```

声明式编程

```php
// 通过注解直接声明路由规则
#[Route(prefix: '/api')]
class UserController 
{
    #[Get(pattern: '/users', desc: '获取用户列表')]
    public function index(): array 
    {
        // 业务逻辑
    }
}
```

**优势：**
- **代码自文档化**：注解本身就是文档，无需额外的配置文件
- **类型安全**：编译时检查注解参数类型
- **IDE 支持**：自动补全和错误提示
- **重构友好**：修改方法名时，注解自动跟随

### 2. 关注点分离

注解系统实现了**业务逻辑**与**框架配置**的分离：

```php
// 业务逻辑专注于业务实现
#[Get(pattern: '/users/detail', desc: '获取用户详情')]
public function show(Context $ctx): array
{
    // 纯业务逻辑，从查询参数获取用户ID
    $id = (int) ($ctx->getRequest()->getQueryParams()['id'] ?? 0);
    $user = $this->userService->find($id);
    return ['user' => $user];
}
```

框架通过注解自动处理：
- 路由注册
- 参数验证
- 中间件应用
- 响应格式化

### 3. 元数据驱动

注解系统本质上是**元数据驱动**的架构：

```php
// 注解定义元数据
#[Route(prefix: '/api', middlewares: ['auth'])]
class ApiController 
{
    #[Get(pattern: '/users', desc: '用户列表')]
    public function index(): array { }
}

// 框架通过反射读取元数据
$loader = new AwesomeAttributeLoader(['app/Routes']);
$loader->tokenize();

// 获取路由元数据
$routeCarriers = $loader->getClassCarriers(Route::class);
$methodCarriers = $loader->getMethodCarriers(Get::class);
```

## 核心架构组件

### 1. 注解加载器体系

框架提供了分层的注解加载器体系：

#### AwesomeAttributeLoader - 基础加载器

```php
class AwesomeAttributeLoader implements AwesomeLoaderInterface
{
    protected array $classStorage = [];
    protected array $methodStorage = [];
    protected array $propertyStorage = [];
    
    protected readonly AttributeLoaderInterface $attributeLoader;
    
    public function __construct(
        protected ContainerInterface $container,
        protected LoggerInterface $logger,
        protected array $directories = [],
        ?AttributeLoaderInterface $attributeLoader = null,
    ) {
        $this->attributeLoader = $attributeLoader ?? new AttributeLoader(
            new AttributeFileScanner($logger),
            $logger
        );
    }
    
    public function tokenize(): void
    {
        try {
            // 通过 AttributeLoader 加载所有属性
            foreach ($this->attributeLoader->loadAttributes($this->directories) as $carrier) {
                /** @var CarrierInterface $carrier */
                if ($carrier->isClass()) {
                    $this->storeClassAttribute($carrier);
                } elseif ($carrier->isMethod()) {
                    $this->storeMethodAttribute($carrier);
                } elseif ($carrier->isProperty()) {
                    $this->storePropertyAttribute($carrier);
                }
            }
        } catch (\Throwable $e) {
            throw new PrepareTokenizeException(
                message: sprintf('Attribute tokenize failed, directories unexpected: %s', implode(', ', $this->directories)),
                previous: $e,
            );
        }
    }
}
```

**设计思想：**
- **统一接口**：所有注解加载器都实现 `AwesomeLoaderInterface`
- **分层处理**：基础加载器负责扫描和解析，专用加载器负责业务逻辑
- **存储分离**：类、方法、属性注解分别存储，便于查询

#### HttpAttributeLoader - HTTP 专用加载器

```php
class HttpAttributeLoader extends AwesomeAttributeLoader implements HttpLoaderInterface
{
    public function load(RouterInterface $router): void
    {
        // 1. 准备中间件
        $preparedMiddlewares = $this->findRoutesAndMiddlewares();
        
        // 2. 注册路由
        foreach ($this->getClassCarriers(Route::class) as $attributes) {
            foreach ($attributes as $className => $carriers) {
                $this->registerRouteActions($router, $actions, $reflectionClass, $routeCors);
            }
        }
    }
}
```

**设计思想：**
- **职责单一**：专门处理 HTTP 相关的注解
- **自动注册**：自动将注解转换为路由配置
- **中间件集成**：自动应用中间件到路由

#### ConsoleAttributeLoader - 控制台专用加载器

```php
class ConsoleAttributeLoader implements CommandLoaderInterface
{
    public function findCommands(): iterable
    {
        foreach ($this->makeFinder()->getIterator() as $file) {
            $reflectionFile = new ReflectionFile((string) $file);
            foreach ($reflectionFile->getClasses() as $class) {
                $attributes = $this->reader->getClassMetadata($reflectionClass, Command::class);
                
                foreach ($attributes as $attribute) {
                    // 自动注册命令
                    yield $attribute->name => $attribute;
                }
            }
        }
    }
}
```

作用于以下示例类：

```php
// 命令行示例
```

**设计思想：**
- **命令发现**：自动发现和注册命令
- **动作绑定**：将命令动作绑定到方法
- **选项解析**：自动解析命令行选项

#### AutowireBindLoader - 依赖注入加载器

```php
class AutowireBindLoader extends AwesomeAttributeLoader
{
    public function load(Container $container, bool $debug = false): self
    {
        // 1. 处理依赖绑定注解
        foreach ($this->getClassCarriers(Bind::class) as $attributes) {
            foreach ($attributes as $className => $carriers) {
                $container->bindSingleton($className, $target->attribute->use);
            }
        }
        
        // 2. 处理缓存注解（生产环境生成代理类）
        if (false === $debug) {
            foreach ($this->getMethodCarriers(Cache::class) as $attributes) {
                $proxyClass = $this->createCacheProxy($carriers);
                $container->bind($className, $proxyClass);
            }
        }
    }
}
```

借助以下示例进行快速理解：

```php
class FooServer
{
    // do something
}

#[Bind(use: FooServer::class, singleton: true)]
interface FooServiceInterface
{
}
```

**设计思想：**
- **自动绑定**：根据注解自动配置依赖注入
- **环境感知**：根据环境选择不同的实现
- **代理生成**：为缓存方法生成代理类

### 2. 载体模式 (Carrier Pattern)

框架使用载体模式来封装注解信息：

```php
interface CarrierInterface
{
    public function isClass(): bool;
    public function isMethod(): bool;
    public function isProperty(): bool;
}

class ClassAttributeCarrier implements CarrierInterface
{
    public function __construct(
        public readonly \ReflectionClass $reflection,
        public readonly mixed $attribute,
        public readonly array $attributes,
    ) {}
}
```

**设计思想：**
- **统一接口**：所有载体都实现相同的接口
- **类型安全**：通过类型检查确保载体类型正确
- **信息完整**：载体包含反射信息和注解实例

### 3. 注解分类体系

#### HTTP 注解 - 路由驱动

```php
// 类级别注解 - 定义路由组
#[Route(prefix: '/api', desc: 'API 路由', middlewares: ['auth'])]
class UserController 
{
    // 方法级别注解 - 定义具体路由
    #[Get(pattern: '/users', desc: '获取用户列表')]
    public function index(): array { }
    
    #[Post(pattern: '/users', desc: '创建用户')]
    public function store(): array { }
}

// 参数注解 - 自动参数绑定（基于实际的Parameter类）
class CreateUserRequest 
{
    #[Body('name', '用户姓名')]
    public string $name;
    
    #[Query('page', '页码')]
    public int $page = 1;
    
    #[Header('X-User-ID', '用户ID')]
    public string $userId = '';
}
```

**设计思想：**
- **分层注解**：类级别定义通用配置，方法级别定义具体行为
- **自动绑定**：通过参数注解自动绑定请求数据
- **类型转换**：自动进行类型转换和验证

#### 控制台注解 - 命令驱动

```php
// 命令定义
#[Command(name: 'app:user', desc: '用户管理命令')]
class UserCommand 
{
    // 动作定义
    #[Action(name: 'create', desc: '创建用户')]
    public function create(): void { }
    
    // 选项定义
    #[Option(name: 'name', shortcut: 'n', desc: '用户姓名', required: true)]
    public function createUser(): void { }
}
```

**设计思想：**
- **命令组织**：通过命令组织相关功能
- **动作分离**：将命令的不同动作分离到不同方法
- **选项配置**：通过选项注解配置命令行参数

#### 核心注解 - 框架驱动

```php
// 依赖注入绑定（基于实际的Bind类）
#[Bind(use: App\Services\UserService::class, singleton: true)]
interface UserServiceInterface { }

// 环境感知绑定 - 根据环境自动选择实现类
#[Bind(use: App\Services\DevLogger::class, env: 'dev')]
#[Bind(use: App\Services\ProdLogger::class, env: 'production')]
interface LoggerInterface { }

// 注意：Cache注解需要根据实际实现确认参数结构
class UserService 
{
    // 假设的缓存注解（需要根据实际实现调整）
    public function getUserList(): array 
    {
        return [];
    }
}
```

**设计思想：**
- **接口绑定**：通过注解自动绑定接口到实现
- **环境感知**：根据环境自动选择实现
- **横切关注点**：通过注解处理缓存等横切关注点

## 注解系统的工作流程

### 1. 扫描阶段

```php
// 扫描指定目录的所有 PHP 文件
$finder = (new Finder)->files()->in($directories)->name('*.php');

foreach ($finder->getIterator() as $file) {
    $reflectionFile = new ReflectionFile((string) $file);
    foreach ($reflectionFile->getDeclarations() as $class) {
        $reflection = new \ReflectionClass($class);
        
        // 解析注解
        $this->parseClassAttribute($reflection);
        $this->parseMethodAttribute($reflection);
        $this->parsePropertyAttribute($reflection);
    }
}
```

### 2. 解析阶段

```php
// 使用 Spiral Attributes 库解析注解
$attributes = $this->reader->getClassMetadata($reflection);
foreach ($attributes as $attribute) {
    $this->classStorage[$attribute::class][$className][] = new ClassAttributeCarrier(
        reflection: $reflection,
        attribute: $attribute,
        attributes: $attributes,
    );
}
```

### 3. 应用阶段

```php
// HTTP 路由注册
foreach ($this->getClassCarriers(Route::class) as $attributes) {
    foreach ($attributes as $className => $carriers) {
        $this->registerRouteActions($router, $actions, $reflectionClass, $routeCors);
    }
}

// 控制台命令注册
foreach ($this->findCommands() as $name => $command) {
    $dispatcher->addCommand($name, $command);
}

// 依赖注入绑定
foreach ($this->getClassCarriers(Bind::class) as $attributes) {
    foreach ($attributes as $className => $carriers) {
        $container->bindSingleton($className, $target->attribute->use);
    }
}
```

## 设计优势

### 1. 开发效率

```php
// 传统方式 - 需要多个文件
// routes/web.php
Route::get('/api/users', [UserController::class, 'index']);

// UserController.php
class UserController 
{
    public function index() { }
}

// 注解方式 - 一个文件搞定
#[Route(prefix: '/api')]
class UserController 
{
    #[Get(pattern: '/users', desc: '获取用户列表')]
    public function index(): array { }
}
```

### 2. 类型安全

```php
// 编译时检查注解参数类型
#[Get(pattern: '/users', desc: '获取用户列表')]  // ✅ 正确
#[Get(pattern: 123, desc: '获取用户列表')]       // ❌ 类型错误
```

### 3. IDE 支持

```php
// 自动补全
#[Get(  // IDE 会提示可用的参数
    pattern: '/users',
    desc: '获取用户列表',
    middlewares: ['auth'],
    auth: true
)]
```

### 4. 重构友好

```php
// 修改方法名时，注解自动跟随
#[Get(pattern: '/users', desc: '获取用户列表')]
public function getUserList(): array { }  // 改为 getUserList

// 传统方式需要同时修改路由文件
Route::get('/api/users', [UserController::class, 'getUserList']);
```

## 最佳实践

### 1. 注解组织原则

```php
// 按功能分组
#[Route(prefix: '/api/users', desc: '用户管理')]
class UserController 
{
    #[Get(pattern: '/', desc: '用户列表')]
    public function index(): array { }
    
    #[Post(pattern: '/', desc: '创建用户')]
    public function store(): array { }
}

#[Route(prefix: '/api/posts', desc: '文章管理')]
class PostController 
{
    #[Get(pattern: '/', desc: '文章列表')]
    public function index(): array { }
}
```

### 2. 参数验证

```php
class CreateUserRequest 
{
    #[Body('name', '用户姓名')]
    public string $name;
    
    #[Body('email', '用户邮箱')]
    public string $email;
    
    #[Body('age', '用户年龄')]
    public int $age;
}
```

### 3. 缓存策略

```php
// 高频数据 - 长缓存
#[Cache(ttl: 3600, connection: 'redis')]
public function getPopularPosts(): array { }

// 低频数据 - 短缓存
#[Cache(ttl: 300, connection: 'redis')]
public function getRareData(): array { }
```

### 4. 中间件使用

```php
#[Route(prefix: '/api', middlewares: ['auth', 'throttle'])]
class ApiController 
{
    #[Get(pattern: '/public', desc: '公开接口')]
    public function public(): array { }
    
    #[Get(pattern: '/private', desc: '私有接口', middlewares: ['admin'])]
    public function private(): array { }
}
```

## 总结

Hi Framework 的注解系统体现了以下架构理念：

1. **声明式编程** - 通过注解声明业务规则和配置
2. **关注点分离** - 业务逻辑与框架配置分离
3. **元数据驱动** - 通过元数据驱动框架行为
4. **类型安全** - 编译时类型检查
5. **开发效率** - 减少样板代码，提高开发速度
6. **可维护性** - 代码自文档化，重构友好

通过这种设计，框架实现了**所见即所得**的效果，让开发者能够专注于业务逻辑的实现，而将框架配置和业务规则通过注解进行声明式绑定。

