---
module: Kernel
namespaces: [Hi\Kernel, Hi\Kernel\Logger, Hi\Kernel\Logger\Formatter, Hi\Kernel\Composer, Hi\Kernel\Composer\Exception, Hi\Kernel\Exception, Hi\Kernel\Console\Traits, Hi\Kernel\Console, Hi\Kernel\Console\Loader, Hi\Kernel\Console\Command, Hi\Kernel\Console\Exception, Hi\Kernel\Console\Metadata, Hi\Kernel\Reflection, Hi\Kernel\Reflection\Carrier, Hi\Kernel\Reflection\Exception]
class_count: 42
interface_count: 16
trait_count: 2
enum_count: 1
attribute_count: 0
---
# Kernel 模块

框架内核、容器、服务管理

## 概览

- 类: 42
- 接口: 16
- Traits: 2
- 枚举: 1
- Attributes: 0

## 使用指南

- [Kernel 内核](../guides/components/kernel.md)
- [应用生命周期](../guides/kernel/lifecycle.md)
- [命令行应用](../guides/kernel/commands.md)
- [启动引导](../guides/kernel/bootstrap.md)
- [核心服务](../guides/kernel/services.md)

## 核心概念

- [生命周期](../guides/concepts/lifecycle.md)
- [作用域(Scope)](../guides/concepts/scope.md)
- [服务容器](../guides/concepts/container-and-di.md)
- [注解](../guides/concepts/attributes.md)
- [运行时系统](../guides/concepts/runtime.md)

## API 参考

### 接口

| 名称 | 描述 |
| --- | --- |
| [`EnvironmentInterface`](../api/interfaces/Hi.Kernel.EnvironmentInterface.md) | App running environment Must implement the interface through an enum |
| [`LoggerFactoryInterface`](../api/interfaces/Hi.Kernel.Logger.LoggerFactoryInterface.md) |  |
| [`MetricCollectorInterface`](../api/interfaces/Hi.Kernel.MetricCollectorInterface.md) |  |
| [`ConfigInterface`](../api/interfaces/Hi.Kernel.ConfigInterface.md) |  |
| [`ConsoleInterface`](../api/interfaces/Hi.Kernel.ConsoleInterface.md) |  |
| [`ComposerExtraReaderInterface`](../api/interfaces/Hi.Kernel.Composer.ComposerExtraReaderInterface.md) | Interface for reading composer installed packages and accessing package "extra" data. |
| [`AwesomeLoaderInterface`](../api/interfaces/Hi.Kernel.AwesomeLoaderInterface.md) |  |
| [`KernelInterface`](../api/interfaces/Hi.Kernel.KernelInterface.md) |  |
| [`DirectoriesInterface`](../api/interfaces/Hi.Kernel.DirectoriesInterface.md) |  |
| [`OutputInterface`](../api/interfaces/Hi.Kernel.Console.OutputInterface.md) |  |
| [`DispatcherInterface`](../api/interfaces/Hi.Kernel.Console.DispatcherInterface.md) |  |
| [`CommandLoaderInterface`](../api/interfaces/Hi.Kernel.Console.CommandLoaderInterface.md) | Command loader interface |
| [`CommandMetadataManagerInterface`](../api/interfaces/Hi.Kernel.Console.CommandMetadataManagerInterface.md) | Command metadata manager interface |
| [`InputInterface`](../api/interfaces/Hi.Kernel.Console.InputInterface.md) |  |
| [`AttributeLoaderInterface`](../api/interfaces/Hi.Kernel.Reflection.AttributeLoaderInterface.md) |  |
| [`CarrierInterface`](../api/interfaces/Hi.Kernel.Reflection.Carrier.CarrierInterface.md) |  |

### 类

| 名称 | 描述 |
| --- | --- |
| [`LoggerFactory`](../api/classes/Hi.Kernel.Logger.LoggerFactory.md) |  |
| [`ConsoleFormatter`](../api/classes/Hi.Kernel.Logger.Formatter.ConsoleFormatter.md) |  |
| [`Directories`](../api/classes/Hi.Kernel.Directories.md) |  |
| [`ComposerExtraReader`](../api/classes/Hi.Kernel.Composer.ComposerExtraReader.md) |  |
| [`ComposerReaderException`](../api/classes/Hi.Kernel.Composer.Exception.ComposerReaderException.md) |  |
| [`AbstractPackageScanner`](../api/classes/Hi.Kernel.Composer.AbstractPackageScanner.md) | Abstract package scanner for discovering components in Composer packages |
| [`Config`](../api/classes/Hi.Kernel.Config.md) |  |
| [`Console`](../api/classes/Hi.Kernel.Console.md) | Console Command Executor |
| [`RunningStatus`](../api/classes/Hi.Kernel.RunningStatus.md) |  |
| [`ConfigModifiedException`](../api/classes/Hi.Kernel.Exception.ConfigModifiedException.md) |  |
| [`DirectoryException`](../api/classes/Hi.Kernel.Exception.DirectoryException.md) |  |
| [`KernelException`](../api/classes/Hi.Kernel.Exception.KernelException.md) |  |
| [`ConfigKeyNotFoundException`](../api/classes/Hi.Kernel.Exception.ConfigKeyNotFoundException.md) |  |
| [`Dispatcher`](../api/classes/Hi.Kernel.Console.Dispatcher.md) |  |
| [`ProgressBar`](../api/classes/Hi.Kernel.Console.ProgressBar.md) | Advanced progress bar component with multiple display formats |
| [`CommandMetadataManager`](../api/classes/Hi.Kernel.Console.CommandMetadataManager.md) | Command metadata manager |
| [`StatusDisplay`](../api/classes/Hi.Kernel.Console.StatusDisplay.md) | Status display component for showing real-time status information |
| [`ExitCode`](../api/classes/Hi.Kernel.Console.ExitCode.md) |  |
| [`ArgumentsParser`](../api/classes/Hi.Kernel.Console.ArgumentsParser.md) | Console input arguments parser. |
| [`DefaultCommandLoader`](../api/classes/Hi.Kernel.Console.Loader.DefaultCommandLoader.md) |  |
| [`ComposerCommandLoader`](../api/classes/Hi.Kernel.Console.Loader.ComposerCommandLoader.md) | Load Hi-Framework specific commands from composer packages |
| [`Output`](../api/classes/Hi.Kernel.Console.Output.md) |  |
| [`Input`](../api/classes/Hi.Kernel.Console.Input.md) |  |
| [`HelpCommand`](../api/classes/Hi.Kernel.Console.Command.HelpCommand.md) |  |
| [`AbstractCommand`](../api/classes/Hi.Kernel.Console.Command.AbstractCommand.md) |  |
| [`InvalidCommandMetadataException`](../api/classes/Hi.Kernel.Console.Exception.InvalidCommandMetadataException.md) |  |
| [`ComposerCommandLoaderException`](../api/classes/Hi.Kernel.Console.Exception.ComposerCommandLoaderException.md) |  |
| [`ConsoleException`](../api/classes/Hi.Kernel.Console.Exception.ConsoleException.md) |  |
| [`OptionMetadata`](../api/classes/Hi.Kernel.Console.Metadata.OptionMetadata.md) | Option metadata class |
| [`ActionMetadata`](../api/classes/Hi.Kernel.Console.Metadata.ActionMetadata.md) | Action metadata class |
| [`CommandMetadata`](../api/classes/Hi.Kernel.Console.Metadata.CommandMetadata.md) | Command metadata class |
| [`ProgressHelper`](../api/classes/Hi.Kernel.Console.ProgressHelper.md) | Helper class for creating and managing progress bars and status displays |
| [`MultiStepProgress`](../api/classes/Hi.Kernel.Console.MultiStepProgress.md) | Multi-step progress display |
| [`AttributeLoader`](../api/classes/Hi.Kernel.Reflection.AttributeLoader.md) | Generic attribute loader that uses generators for efficient memory usage |
| [`AttributeFileScanner`](../api/classes/Hi.Kernel.Reflection.AttributeFileScanner.md) | Scans directories and files for PHP files that may contain attributes |
| [`ReflectionFile`](../api/classes/Hi.Kernel.Reflection.ReflectionFile.md) | File reflections can fetch information about classes |
| [`ClassAttributeCarrier`](../api/classes/Hi.Kernel.Reflection.Carrier.ClassAttributeCarrier.md) |  |
| [`PropertyAttributeCarrier`](../api/classes/Hi.Kernel.Reflection.Carrier.PropertyAttributeCarrier.md) |  |
| [`MethodAttributeCarrier`](../api/classes/Hi.Kernel.Reflection.Carrier.MethodAttributeCarrier.md) |  |
| [`AttributeLoaderException`](../api/classes/Hi.Kernel.Reflection.Exception.AttributeLoaderException.md) |  |
| [`PHPFileNotExistsException`](../api/classes/Hi.Kernel.Reflection.Exception.PHPFileNotExistsException.md) |  |
| [`ReflectionException`](../api/classes/Hi.Kernel.Reflection.Exception.ReflectionException.md) |  |

### Traits

| 名称 | 描述 |
| --- | --- |
| [`CommndListTrait`](../api/traits/Hi.Kernel.Console.Traits.CommndListTrait.md) |  |
| [`DisplayTrait`](../api/traits/Hi.Kernel.Console.Traits.DisplayTrait.md) |  |

### 枚举

| 名称 | 描述 |
| --- | --- |
| [`AppEnvironment`](../api/enums/Hi.Kernel.AppEnvironment.md) |  |

