<?php

declare(strict_types=1);

namespace Hi\MCP\Generator\Parser;

/**
 * 类信息提取器
 *
 * 整合 AST 解析和 DocBlock 解析，生成完整的类信息
 */
final class ClassInfoExtractor
{
    public function __construct(
        private readonly DocBlockParser $docParser = new DocBlockParser,
    ) {
    }

    /**
     * 增强类信息，添加文档解析结果
     */
    public function enhance(array $classInfo): array
    {
        // 解析类的文档块
        $classDoc = $this->docParser->parse($classInfo['docComment'] ?? '');
        $classInfo['summary'] = $classDoc['summary'];
        $classInfo['description'] = $classDoc['description'];
        $classInfo['docTags'] = $classDoc['tags'];

        // 检查是否是 Attribute
        $classInfo['isAttribute'] = $this->isAttribute($classInfo);
        if ($classInfo['isAttribute']) {
            $classInfo['attributeTargets'] = $this->extractAttributeTargets($classInfo);
            $classInfo['isRepeatable'] = $this->isRepeatableAttribute($classInfo);
        }

        // 增强常量信息
        $classInfo['constants'] = array_map(
            fn ($const) => $this->enhanceConstant($const),
            $classInfo['constants'] ?? []
        );

        // 增强属性信息
        $classInfo['properties'] = array_map(
            fn ($prop) => $this->enhanceProperty($prop),
            $classInfo['properties'] ?? []
        );

        // 增强方法信息
        $classInfo['methods'] = array_map(
            fn ($method) => $this->enhanceMethod($method),
            $classInfo['methods'] ?? []
        );

        // 移除原始 docComment（已解析）
        unset($classInfo['docComment']);

        return $classInfo;
    }

    /**
     * 检查是否是 Attribute
     */
    private function isAttribute(array $classInfo): bool
    {
        foreach ($classInfo['attributes'] ?? [] as $attr) {
            $name = ltrim($attr['name'], '\\');
            if ('Attribute' === $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * 提取 Attribute 的目标类型
     */
    private function extractAttributeTargets(array $classInfo): array
    {
        $targets = [];

        foreach ($classInfo['attributes'] ?? [] as $attr) {
            $name = ltrim($attr['name'], '\\');
            if ('Attribute' === $name) {
                $flags = $attr['arguments'][0] ?? $attr['arguments']['flags'] ?? \Attribute::TARGET_ALL;

                if (is_int($flags)) {
                    if ($flags & \Attribute::TARGET_CLASS) {
                        $targets[] = 'CLASS';
                    }
                    if ($flags & \Attribute::TARGET_METHOD) {
                        $targets[] = 'METHOD';
                    }
                    if ($flags & \Attribute::TARGET_PROPERTY) {
                        $targets[] = 'PROPERTY';
                    }
                    if ($flags & \Attribute::TARGET_PARAMETER) {
                        $targets[] = 'PARAMETER';
                    }
                    if ($flags & \Attribute::TARGET_FUNCTION) {
                        $targets[] = 'FUNCTION';
                    }
                    if ($flags & \Attribute::TARGET_CLASS_CONSTANT) {
                        $targets[] = 'CLASS_CONSTANT';
                    }

                    if (empty($targets) && \Attribute::TARGET_ALL === $flags) {
                        $targets = ['ALL'];
                    }
                }
            }
        }

        return $targets ?: ['ALL'];
    }

    /**
     * 检查是否是可重复 Attribute
     */
    private function isRepeatableAttribute(array $classInfo): bool
    {
        foreach ($classInfo['attributes'] ?? [] as $attr) {
            $name = ltrim($attr['name'], '\\');
            if ('Attribute' === $name) {
                $flags = $attr['arguments'][0] ?? $attr['arguments']['flags'] ?? 0;

                if (is_int($flags) && ($flags & \Attribute::IS_REPEATABLE)) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * 增强常量信息
     */
    private function enhanceConstant(array $const): array
    {
        $doc = $this->docParser->parse($const['docComment'] ?? '');
        $const['summary'] = $doc['summary'];
        $const['description'] = $doc['description'];
        unset($const['docComment']);

        return $const;
    }

    /**
     * 增强属性信息
     */
    private function enhanceProperty(array $prop): array
    {
        $doc = $this->docParser->parse($prop['docComment'] ?? '');
        $prop['summary'] = $doc['summary'];
        $prop['description'] = $doc['description'];

        // 如果有 @var 标签，可能包含更详细的类型信息
        if (isset($doc['tags']['var'][0])) {
            $varParts = preg_split('/\s+/', $doc['tags']['var'][0], 2);
            if (false !== $varParts && ! empty($varParts[0])) {
                $prop['typeFromDoc'] = $varParts[0];
            }
        }

        unset($prop['docComment']);

        return $prop;
    }

    /**
     * 增强方法信息
     */
    private function enhanceMethod(array $method): array
    {
        $doc = $this->docParser->parse($method['docComment'] ?? '');
        $method['summary'] = $doc['summary'];
        $method['description'] = $doc['description'];

        // 解析参数文档
        $paramDocs = [];
        if (isset($doc['tags']['param'])) {
            foreach ($doc['tags']['param'] as $paramTag) {
                $parsed = $this->docParser->parseParamTag($paramTag);
                if ($parsed) {
                    $paramDocs[$parsed['name']] = $parsed;
                }
            }
        }

        // 增强参数信息
        $method['parameters'] = array_map(
            function ($param) use ($paramDocs) {
                $doc = $paramDocs[$param['name']] ?? [];
                $param['typeFromDoc'] = $doc['type'] ?? null;
                $param['description'] = $doc['description'] ?? '';

                return $param;
            },
            $method['parameters'] ?? []
        );

        // 解析返回值文档
        if (isset($doc['tags']['return'][0])) {
            $returnDoc = $this->docParser->parseReturnTag($doc['tags']['return'][0]);
            $method['returnTypeFromDoc'] = $returnDoc['type'];
            $method['returnDescription'] = $returnDoc['description'];
        } else {
            $method['returnTypeFromDoc'] = null;
            $method['returnDescription'] = '';
        }

        // 解析异常文档
        $method['throws'] = [];
        if (isset($doc['tags']['throws'])) {
            foreach ($doc['tags']['throws'] as $throwsTag) {
                $method['throws'][] = $this->docParser->parseThrowsTag($throwsTag);
            }
        }

        // 提取其他有用的标签
        $method['deprecated'] = isset($doc['tags']['deprecated']);
        $method['deprecatedReason'] = $doc['tags']['deprecated'][0] ?? '';

        unset($method['docComment']);

        return $method;
    }
}
