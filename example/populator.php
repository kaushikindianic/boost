<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Boost\Constructor\ProtectedConstructorTrait;
class Person
{
    protected $firstName;
    protected $lastName;
    
    use ProtectedConstructorTrait;
    
    public function helloWorld()
    {
        return "Hello world from " . trim($this->firstName . ' ' . $this->lastName);
    }
}


$person = new Person('Jim');
$populator = new \Boost\Populator\ProtectedPopulator();
echo $person->helloWorld() . "\n";


$populator->populate($person, ['first_name' => 'John', 'lastName' => 'Johnson']);

echo $person->helloWorld() . "\n";
