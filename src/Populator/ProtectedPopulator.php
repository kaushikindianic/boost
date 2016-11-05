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
            if (!$reflectionObject->hasProperty($key)) {
                throw new SerializerException("No such property: `" . $key . '`');
            }
            $p = $reflectionObject->getProperty($key);
            if (!$p->isProtected()) {
                throw new SerializerException("Not a protected property: " . $key);
            }
            $p->setAccessible(true);
            $p->setValue($obj, $value);
        }

    }
}
