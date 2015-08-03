<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = new Route\Regex('<example>/.*', '%example%');


Assert::null($route->getName());

Assert::equal([
    'type' => 'regex',
    'options' => [
        'regex' => '<example>/.*',
        'spec'  => '%example%',
    ],
], $route->toArray());
