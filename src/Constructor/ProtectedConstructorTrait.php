<?php

namespace Boost\Constructor;

trait ProtectedConstructorTrait
{
    public function __construct()
    {
        $i = 0;
        foreach (get_object_vars($this) as $key => $value) {
            $this->$key = func_get_arg($i);
            $i++;
        }
    }
}
