<?php

namespace Boost;

use ReflectionClass;
use Boost\Exception\NoSuchMethodException;

trait BoostTrait
{
    public function __call($name, $args)
    {
        $reflectionClass = new ReflectionClass(self::class);
        $methods = $reflectionClass->getMethods();
        foreach ($methods as $method) {
            $methodName = $method->getName();
            if ((substr($methodName, 0, 6)=='__call') && (strlen($methodName)>6)) {
                $hasMethodName = '__has' . substr($methodName, 6);
                if ($this->$hasMethodName($name, $args)) {
                    $res = $this->$methodName($name, $args);
                    return $res;
                }
            }
        }
        trigger_error(
            'Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR
        );
    }
}
