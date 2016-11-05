<?php

namespace Boost\Serializer;

use Boost\Populator\ProtectedPopulator;
use ReflectionClass;
use ReflectionObject;

class ProtectedSerializer
{
    public function serialize($obj)
    {
        $data = [];
        $reflectionObject = new ReflectionObject($obj);
        
        foreach ($reflectionObject->getProperties() as $p) {
            if ($p->isProtected()) {
                $p->setAccessible(true);
                // TODO: Sanity check if value is int/string/etc. If it's an object: recurse or fail?
                $data[(string)$p->getName()] = (string)$p->getValue($obj);
            }
        }
        return $data;
    }
    
    public function deserialize($className, $data)
    {
        $reflectionClass = new ReflectionClass($className);
        $obj = $reflectionClass->newInstanceWithoutConstructor();
        $populator = new ProtectedPopulator();
        $populator->populate($obj, $data);
        return $obj;
    }
}
