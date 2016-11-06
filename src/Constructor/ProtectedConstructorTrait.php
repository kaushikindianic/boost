<?php

namespace Boost\Constructor;

trait ProtectedConstructorTrait
{
    public function __construct()
    {
        $i = 0;
        $vars = get_object_vars($this);
        $args = func_get_args();
        foreach ($vars as $key => $value) {
            if ($i<count($args)) {
                $this->$key = func_get_arg($i);
                $i++;
            }
        }
    }
}
