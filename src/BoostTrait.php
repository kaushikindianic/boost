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
                try {
                    $res = $this->$methodName($name, $args);
                    return $res;
                } catch (NoSuchMethodException $e) {
                    // nothing, try next method or fail
                }
            }
        }
        throw new NoSuchMethodException($name);
    }
}
