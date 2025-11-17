# PHP MCP Server

为 AI 助手（如 Claude Code）提供 PHP 代码库 API 文档的 Model Context Protocol (MCP) 服务器。

## 特性

- **完整 MCP 2.0 协议支持**：JSON-RPC 2.0 标准
- **静态文档生成**：基于 PHP-Parser 的源码分析，生成 Markdown 文档
- **API + 指南融合**：自动关联 API 文档与使用指南
- **智能搜索**：关键词索引，快速定位类、方法、文档
- **模块聚合**：自动识别和组织模块结构
- **信号处理**：优雅关闭支持 (SIGINT, SIGTERM, SIGHUP)

## 安装

```bash
composer require hi/mcp-server
```

## 快速开始

### 1. 生成文档

```bash
# 在 mcp-server 包目录下生成文档
cd vendor/hi/mcp-server
php bin/mcp-generate \
  --src=../framework/src \
  --docs=../framework/docs \
  --output=.mcp
```

### 2. 启动 MCP 服务器

```bash
# 默认使用包自身的 .mcp 目录
php bin/mcp-server
```

### 3. Claude Code 集成

```bash
# 无需指定 --mcp-dir，默认使用包的 .mcp 目录
claude mcp add hi-framework ./vendor/bin/mcp-server
```

## 命令行选项

### mcp-generate（文档生成器）

```
用法: mcp-generate [选项]

选项:
  --src=PATH        源代码目录（必需）
  --docs=PATH       现有文档目录（可选）
  --output=PATH     输出目录（默认: .mcp）
  --name=NAME       框架名称（默认: Hi Framework）
  --version=VER     框架版本（默认: 2.0.0）
  --namespace=NS    根命名空间（默认: Hi）
  --help            显示帮助信息
```

### mcp-server（MCP 服务器）

```
用法: mcp-server [选项]

选项:
  --mcp-dir=PATH    文档目录（默认: 包自身的 .mcp 目录）
  --version         显示版本信息
  --help            显示帮助信息
```

## 生成的文档结构

```
.mcp/
├── manifest.json           # 主索引文件（模块、搜索索引、统计）
├── api/
│   ├── classes/            # 类文档 (Markdown)
│   ├── interfaces/         # 接口文档
│   ├── traits/             # Trait 文档
│   ├── enums/              # 枚举文档
│   └── attributes/         # PHP 8+ Attribute 文档
├── modules/                # 模块聚合文档
└── guides/                 # 使用指南（从源项目复制）
```

## 可用的 MCP 工具

| 工具 | 描述 |
|------|------|
| `list_modules` | 列出所有模块 |
| `get_module` | 获取模块详细信息 |
| `list_classes` | 列出所有类（支持命名空间过滤）|
| `list_interfaces` | 列出所有接口 |
| `list_attributes` | 列出所有 PHP 8+ Attributes |
| `get_class` | 获取类/接口/Attribute 的完整文档 |
| `get_guide` | 获取使用指南文档 |
| `search` | 搜索类、方法、指南 |
| `get_statistics` | 获取框架统计信息 |

## 可用的 MCP 资源

| 资源 | 描述 |
|------|------|
| `hi://manifest` | 完整的框架清单（JSON）|
| `hi://statistics` | 框架统计信息 |
| `hi://module/{name}` | 特定模块的文档 |

## 可用的 MCP 提示

| 提示 | 描述 |
|------|------|
| `explain_class` | 解释类的功能和用法 |
| `find_implementation` | 查找接口或抽象类的实现 |

## Claude Code 使用示例

集成后，你可以这样使用：

```
用户: Hi\Attributes\Http\Route 怎么用？
助手: [使用 get_class 工具获取 Route Attribute 文档]

用户: 搜索所有与缓存相关的类
助手: [使用 search 工具搜索 "cache"]

用户: 有哪些 HTTP 中间件的使用指南？
助手: [使用 get_module 工具获取 Http 模块信息]
```

## 系统要求

- PHP 8.2+
- ext-json
- ext-tokenizer
- ext-pcntl（可选，用于信号处理）

## 架构

### 两阶段工作流

```
阶段 1: 文档生成（开发/发布时）
┌─────────────┐     ┌──────────────────┐     ┌─────────────┐
│  PHP 源代码  │ ──▶ │  PHP-Parser 解析  │ ──▶ │  .mcp/ 目录  │
└─────────────┘     └──────────────────┘     │  (MD 文件)   │
                                              └─────────────┘

阶段 2: MCP 服务（运行时）
┌─────────────┐     ┌──────────────────┐     ┌─────────────┐
│  AI 助手     │ ◀─▶ │   MCP Server     │ ◀── │  .mcp/ 目录  │
└─────────────┘     │  (读取文档)       │     └─────────────┘
                    └──────────────────┘
```

### 核心组件

```
src/
├── Generator/                    # 文档生成器
│   ├── Parser/                   # PHP-Parser 源码解析
│   ├── Renderer/                 # Markdown 渲染
│   ├── Linker/                   # 索引和文档关联
│   └── Config/                   # 生成器配置
├── Server/                       # MCP 服务器
│   ├── McpServer.php             # 主服务器
│   ├── DocumentationReader.php   # 文档读取器
│   └── Transport/                # 传输层
├── Protocol/                     # JSON-RPC 2.0 协议
└── Runtime/                      # 信号处理
```

## 开发

```bash
# 安装依赖
composer install

# 运行测试
composer test

# 代码风格修复
composer cs

# 静态分析
composer psalm
```

## 许可证

MIT License

## 致谢

基于 [Hi Framework](https://github.com/nicholasxjy/hi-framework) 构建。
