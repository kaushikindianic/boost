<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Boost\Serializer\ProtectedSerializer;

class Person
{
    protected $firstname;
    protected $lastname;
    
    public function __construct($firstname, $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }
}


$person = new Person('Jack', 'Jackson');

$serializer = new ProtectedSerializer();
$data = $serializer->serialize($person);
print_r($data);

$p = $serializer->deserialize(Person::class, ['firstname' => 'Alice']);
print_r($p);
