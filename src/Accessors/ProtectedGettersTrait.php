<?php

namespace Boost\Accessors;

use ReflectionObject;

trait ProtectedGettersTrait
{
    public function __hasProtectedGetters($name, $args)
    {
        if (substr($name, 0, 3) != 'get') {
            return false;
        }

        if (substr($name, 3, 1)!=strtoupper(substr($name, 3, 1))) {
            return false;
        }
        $name = lcfirst(substr($name, 3));

        $vars = get_object_vars($this);
        $reflectionObject = new ReflectionObject($this);
        if (!$reflectionObject->hasProperty($name)) {
            return false;
        }
        $p = $reflectionObject->getProperty($name);
        if (!$p->isProtected()) {
            return false;
        }
        return true;
    }

    public function __callProtectedGetters($name, $args)
    {
        if (!$this->__hasProtectedGetters($name, $args)) {
            trigger_error(
                'Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR
            );
        }

        $name = lcfirst(substr($name, 3));

        $vars = get_object_vars($this);
        $reflectionObject = new ReflectionObject($this);

        $p = $reflectionObject->getProperty($name);
        if ($p->isProtected()) {
            $p->setAccessible(true);
            return $p->getValue($this);
        }
    }
}
