<?php

require_once __DIR__ . '/../vendor/autoload.php';

class Person
{
    protected $firstname;
    protected $lastname;
    
    public function helloWorld()
    {
        return "Hello world from " . trim($this->firstname . ' ' . $this->lastname);
    }
}


$person = new Person();
$populator = new \Boost\Populator\ProtectedPopulator();

$populator->populate($person, ['firstname' => 'John', 'lastname' => 'Johnson']);

echo $person->helloWorld() . "\n";
