---
# https://vitepress.dev/reference/default-theme-home-page
layout: home

hero:
  name: "Hi Framework"
  text: "简单 轻快 云原生"
  # tagline: "基于 PSR 标准构建的企业级 PHP 框架，专注于类型安全、云原生与性能而打造。"
  actions:
    - theme: brand
      text: 什么是 Hi Framework
      link: /overview
    - theme: alt
      text: 快速开始
      link: /getting-started

features:
  - title: 📦 PSR 标准
    details: 完全遵循 PSR 标准，与 PHP 生态系统无缝集成
  - title: 🔒 类型安全
    details: 全面采用 PHP 8+ 的类型系统，提供编译期类型检查，减少运行时错误
  - title: ⚡ 云原生
    details: 内置容器化支持、配置管理、健康检查，完美适配 Kubernetes 和微服务架构
  - title: 🏗️ 模块化设计
    details: 松耦合的组件设计，可按需选择和组合
  - title: 🔄 兼容多运行时
    details: 支持在 PHP-FPM、Swoole/Swow、Workerman 和 ReactPHP 等运行时
  - title: 🛠️ 开发友好
    details: 丰富的开发工具、详细的文档、完善的测试套件
---