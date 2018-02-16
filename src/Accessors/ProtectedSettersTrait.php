<?php

namespace Boost\Accessors;

use ReflectionObject;

trait ProtectedSettersTrait
{
    public function __callSetters($name, $args)
    {
        if (substr($name, 0, 3) == 'set') {
            $name = lcfirst(substr($name, 3));
            
            $vars = get_object_vars($this);
            $reflectionObject = new ReflectionObject($this);
            if ($reflectionObject->hasProperty($name)) {
                $p = $reflectionObject->getProperty($name);
                if ($p->isProtected()) {
                    $p->setAccessible(true);
                    $p->setValue($this, $args[0]);
                }
                return $this;
            }
        }
        trigger_error('Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR);
    }
}
