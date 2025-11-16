<?php

declare(strict_types=1);

namespace Hi\MCP\Server;

use Hi\MCP\Analyzer\ProjectAnalyzer;
use Hi\MCP\Analyzer\UsageExampleGenerator;
use Hi\MCP\Protocol\ErrorCode;
use Hi\MCP\Protocol\Request;
use Hi\MCP\Protocol\Response;
use Hi\MCP\Server\Transport\TransportInterface;

/**
 * MCP Server 主类
 *
 * 实现 Model Context Protocol 服务器，提供框架 API 文档查询
 */
final class McpServer
{
    private const PROTOCOL_VERSION = '2024-11-05';

    private bool $initialized = false;
    private bool $running = false;
    private readonly UsageExampleGenerator $exampleGenerator;

    public function __construct(
        private readonly TransportInterface $transport,
        private readonly ProjectAnalyzer $projectAnalyzer,
        private readonly string $serverName = 'Hi Framework MCP Server',
        private readonly string $serverVersion = '1.0.0',
    ) {
        $this->exampleGenerator = new UsageExampleGenerator;
    }

    /**
     * 启动服务器主循环
     */
    public function run(): void
    {
        $this->running = true;

        while ($this->isRunning()) {
            // 处理待处理的信号
            if (\function_exists('pcntl_signal_dispatch')) {
                \pcntl_signal_dispatch();
            }

            $message = $this->transport->read();

            if (null === $message) {
                // EOF，退出循环
                break;
            }

            if ('' === $message) {
                // 空消息，继续循环（允许信号处理）
                continue;
            }

            $this->handleMessage($message);
        }
    }

    /**
     * 检查服务器是否运行中
     */
    public function isRunning(): bool
    {
        return $this->running;
    }

    /**
     * 处理单个消息
     */
    private function handleMessage(string $message): void
    {
        try {
            $data = \json_decode($message, true, 512, \JSON_THROW_ON_ERROR);

            // 检查是否是通知（无 id）
            if (! isset($data['id'])) {
                $this->handleNotification($data);

                return;
            }

            $request = Request::fromJson($message);
            $response = $this->handleRequest($request);
            $this->transport->write($response->toJson());
        } catch (\JsonException $e) {
            $response = Response::errorFromCode(0, ErrorCode::PARSE_ERROR, 'Invalid JSON: ' . $e->getMessage());
            $this->transport->write($response->toJson());
        } catch (\Throwable $e) {
            $response = Response::errorFromCode(0, ErrorCode::INTERNAL_ERROR, $e->getMessage());
            $this->transport->write($response->toJson());
        }
    }

    /**
     * 处理通知
     */
    private function handleNotification(array $data): void
    {
        $method = $data['method'] ?? '';

        match ($method) {
            'notifications/initialized' => $this->initialized = true,
            'notifications/cancelled' => null, // 忽略取消通知
            default => null,
        };
    }

    /**
     * 处理请求
     */
    private function handleRequest(Request $request): Response
    {
        return match ($request->method) {
            'initialize' => $this->handleInitialize($request),
            'ping' => $this->handlePing($request),
            'tools/list' => $this->handleToolsList($request),
            'tools/call' => $this->handleToolsCall($request),
            'resources/list' => $this->handleResourcesList($request),
            'resources/read' => $this->handleResourcesRead($request),
            'prompts/list' => $this->handlePromptsList($request),
            'prompts/get' => $this->handlePromptsGet($request),
            default => Response::errorFromCode($request->id, ErrorCode::METHOD_NOT_FOUND),
        };
    }

    /**
     * 处理初始化请求
     */
    private function handleInitialize(Request $request): Response
    {
        return Response::success($request->id, [
            'protocolVersion' => self::PROTOCOL_VERSION,
            'capabilities' => [
                'tools' => new \stdClass,
                'resources' => new \stdClass,
                'prompts' => new \stdClass,
            ],
            'serverInfo' => [
                'name' => $this->serverName,
                'version' => $this->serverVersion,
            ],
            'instructions' => 'Hi Framework API 文档服务器。使用 tools 查询类、接口、方法信息，使用 resources 读取详细文档。',
        ]);
    }

    /**
     * 处理 ping 请求
     */
    private function handlePing(Request $request): Response
    {
        return Response::success($request->id, []);
    }

    /**
     * 处理工具列表请求
     */
    private function handleToolsList(Request $request): Response
    {
        $tools = [
            [
                'name' => 'list_classes',
                'description' => '列出框架中的所有类。可选参数 namespace 用于过滤特定命名空间。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'namespace' => [
                            'type' => 'string',
                            'description' => '命名空间前缀，如 "Hi\\Http"',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'list_interfaces',
                'description' => '列出框架中的所有接口。可选参数 namespace 用于过滤特定命名空间。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'namespace' => [
                            'type' => 'string',
                            'description' => '命名空间前缀',
                        ],
                    ],
                ],
            ],
            [
                'name' => 'list_attributes',
                'description' => '列出框架中定义的所有 PHP Attributes。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => new \stdClass,
                ],
            ],
            [
                'name' => 'get_class_info',
                'description' => '获取指定类的完整信息，包括属性、方法、继承关系等。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'class' => [
                            'type' => 'string',
                            'description' => '完整类名（FQCN），如 "Hi\\Http\\Router"',
                        ],
                    ],
                    'required' => ['class'],
                ],
            ],
            [
                'name' => 'search_api',
                'description' => '搜索框架 API，支持类名、方法名、描述等关键词搜索。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'query' => [
                            'type' => 'string',
                            'description' => '搜索关键词',
                        ],
                    ],
                    'required' => ['query'],
                ],
            ],
            [
                'name' => 'analyze_module',
                'description' => '分析指定模块的结构，如 Http、Database、Cache 等。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'module' => [
                            'type' => 'string',
                            'description' => '模块名称，如 "Http"、"Database"',
                        ],
                    ],
                    'required' => ['module'],
                ],
            ],
            [
                'name' => 'get_attribute_info',
                'description' => '获取指定 PHP Attribute 的完整信息，包括构造函数参数、使用示例、适用目标等。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'attribute' => [
                            'type' => 'string',
                            'description' => '完整 Attribute 类名（FQCN），如 "Hi\\Attributes\\Http\\Get"',
                        ],
                    ],
                    'required' => ['attribute'],
                ],
            ],
            [
                'name' => 'get_method_usage',
                'description' => '获取指定类方法的详细用法，包括参数说明、返回值、使用示例等。',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'class' => [
                            'type' => 'string',
                            'description' => '完整类名（FQCN），如 "Hi\\Http\\Router"',
                        ],
                        'method' => [
                            'type' => 'string',
                            'description' => '方法名，如 "addRoute"',
                        ],
                    ],
                    'required' => ['class', 'method'],
                ],
            ],
        ];

        return Response::success($request->id, ['tools' => $tools]);
    }

    /**
     * 处理工具调用请求
     */
    private function handleToolsCall(Request $request): Response
    {
        $toolName = $request->getParam('name');
        $arguments = $request->getParam('arguments', []);

        if (! $toolName) {
            return Response::errorFromCode($request->id, ErrorCode::INVALID_PARAMS, 'Missing tool name');
        }

        try {
            $result = match ($toolName) {
                'list_classes' => $this->toolListClasses($arguments),
                'list_interfaces' => $this->toolListInterfaces($arguments),
                'list_attributes' => $this->toolListAttributes($arguments),
                'get_class_info' => $this->toolGetClassInfo($arguments),
                'search_api' => $this->toolSearchApi($arguments),
                'analyze_module' => $this->toolAnalyzeModule($arguments),
                'get_attribute_info' => $this->toolGetAttributeInfo($arguments),
                'get_method_usage' => $this->toolGetMethodUsage($arguments),
                default => throw new \InvalidArgumentException("Unknown tool: {$toolName}"),
            };

            $text = \json_encode($result, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_UNICODE);

            return Response::success($request->id, [
                'content' => [
                    [
                        'type' => 'text',
                        'text' => false === $text ? '{}' : $text,
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            return Response::success($request->id, [
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Error: ' . $e->getMessage(),
                    ],
                ],
                'isError' => true,
            ]);
        }
    }

    /**
     * 处理资源列表请求
     */
    private function handleResourcesList(Request $request): Response
    {
        $this->projectAnalyzer->analyze();

        $resources = [
            [
                'uri' => 'hi://structure',
                'name' => '项目结构',
                'description' => 'Hi Framework 项目整体结构概览',
                'mimeType' => 'application/json',
            ],
            [
                'uri' => 'hi://classes',
                'name' => '类列表',
                'description' => '所有类的索引列表',
                'mimeType' => 'application/json',
            ],
            [
                'uri' => 'hi://interfaces',
                'name' => '接口列表',
                'description' => '所有接口的索引列表',
                'mimeType' => 'application/json',
            ],
            [
                'uri' => 'hi://attributes',
                'name' => 'Attributes 列表',
                'description' => '所有 PHP Attributes 的索引列表',
                'mimeType' => 'application/json',
            ],
        ];

        // 添加模块资源
        foreach (\array_keys($this->projectAnalyzer->getModules()) as $moduleName) {
            $resources[] = [
                'uri' => "hi://module/{$moduleName}",
                'name' => "{$moduleName} 模块",
                'description' => "{$moduleName} 模块的完整文档",
                'mimeType' => 'application/json',
            ];
        }

        return Response::success($request->id, ['resources' => $resources]);
    }

    /**
     * 处理资源读取请求
     */
    private function handleResourcesRead(Request $request): Response
    {
        $uri = $request->getParam('uri');

        if (! $uri) {
            return Response::errorFromCode($request->id, ErrorCode::INVALID_PARAMS, 'Missing uri');
        }

        try {
            $content = $this->readResource($uri);

            return Response::success($request->id, [
                'contents' => [
                    [
                        'uri' => $uri,
                        'mimeType' => 'application/json',
                        'text' => \json_encode($content, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_UNICODE),
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            return Response::errorFromCode($request->id, ErrorCode::RESOURCE_NOT_FOUND, $e->getMessage());
        }
    }

    /**
     * 读取资源内容
     */
    private function readResource(string $uri): array
    {
        $this->projectAnalyzer->analyze();

        if ('hi://structure' === $uri) {
            return $this->projectAnalyzer->getStructure();
        }

        if ('hi://classes' === $uri) {
            return \array_map(static fn ($c) => [
                'fqcn' => $c['fqcn'],
                'name' => $c['name'],
                'namespace' => $c['namespace'],
                'description' => $c['description'],
            ], $this->projectAnalyzer->getClasses());
        }

        if ('hi://interfaces' === $uri) {
            return \array_map(static fn ($i) => [
                'fqcn' => $i['fqcn'],
                'name' => $i['name'],
                'namespace' => $i['namespace'],
                'description' => $i['description'],
            ], $this->projectAnalyzer->getInterfaces());
        }

        if ('hi://attributes' === $uri) {
            return \array_map(static fn ($a) => [
                'fqcn' => $a['fqcn'],
                'name' => $a['name'],
                'namespace' => $a['namespace'],
                'description' => $a['description'],
            ], $this->projectAnalyzer->getAttributes());
        }

        // 模块资源
        if (\preg_match('/^hi:\/\/module\/(.+)$/', $uri, $matches)) {
            $moduleName = $matches[1];
            $modules = $this->projectAnalyzer->getModules();

            if (! isset($modules[$moduleName])) {
                throw new \InvalidArgumentException("Module not found: {$moduleName}");
            }

            return $modules[$moduleName];
        }

        // 类资源
        if (\preg_match('/^hi:\/\/class\/(.+)$/', $uri, $matches)) {
            $className = \str_replace('/', '\\', $matches[1]);
            $info = $this->projectAnalyzer->getClassInfo($className);

            if (! $info) {
                throw new \InvalidArgumentException("Class not found: {$className}");
            }

            return $info;
        }

        throw new \InvalidArgumentException("Unknown resource: {$uri}");
    }

    /**
     * 处理提示列表请求
     */
    private function handlePromptsList(Request $request): Response
    {
        $prompts = [
            [
                'name' => 'explain_class',
                'description' => '解释指定类的功能和用法',
                'arguments' => [
                    [
                        'name' => 'class',
                        'description' => '要解释的类名',
                        'required' => true,
                    ],
                ],
            ],
            [
                'name' => 'find_implementation',
                'description' => '查找接口的实现或抽象类的子类',
                'arguments' => [
                    [
                        'name' => 'interface',
                        'description' => '接口或抽象类名',
                        'required' => true,
                    ],
                ],
            ],
        ];

        return Response::success($request->id, ['prompts' => $prompts]);
    }

    /**
     * 处理提示获取请求
     */
    private function handlePromptsGet(Request $request): Response
    {
        $name = $request->getParam('name');
        $arguments = $request->getParam('arguments', []);

        if (! $name) {
            return Response::errorFromCode($request->id, ErrorCode::INVALID_PARAMS, 'Missing prompt name');
        }

        $messages = match ($name) {
            'explain_class' => $this->promptExplainClass($arguments),
            'find_implementation' => $this->promptFindImplementation($arguments),
            default => throw new \InvalidArgumentException("Unknown prompt: {$name}"),
        };

        return Response::success($request->id, [
            'description' => "Prompt: {$name}",
            'messages' => $messages,
        ]);
    }

    // === Tool 实现 ===

    private function toolListClasses(array $arguments): array
    {
        $namespace = $arguments['namespace'] ?? null;

        if ($namespace) {
            $classes = $this->projectAnalyzer->filterByNamespace($namespace);
        } else {
            $classes = $this->projectAnalyzer->getClasses();
        }

        return \array_map(static fn ($c) => [
            'fqcn' => $c['fqcn'],
            'name' => $c['name'],
            'description' => \mb_substr($c['description'], 0, 100),
        ], $classes);
    }

    private function toolListInterfaces(array $arguments): array
    {
        $namespace = $arguments['namespace'] ?? null;
        $interfaces = $this->projectAnalyzer->getInterfaces();

        if ($namespace) {
            $interfaces = \array_filter($interfaces, static fn ($i) => \str_starts_with($i['namespace'], $namespace));
        }

        return \array_map(static fn ($i) => [
            'fqcn' => $i['fqcn'],
            'name' => $i['name'],
            'description' => \mb_substr($i['description'], 0, 100),
        ], $interfaces);
    }

    private function toolListAttributes(array $arguments): array
    {
        unset($arguments); // 标记为有意未使用

        $attributes = $this->projectAnalyzer->getAttributes();

        return \array_map(function ($a) {
            // 获取完整类信息以提取构造函数参数
            $classInfo = $this->projectAnalyzer->getClassInfo($a['fqcn']);
            $params = $classInfo ? $this->extractConstructorParameters($classInfo) : [];
            $target = $this->extractAttributeTarget($a['fqcn']);

            // 生成参数摘要
            $paramSummary = \array_map(static fn ($p) => [
                'name' => $p['name'],
                'type' => $p['type'] ?? 'mixed',
                'required' => ! $p['isOptional'],
            ], $params);

            return [
                'fqcn' => $a['fqcn'],
                'name' => $a['name'],
                'description' => $a['description'],
                'target' => $target,
                'parameters' => $paramSummary,
            ];
        }, $attributes);
    }

    private function toolGetClassInfo(array $arguments): array
    {
        $className = $arguments['class'] ?? null;

        if (! $className) {
            throw new \InvalidArgumentException('Missing class parameter');
        }

        $info = $this->projectAnalyzer->getClassInfo($className);

        if (! $info) {
            throw new \InvalidArgumentException("Class not found: {$className}");
        }

        // 添加使用示例
        $info['usage_examples'] = $this->exampleGenerator->generateClassUsage($info);

        // 为每个公共方法添加简要使用示例
        foreach ($info['methods'] as &$method) {
            if ('public' === $method['visibility'] && ! \str_starts_with($method['name'], '__')) {
                $method['usage_example'] = $this->exampleGenerator->generateMethodUsage($method, $className);
            }
        }

        return $info;
    }

    private function toolGetMethodUsage(array $arguments): array
    {
        $className = $arguments['class'] ?? null;
        $methodName = $arguments['method'] ?? null;

        if (! $className) {
            throw new \InvalidArgumentException('Missing class parameter');
        }

        if (! $methodName) {
            throw new \InvalidArgumentException('Missing method parameter');
        }

        $classInfo = $this->projectAnalyzer->getClassInfo($className);

        if (! $classInfo) {
            throw new \InvalidArgumentException("Class not found: {$className}");
        }

        // 查找指定方法
        $methodInfo = null;
        foreach ($classInfo['methods'] as $method) {
            if ($method['name'] === $methodName) {
                $methodInfo = $method;

                break;
            }
        }

        if (! $methodInfo) {
            throw new \InvalidArgumentException("Method not found: {$className}::{$methodName}");
        }

        // 生成详细的方法用法信息
        $usageExample = $this->exampleGenerator->generateMethodUsage($methodInfo, $className);

        // 生成参数详细说明
        $parameterDocs = [];
        foreach ($methodInfo['parameters'] as $param) {
            $parameterDocs[] = [
                'name' => $param['name'],
                'type' => $param['type'] ?? 'mixed',
                'description' => $param['description'],
                'required' => ! $param['isOptional'],
                'default' => $param['hasDefault'] ? $param['default'] : null,
                'nullable' => $param['isNullable'],
            ];
        }

        return [
            'class' => $className,
            'method' => $methodName,
            'signature' => $this->generateMethodSignature($methodInfo),
            'description' => $methodInfo['description'],
            'parameters' => $parameterDocs,
            'return_type' => $methodInfo['returnType'],
            'return_description' => $methodInfo['returnDescription'],
            'throws' => $methodInfo['throws'],
            'is_static' => $methodInfo['isStatic'],
            'visibility' => $methodInfo['visibility'],
            'usage_example' => $usageExample,
            'related_methods' => $this->findRelatedMethods($classInfo, $methodName),
        ];
    }

    /**
     * 生成方法签名字符串
     */
    private function generateMethodSignature(array $methodInfo): string
    {
        $visibility = $methodInfo['visibility'];
        $static = $methodInfo['isStatic'] ? ' static' : '';
        $final = $methodInfo['isFinal'] ? ' final' : '';
        $abstract = $methodInfo['isAbstract'] ? ' abstract' : '';
        $name = $methodInfo['name'];
        $returnType = $methodInfo['returnType'] ?? 'mixed';

        $params = [];
        foreach ($methodInfo['parameters'] as $param) {
            $paramStr = '';
            if ($param['type']) {
                $paramStr .= $param['type'] . ' ';
            }
            $paramStr .= '$' . $param['name'];
            if ($param['hasDefault']) {
                $default = $param['default'];
                if (\is_string($default)) {
                    $default = "'{$default}'";
                } elseif (\is_bool($default)) {
                    $default = $default ? 'true' : 'false';
                } elseif (null === $default) {
                    $default = 'null';
                } elseif (\is_array($default)) {
                    $default = '[]';
                }
                $paramStr .= ' = ' . $default;
            }
            $params[] = $paramStr;
        }

        $paramString = \implode(', ', $params);

        return "{$visibility}{$final}{$abstract}{$static} function {$name}({$paramString}): {$returnType}";
    }

    /**
     * 查找相关方法
     */
    private function findRelatedMethods(array $classInfo, string $currentMethod): array
    {
        $related = [];
        $methodPrefix = \preg_replace('/^(get|set|is|has|add|remove|create|update|delete)/', '', $currentMethod);

        foreach ($classInfo['methods'] as $method) {
            if ($method['name'] === $currentMethod) {
                continue;
            }

            // 查找相同前缀或相关操作的方法
            if ('public' === $method['visibility']
                && ! \str_starts_with($method['name'], '__')
                && (
                    \str_contains($method['name'], $methodPrefix)
                    || \str_starts_with($method['name'], 'get') && \str_starts_with($currentMethod, 'set')
                    || \str_starts_with($method['name'], 'set') && \str_starts_with($currentMethod, 'get')
                )
            ) {
                $related[] = [
                    'name' => $method['name'],
                    'description' => \mb_substr($method['description'], 0, 80),
                ];
            }

            if (\count($related) >= 5) {
                break;
            }
        }

        return $related;
    }

    private function toolSearchApi(array $arguments): array
    {
        $query = $arguments['query'] ?? null;

        if (! $query) {
            throw new \InvalidArgumentException('Missing query parameter');
        }

        return $this->projectAnalyzer->searchApi($query);
    }

    private function toolAnalyzeModule(array $arguments): array
    {
        $moduleName = $arguments['module'] ?? null;

        if (! $moduleName) {
            throw new \InvalidArgumentException('Missing module parameter');
        }

        $modules = $this->projectAnalyzer->getModules();

        if (! isset($modules[$moduleName])) {
            throw new \InvalidArgumentException("Module not found: {$moduleName}");
        }

        return $modules[$moduleName];
    }

    private function toolGetAttributeInfo(array $arguments): array
    {
        $attributeName = $arguments['attribute'] ?? null;

        if (! $attributeName) {
            throw new \InvalidArgumentException('Missing attribute parameter');
        }

        // 获取基本类信息
        $info = $this->projectAnalyzer->getClassInfo($attributeName);

        if (! $info) {
            throw new \InvalidArgumentException("Attribute not found: {$attributeName}");
        }

        // 提取 Attribute 特定信息
        $attributeTarget = $this->extractAttributeTarget($attributeName);
        $constructorParams = $this->extractConstructorParameters($info);
        $usageExample = $this->generateAttributeUsageExample($attributeName, $constructorParams, $attributeTarget);
        $parentInfo = $this->extractParentAttributeInfo($info);

        return [
            'fqcn' => $info['fqcn'],
            'name' => $info['name'],
            'description' => $info['description'],
            'target' => $attributeTarget,
            'parameters' => $constructorParams,
            'parent' => $parentInfo,
            'usage_example' => $usageExample,
            'related_attributes' => $this->findRelatedAttributes($attributeName),
        ];
    }

    /**
     * 提取 Attribute 的目标类型
     */
    private function extractAttributeTarget(string $attributeName): array
    {
        if (! \class_exists($attributeName)) {
            return ['unknown'];
        }

        $reflection = new \ReflectionClass($attributeName);
        $attributes = $reflection->getAttributes(\Attribute::class);

        if (empty($attributes)) {
            return ['unknown'];
        }

        $attribute = $attributes[0];
        $args = $attribute->getArguments();
        $flags = $args[0] ?? \Attribute::TARGET_ALL;

        $targets = [];
        if ($flags & \Attribute::TARGET_CLASS) {
            $targets[] = 'CLASS';
        }
        if ($flags & \Attribute::TARGET_FUNCTION) {
            $targets[] = 'FUNCTION';
        }
        if ($flags & \Attribute::TARGET_METHOD) {
            $targets[] = 'METHOD';
        }
        if ($flags & \Attribute::TARGET_PROPERTY) {
            $targets[] = 'PROPERTY';
        }
        if ($flags & \Attribute::TARGET_CLASS_CONSTANT) {
            $targets[] = 'CLASS_CONSTANT';
        }
        if ($flags & \Attribute::TARGET_PARAMETER) {
            $targets[] = 'PARAMETER';
        }

        return $targets ?: ['ALL'];
    }

    /**
     * 提取构造函数参数
     */
    private function extractConstructorParameters(array $classInfo): array
    {
        foreach ($classInfo['methods'] as $method) {
            if ('__construct' === $method['name']) {
                return $method['parameters'];
            }
        }

        // 检查父类构造函数
        if ($classInfo['parent'] && \class_exists($classInfo['parent'])) {
            $parentInfo = $this->projectAnalyzer->getClassInfo($classInfo['parent']);
            if ($parentInfo) {
                return $this->extractConstructorParameters($parentInfo);
            }
        }

        return [];
    }

    /**
     * 生成 Attribute 使用示例
     */
    private function generateAttributeUsageExample(string $attributeName, array $parameters, array $targets): string
    {
        $shortName = \mb_substr($attributeName, \mb_strrpos($attributeName, '\\') + 1);

        // 构建参数示例
        $paramExamples = [];
        foreach ($parameters as $param) {
            $example = $this->generateParameterExample($param);
            if (null !== $example) {
                $paramExamples[] = $param['name'] . ': ' . $example;
            }
        }

        $paramString = \implode(', ', $paramExamples);
        $attributeUsage = empty($paramString) ? "#[{$shortName}]" : "#[{$shortName}({$paramString})]";

        // 根据目标生成上下文
        if (\in_array('CLASS', $targets, true)) {
            return <<<PHP
{$attributeUsage}
class ExampleController
{
    // ...
}
PHP;
        }

        if (\in_array('METHOD', $targets, true)) {
            return <<<PHP
class ExampleController
{
    {$attributeUsage}
    public function exampleAction(Context \$context): array
    {
        return ['status' => 'ok'];
    }
}
PHP;
        }

        if (\in_array('PARAMETER', $targets, true)) {
            return <<<PHP
class ExampleController
{
    public function create(
        {$attributeUsage}
        CreateRequest \$request
    ): Response {
        // ...
    }
}
PHP;
        }

        if (\in_array('PROPERTY', $targets, true)) {
            return <<<PHP
class Example
{
    {$attributeUsage}
    private string \$value;
}
PHP;
        }

        return $attributeUsage;
    }

    /**
     * 生成参数示例值
     */
    private function generateParameterExample(array $param): ?string
    {
        // 跳过可选参数，除非是重要参数
        if ($param['isOptional'] && ! \in_array($param['name'], ['pattern', 'desc', 'name', 'ttl'], true)) {
            return null;
        }

        // 根据参数名生成示例
        return match ($param['name']) {
            'pattern' => "'/users/{id}'",
            'desc' => "'Get user by ID'",
            'name' => "'example'",
            'ttl' => '3600',
            'prefix' => "'/api'",
            'middlewares' => '[]',
            'auth' => 'true',
            'cors' => "''",
            'owner' => "''",
            'priority' => '0',
            'connection' => "'default'",
            'shortcut' => "'-n'",
            'default' => 'null',
            'required' => 'false',
            default => $this->generateExampleByType($param),
        };
    }

    /**
     * 根据类型生成示例
     */
    private function generateExampleByType(array $param): string
    {
        $type = $param['type'] ?? 'mixed';

        if (\str_contains($type, 'string')) {
            return "'{$param['name']}_value'";
        }
        if (\str_contains($type, 'int')) {
            return '0';
        }
        if (\str_contains($type, 'bool')) {
            return 'false';
        }
        if (\str_contains($type, 'array')) {
            return '[]';
        }

        return 'null';
    }

    /**
     * 提取父类 Attribute 信息
     */
    private function extractParentAttributeInfo(array $classInfo): ?array
    {
        if (! $classInfo['parent']) {
            return null;
        }

        $parentInfo = $this->projectAnalyzer->getClassInfo($classInfo['parent']);
        if (! $parentInfo) {
            return null;
        }

        return [
            'fqcn' => $parentInfo['fqcn'],
            'name' => $parentInfo['name'],
            'description' => $parentInfo['description'],
        ];
    }

    /**
     * 查找相关的 Attributes
     */
    private function findRelatedAttributes(string $attributeName): array
    {
        $namespace = \mb_substr($attributeName, 0, \mb_strrpos($attributeName, '\\'));
        $attributes = $this->projectAnalyzer->getAttributes();

        $related = [];
        foreach ($attributes as $attr) {
            if ($attr['namespace'] === $namespace && $attr['fqcn'] !== $attributeName) {
                $related[] = [
                    'fqcn' => $attr['fqcn'],
                    'name' => $attr['name'],
                    'description' => \mb_substr($attr['description'], 0, 80),
                ];
            }
        }

        return $related;
    }

    // === Prompt 实现 ===

    private function promptExplainClass(array $arguments): array
    {
        $className = $arguments['class'] ?? null;

        if (! $className) {
            throw new \InvalidArgumentException('Missing class parameter');
        }

        $info = $this->projectAnalyzer->getClassInfo($className);

        if (! $info) {
            throw new \InvalidArgumentException("Class not found: {$className}");
        }

        $infoJson = \json_encode($info, \JSON_PRETTY_PRINT | \JSON_UNESCAPED_UNICODE);

        return [
            [
                'role' => 'user',
                'content' => [
                    'type' => 'text',
                    'text' => "请解释以下类的功能、设计目的和使用方法：\n\n{$infoJson}",
                ],
            ],
        ];
    }

    private function promptFindImplementation(array $arguments): array
    {
        $interface = $arguments['interface'] ?? null;

        if (! $interface) {
            throw new \InvalidArgumentException('Missing interface parameter');
        }

        $classes = $this->projectAnalyzer->getClasses();
        $implementations = [];

        foreach ($classes as $class) {
            if (\in_array($interface, $class['interfaces'], true) || $class['parent'] === $interface) {
                $implementations[] = $class['fqcn'];
            }
        }

        $list = \implode("\n", $implementations);

        return [
            [
                'role' => 'user',
                'content' => [
                    'type' => 'text',
                    'text' => "以下是 {$interface} 的实现类：\n\n{$list}\n\n请分析这些实现的异同。",
                ],
            ],
        ];
    }

    /**
     * 停止服务器
     */
    public function stop(): void
    {
        $this->running = false;
    }
}
