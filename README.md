# MCP Server for PHP

Model Context Protocol (MCP) Server that exposes your PHP codebase API to AI assistants like Claude Code.

## Features

- **Full MCP 2.0 Protocol Support**: JSON-RPC 2.0 compliant
- **Code Analysis**: Automatic PHP class, interface, and trait discovery
- **API Documentation**: Generate usage examples and method signatures
- **Smart Caching**: TTL-based analysis cache for performance
- **Signal Handling**: Graceful shutdown support (SIGINT, SIGTERM, SIGHUP)

## Installation

```bash
composer require hi/mcp-server
```

## Quick Start

### Basic Usage

```bash
# Start MCP server for your project
./vendor/bin/mcp-server --src=src
```

### Claude Code Integration

```bash
# Add to Claude Code
claude mcp add my-project ./vendor/bin/mcp-server --src=src

# With custom cache settings
claude mcp add my-project ./vendor/bin/mcp-server --src=app/src --cache=/tmp/cache --ttl=7200
```

## Command Line Options

```
Usage: mcp-server [options]

Options:
  --src=PATH     Source directory to analyze (default: src)
  --cache=PATH   Cache directory (default: var/cache)
  --ttl=SECONDS  Cache TTL in seconds (default: 3600)
  --version      Show version information
  --help         Show this help message
```

## Available MCP Tools

The server provides the following tools for AI assistants:

| Tool | Description |
|------|-------------|
| `list_classes` | List all classes with optional namespace filtering |
| `list_interfaces` | List all interfaces in the codebase |
| `list_attributes` | List all PHP 8+ Attributes |
| `get_class_info` | Get complete class information (properties, methods, inheritance) |
| `search_api` | Full-text search across API (class names, methods, descriptions) |
| `analyze_module` | Analyze module structure and relationships |
| `get_attribute_info` | Get Attribute details with usage examples |
| `get_method_usage` | Get method usage with parameters and examples |

## Available MCP Resources

| Resource | Description |
|----------|-------------|
| `api://classes` | Complete list of all classes |
| `api://interfaces` | Complete list of all interfaces |
| `api://attributes` | Complete list of all Attributes |
| `api://structure` | Project structure overview |

## Available MCP Prompts

| Prompt | Description |
|--------|-------------|
| `explain_class` | Explain class functionality and usage |
| `find_implementation` | Find implementations of interfaces or abstract classes |

## Example Usage in Claude Code

After integrating with Claude Code, you can:

```
User: What classes are in the Http namespace?
Assistant: [Uses list_classes tool with namespace filter]

User: How do I use the Router class?
Assistant: [Uses get_class_info and get_method_usage tools]

User: Find all implementations of CacheInterface
Assistant: [Uses find_implementation prompt]
```

## Configuration

### Cache Management

The server uses file-based caching to improve performance:

```bash
# Custom cache directory and TTL
./vendor/bin/mcp-server --src=src --cache=/var/cache/mcp --ttl=7200
```

Cache is automatically invalidated when source files are modified.

### Without Cache

If the cache directory cannot be created, the server will run without caching (slower but functional).

## Requirements

- PHP 8.2+
- ext-json
- ext-tokenizer
- ext-pcntl (optional, for signal handling)

## Architecture

```
Client Request (JSON-RPC 2.0)
    ↓
StdioTransport (read)
    ↓
McpServer (route request)
    ↓
ProjectAnalyzer (with cache)
    ↓
ClassAnalyzer + DocBlockParser
    ↓
UsageExampleGenerator
    ↓
Response (JSON-RPC 2.0)
```

## Development

```bash
# Install dependencies
composer install

# Run tests
composer test

# Code style fix
composer cs

# Static analysis
composer psalm
```

## License

MIT License

## Credits

Built on [Hi Framework](https://github.com/hi-framework/framework) MCP implementation.
