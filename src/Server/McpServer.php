<?php

declare(strict_types=1);

namespace Hi\MCP\Server;

use Hi\MCP\Protocol\ErrorCode;
use Hi\MCP\Protocol\Request;
use Hi\MCP\Protocol\Response;
use Hi\MCP\Server\Transport\TransportInterface;

/**
 * MCP Server 主类
 *
 * 基于预生成文档提供 MCP 服务
 */
final class McpServer
{
    private const PROTOCOL_VERSION = '2024-11-05';

    private bool $initialized = false;
    private bool $running = false;

    public function __construct(
        private readonly TransportInterface $transport,
        private readonly DocumentationReader $docReader,
        private readonly string $serverName = 'Hi Framework MCP Server',
        private readonly string $serverVersion = '2.0.0',
    ) {
    }

    /**
     * 启动服务器主循环
     */
    public function run(): void
    {
        $this->running = true;

        while ($this->isRunning()) {
            if (\function_exists('pcntl_signal_dispatch')) {
                \pcntl_signal_dispatch();
            }

            $message = $this->transport->read();

            if (null === $message) {
                break;
            }

            if ('' === $message) {
                continue;
            }

            $this->handleMessage($message);
        }
    }

    public function isRunning(): bool
    {
        return $this->running;
    }

    public function stop(): void
    {
        $this->running = false;
    }

    private function handleMessage(string $message): void
    {
        try {
            $data = \json_decode($message, true, 512, \JSON_THROW_ON_ERROR);

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

    private function handleNotification(array $data): void
    {
        $method = $data['method'] ?? '';

        match ($method) {
            'notifications/cancelled' => null,
            'notifications/initialized' => null,
            default => null,
        };
    }

    private function handleRequest(Request $request): Response
    {
        if (! $this->initialized && 'initialize' !== $request->method) {
            return Response::error($request->id, ErrorCode::SERVER_NOT_INITIALIZED, 'Server not initialized');
        }

        return match ($request->method) {
            'initialize' => $this->handleInitialize($request),
            'ping' => Response::success($request->id, []),
            'tools/list' => $this->handleToolsList($request),
            'tools/call' => $this->handleToolsCall($request),
            'resources/list' => $this->handleResourcesList($request),
            'resources/read' => $this->handleResourcesRead($request),
            'prompts/list' => $this->handlePromptsList($request),
            'prompts/get' => $this->handlePromptsGet($request),
            default => Response::error($request->id, ErrorCode::METHOD_NOT_FOUND, "Unknown method: {$request->method}"),
        };
    }

    private function handleInitialize(Request $request): Response
    {
        $this->initialized = true;

        $frameworkInfo = $this->docReader->getFrameworkInfo();

        return Response::success($request->id, [
            'protocolVersion' => self::PROTOCOL_VERSION,
            'capabilities' => [
                'tools' => ['listChanged' => false],
                'resources' => ['subscribe' => false, 'listChanged' => false],
                'prompts' => ['listChanged' => false],
            ],
            'serverInfo' => [
                'name' => $this->serverName,
                'version' => $this->serverVersion,
            ],
            'instructions' => "This is the {$frameworkInfo['name']} v{$frameworkInfo['version']} API documentation server. " .
                'Use the available tools to explore classes, interfaces, attributes, and usage guides.',
        ]);
    }

    private function handleToolsList(Request $request): Response
    {
        $tools = [
            [
                'name' => 'list_modules',
                'description' => 'List all modules in the framework',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => new \stdClass,
                ],
            ],
            [
                'name' => 'get_module',
                'description' => 'Get detailed information about a specific module',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'name' => ['type' => 'string', 'description' => 'Module name'],
                    ],
                    'required' => ['name'],
                ],
            ],
            [
                'name' => 'list_classes',
                'description' => 'List all classes, optionally filtered by namespace',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'namespace' => ['type' => 'string', 'description' => 'Filter by namespace prefix'],
                    ],
                ],
            ],
            [
                'name' => 'list_interfaces',
                'description' => 'List all interfaces, optionally filtered by namespace',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'namespace' => ['type' => 'string', 'description' => 'Filter by namespace prefix'],
                    ],
                ],
            ],
            [
                'name' => 'list_attributes',
                'description' => 'List all PHP 8+ Attributes',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'namespace' => ['type' => 'string', 'description' => 'Filter by namespace prefix'],
                    ],
                ],
            ],
            [
                'name' => 'get_class',
                'description' => 'Get detailed documentation for a class, interface, or attribute',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'fqcn' => ['type' => 'string', 'description' => 'Fully qualified class name'],
                    ],
                    'required' => ['fqcn'],
                ],
            ],
            [
                'name' => 'get_guide',
                'description' => 'Get a usage guide document',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'path' => ['type' => 'string', 'description' => 'Guide path (e.g., http/routing.md)'],
                    ],
                    'required' => ['path'],
                ],
            ],
            [
                'name' => 'search',
                'description' => 'Search for classes, methods, and guides by keyword',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => [
                        'query' => ['type' => 'string', 'description' => 'Search query'],
                    ],
                    'required' => ['query'],
                ],
            ],
            [
                'name' => 'get_statistics',
                'description' => 'Get framework statistics (number of classes, interfaces, etc.)',
                'inputSchema' => [
                    'type' => 'object',
                    'properties' => new \stdClass,
                ],
            ],
        ];

        return Response::success($request->id, ['tools' => $tools]);
    }

    private function handleToolsCall(Request $request): Response
    {
        $toolName = $request->params['name'] ?? '';
        $arguments = $request->params['arguments'] ?? [];

        $result = match ($toolName) {
            'list_modules' => $this->toolListModules(),
            'get_module' => $this->toolGetModule($arguments),
            'list_classes' => $this->toolListClasses($arguments),
            'list_interfaces' => $this->toolListInterfaces($arguments),
            'list_attributes' => $this->toolListAttributes($arguments),
            'get_class' => $this->toolGetClass($arguments),
            'get_guide' => $this->toolGetGuide($arguments),
            'search' => $this->toolSearch($arguments),
            'get_statistics' => $this->toolGetStatistics(),
            default => ['error' => "Unknown tool: {$toolName}"],
        };

        if (isset($result['error'])) {
            return Response::success($request->id, [
                'content' => [
                    ['type' => 'text', 'text' => "Error: {$result['error']}"],
                ],
                'isError' => true,
            ]);
        }

        return Response::success($request->id, [
            'content' => [
                ['type' => 'text', 'text' => $result['content']],
            ],
        ]);
    }

    private function toolListModules(): array
    {
        $modules = $this->docReader->getModules();
        $output = "# Framework Modules\n\n";

        foreach ($modules as $moduleName) {
            $info = $this->docReader->getModuleInfo($moduleName);
            $output .= "## {$moduleName}\n";
            $output .= ($info['description'] ?? '') . "\n";
            $output .= '- Classes: ' . count($info['classes'] ?? []) . "\n";
            $output .= '- Interfaces: ' . count($info['interfaces'] ?? []) . "\n";
            $output .= '- Attributes: ' . count($info['attributes'] ?? []) . "\n\n";
        }

        return ['content' => $output];
    }

    private function toolGetModule(array $args): array
    {
        $name = $args['name'] ?? '';
        if ('' === $name) {
            return ['error' => 'Module name is required'];
        }

        $doc = $this->docReader->getModuleDocument($name);
        if (null === $doc) {
            return ['error' => "Module not found: {$name}"];
        }

        return ['content' => $doc];
    }

    private function toolListClasses(array $args): array
    {
        $namespace = $args['namespace'] ?? null;
        $classes = $this->docReader->listClasses($namespace);

        $output = "# Classes" . ($namespace ? " in {$namespace}" : '') . "\n\n";
        $output .= "Total: " . count($classes) . "\n\n";

        foreach ($classes as $class) {
            $output .= "- **{$class['fqcn']}**";
            if (! empty($class['summary'])) {
                $output .= " - {$class['summary']}";
            }
            $output .= "\n";
        }

        return ['content' => $output];
    }

    private function toolListInterfaces(array $args): array
    {
        $namespace = $args['namespace'] ?? null;
        $interfaces = $this->docReader->listInterfaces($namespace);

        $output = "# Interfaces" . ($namespace ? " in {$namespace}" : '') . "\n\n";
        $output .= "Total: " . count($interfaces) . "\n\n";

        foreach ($interfaces as $interface) {
            $output .= "- **{$interface['fqcn']}**";
            if (! empty($interface['summary'])) {
                $output .= " - {$interface['summary']}";
            }
            $output .= "\n";
        }

        return ['content' => $output];
    }

    private function toolListAttributes(array $args): array
    {
        $namespace = $args['namespace'] ?? null;
        $attributes = $this->docReader->listAttributes($namespace);

        $output = "# PHP Attributes" . ($namespace ? " in {$namespace}" : '') . "\n\n";
        $output .= "Total: " . count($attributes) . "\n\n";

        foreach ($attributes as $attr) {
            $output .= "- **{$attr['fqcn']}**";
            if (! empty($attr['summary'])) {
                $output .= " - {$attr['summary']}";
            }
            $output .= "\n";
        }

        return ['content' => $output];
    }

    private function toolGetClass(array $args): array
    {
        $fqcn = $args['fqcn'] ?? '';
        if ('' === $fqcn) {
            return ['error' => 'FQCN is required'];
        }

        $doc = $this->docReader->getClassDocument($fqcn);
        if (null === $doc) {
            return ['error' => "Class not found: {$fqcn}"];
        }

        return ['content' => $doc];
    }

    private function toolGetGuide(array $args): array
    {
        $path = $args['path'] ?? '';
        if ('' === $path) {
            return ['error' => 'Guide path is required'];
        }

        $doc = $this->docReader->getGuideDocument($path);
        if (null === $doc) {
            return ['error' => "Guide not found: {$path}"];
        }

        return ['content' => $doc];
    }

    private function toolSearch(array $args): array
    {
        $query = $args['query'] ?? '';
        if ('' === $query) {
            return ['error' => 'Query is required'];
        }

        $results = $this->docReader->search($query);

        $output = "# Search Results for \"{$query}\"\n\n";
        $output .= "Found: " . count($results) . " results\n\n";

        foreach ($results as $result) {
            if ('guide' === $result['type']) {
                $output .= "- [Guide] {$result['path']}\n";
            } else {
                $output .= "- [{$result['type']}] **{$result['fqcn']}**";
                if (! empty($result['summary'])) {
                    $output .= " - {$result['summary']}";
                }
                $output .= "\n";
            }
        }

        return ['content' => $output];
    }

    private function toolGetStatistics(): array
    {
        $stats = $this->docReader->getStatistics();
        $frameworkInfo = $this->docReader->getFrameworkInfo();

        $output = "# {$frameworkInfo['name']} v{$frameworkInfo['version']} Statistics\n\n";
        $output .= "Generated at: {$frameworkInfo['generated_at']}\n\n";
        $output .= "- Modules: {$stats['modules']}\n";
        $output .= "- Classes: {$stats['classes']}\n";
        $output .= "- Interfaces: {$stats['interfaces']}\n";
        $output .= "- Traits: {$stats['traits']}\n";
        $output .= "- Enums: {$stats['enums']}\n";
        $output .= "- Attributes: {$stats['attributes']}\n";
        $output .= "- Guide Pages: {$stats['guide_pages']}\n";

        return ['content' => $output];
    }

    private function handleResourcesList(Request $request): Response
    {
        $resources = [
            [
                'uri' => 'hi://manifest',
                'name' => 'Framework Manifest',
                'description' => 'Complete framework manifest with all modules and search index',
                'mimeType' => 'application/json',
            ],
            [
                'uri' => 'hi://statistics',
                'name' => 'Framework Statistics',
                'description' => 'Framework statistics and counts',
                'mimeType' => 'text/plain',
            ],
        ];

        // 添加模块资源
        foreach ($this->docReader->getModules() as $moduleName) {
            $resources[] = [
                'uri' => "hi://module/{$moduleName}",
                'name' => "{$moduleName} Module",
                'description' => "Documentation for the {$moduleName} module",
                'mimeType' => 'text/markdown',
            ];
        }

        return Response::success($request->id, ['resources' => $resources]);
    }

    private function handleResourcesRead(Request $request): Response
    {
        $uri = $request->params['uri'] ?? '';

        if ('hi://manifest' === $uri) {
            $manifest = $this->docReader->getManifest();

            return Response::success($request->id, [
                'contents' => [
                    [
                        'uri' => $uri,
                        'mimeType' => 'application/json',
                        'text' => json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
                    ],
                ],
            ]);
        }

        if ('hi://statistics' === $uri) {
            $result = $this->toolGetStatistics();

            return Response::success($request->id, [
                'contents' => [
                    [
                        'uri' => $uri,
                        'mimeType' => 'text/plain',
                        'text' => $result['content'],
                    ],
                ],
            ]);
        }

        if (str_starts_with($uri, 'hi://module/')) {
            $moduleName = substr($uri, strlen('hi://module/'));
            $doc = $this->docReader->getModuleDocument($moduleName);

            if (null === $doc) {
                return Response::error($request->id, ErrorCode::INVALID_PARAMS, "Module not found: {$moduleName}");
            }

            return Response::success($request->id, [
                'contents' => [
                    [
                        'uri' => $uri,
                        'mimeType' => 'text/markdown',
                        'text' => $doc,
                    ],
                ],
            ]);
        }

        return Response::error($request->id, ErrorCode::INVALID_PARAMS, "Unknown resource: {$uri}");
    }

    private function handlePromptsList(Request $request): Response
    {
        $prompts = [
            [
                'name' => 'explain_class',
                'description' => 'Explain the functionality and usage of a class',
                'arguments' => [
                    [
                        'name' => 'fqcn',
                        'description' => 'Fully qualified class name',
                        'required' => true,
                    ],
                ],
            ],
            [
                'name' => 'find_implementation',
                'description' => 'Find implementations of an interface or abstract class',
                'arguments' => [
                    [
                        'name' => 'interface',
                        'description' => 'Interface or abstract class name',
                        'required' => true,
                    ],
                ],
            ],
        ];

        return Response::success($request->id, ['prompts' => $prompts]);
    }

    private function handlePromptsGet(Request $request): Response
    {
        $promptName = $request->params['name'] ?? '';
        $arguments = $request->params['arguments'] ?? [];

        $messages = match ($promptName) {
            'explain_class' => $this->promptExplainClass($arguments),
            'find_implementation' => $this->promptFindImplementation($arguments),
            default => [['role' => 'user', 'content' => ['type' => 'text', 'text' => "Unknown prompt: {$promptName}"]]],
        };

        return Response::success($request->id, ['messages' => $messages]);
    }

    private function promptExplainClass(array $args): array
    {
        $fqcn = $args['fqcn'] ?? '';
        $doc = $this->docReader->getClassDocument($fqcn);

        if (null === $doc) {
            return [
                ['role' => 'user', 'content' => ['type' => 'text', 'text' => "Class not found: {$fqcn}"]],
            ];
        }

        return [
            [
                'role' => 'user',
                'content' => [
                    'type' => 'text',
                    'text' => "Please explain the following class documentation and provide practical usage examples:\n\n{$doc}",
                ],
            ],
        ];
    }

    private function promptFindImplementation(array $args): array
    {
        $interface = $args['interface'] ?? '';
        $results = $this->docReader->search($interface);

        $content = "Please find implementations of {$interface}. Here are search results:\n\n";
        foreach ($results as $result) {
            if ('class' === $result['type']) {
                $content .= "- {$result['fqcn']}: {$result['summary']}\n";
            }
        }

        return [
            ['role' => 'user', 'content' => ['type' => 'text', 'text' => $content]],
        ];
    }
}
