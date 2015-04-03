<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = new Route(['home', '/'], 'ExampleHandler');


Assert::same('home', $route->getName());

Assert::equal([
    'type' => 'literal',
    'options' => [
        'route' => '/',
        'defaults' => [
            'handlers' => ['ExampleHandler'],
        ],
    ],
], $route->toArray());
