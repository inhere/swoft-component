<?php

namespace Swoft\Http\Server\Bean\Collector;

use Swoft\Bean\CollectorInterface;
use Swoft\Http\Server\Bean\Annotation\Controller;
use Swoft\Http\Server\Bean\Annotation\RequestMapping;
use Swoft\Http\Server\Bean\Annotation\RequestMethod;

/**
 * the collector of controller
 *
 * Class ControllerCollector
 */
class ControllerCollector implements CollectorInterface
{
    /**
     * @var array
     */
    private static $requestMapping = [];

    /**
     * @param string $className
     * @param object $objectAnnotation
     * @param string $propertyName
     * @param string $methodName
     * @param null   $propertyValue
     */
    public static function collect(
        string $className,
        $objectAnnotation = null,
        string $propertyName = '',
        string $methodName = '',
        $propertyValue = null
    ) {
        if ($objectAnnotation instanceof Controller) {
            $prefix = $objectAnnotation->getPrefix();
            self::$requestMapping[$className]['prefix'] = $prefix;
            return;
        }

        if ($objectAnnotation instanceof RequestMapping) {
            $route = $objectAnnotation->getRoute();
            $httpMethod = $objectAnnotation->getMethod();
            self::$requestMapping[$className]['routes'][] = [
                'route'  => $route,
                'method' => $httpMethod,
                'action' => $methodName,
                'params' => $objectAnnotation->getParams(),
            ];
            return;
        }

        if ($objectAnnotation === null && isset(self::$requestMapping[$className])) {
            self::$requestMapping[$className]['routes'][] = [
                'route'  => '',
                'method' => [RequestMethod::GET, RequestMethod::POST],
                'action' => $methodName,
            ];
            return;
        }
    }

    /**
     * @return array
     */
    public static function getCollector(): array
    {
        return self::$requestMapping;
    }

}
