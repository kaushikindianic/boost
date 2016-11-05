<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Boost\BoostTrait;
use Boost\Accessors\ProtectedGettersTrait;
use Boost\Accessors\ProtectedSettersTrait;
use Boost\Accessors\ProtectedAccessorsTrait;

class Person
{
    protected $firstname = 'Jack';
    protected $lastname = 'Jackson';
    
    use BoostTrait;
    use ProtectedAccessorsTrait;
}


$person = new Person();
$person->setLastname('Jillson');
echo $person->getFirstname() . "\n";
echo $person->getLastname() . "\n";
