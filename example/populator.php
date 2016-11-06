<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Boost\Constructor\ProtectedConstructorTrait;
class Person
{
    protected $firstname;
    protected $lastname;
    
    use ProtectedConstructorTrait;
    
    public function helloWorld()
    {
        return "Hello world from " . trim($this->firstname . ' ' . $this->lastname);
    }
}


$person = new Person('Jim');
$populator = new \Boost\Populator\ProtectedPopulator();
echo $person->helloWorld() . "\n";


$populator->populate($person, ['firstname' => 'John', 'lastname' => 'Johnson']);

echo $person->helloWorld() . "\n";
