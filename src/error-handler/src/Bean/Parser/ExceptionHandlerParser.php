<?php

namespace Swoft\ErrorHandler\Bean\Parser;

use Swoft\Bean\Annotation\Scope;
use Swoft\Bean\Parser\AbstractParser;
use Swoft\ErrorHandler\Bean\Annotation\ExceptionHandler;
use Swoft\ErrorHandler\Bean\Collector\ExceptionHandlerCollector;

/**
 * Class ExceptionHandlerParser
 *
 * @package Swoft\Bean\Parser
 */
class ExceptionHandlerParser extends AbstractParser
{
    /**
     * @param string $className
     * @param ExceptionHandler $objectAnnotation
     * @param string $propertyName
     * @param string $methodName
     * @param null $propertyValue
     * @return array
     */
    public function parser(
        string $className,
        $objectAnnotation = null,
        string $propertyName = '',
        string $methodName = '',
        $propertyValue = null
    ): array {
        ExceptionHandlerCollector::collect($className, $objectAnnotation, $propertyName, $methodName, $propertyValue);

        return [$className, Scope::SINGLETON, ''];
    }
}