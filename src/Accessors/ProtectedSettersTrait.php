<?php

namespace Boost\Accessors;

use ReflectionObject;

trait ProtectedSettersTrait
{
    public function __hasProtectedSetters($name, $args)
    {
        if (substr($name, 0, 3) != 'set') {
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

    public function __callProtectedSetters($name, $args)
    {
        if (!$this->__hasProtectedSetters($name, $args)) {
            trigger_error(
                'Call to undefined method '.__CLASS__.'::'.$name.'()', E_USER_ERROR
            );
        }
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
    }
}
