<?php

namespace Boost\Populator;

use ReflectionClass;
use ReflectionObject;
use Boost\Exception\SerializerException;

class ProtectedPopulator
{
    public function populate($obj, $data)
    {
        $reflectionObject = new ReflectionObject($obj);
        foreach ($data as $key => $value) {
            // simple conversion from snake case to all-lowercase
            // this works because has and getProperty are both case insensitive
            $name = str_replace('_', '', $key);
            
            if ($reflectionObject->hasProperty($name)) {
                $p = $reflectionObject->getProperty($name);
                if ($p->isProtected()) {
                    $p->setAccessible(true);
                    $p->setValue($obj, $value);
                }
            }
        }
    }
}
