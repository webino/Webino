<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = new Route\Regex('<example>/.*', '%example%', 'ExampleHandler');


Assert::same('', $route->getName());

Assert::equal([
    'type' => 'regex',
    'options' => [
        'regex' => '<example>/.*',
        'spec' => '%example%',
        'defaults' => [
            'handlers' => ['ExampleHandler'],
        ],
    ],
], $route->toArray());
