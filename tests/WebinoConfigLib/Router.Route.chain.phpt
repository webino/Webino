<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = (new Route(['home', '/'], 'ExampleHandler'))
    ->chain([
        new Route('/part-one'),
        new Route('/part-two'),
    ]);


Assert::same('home', $route->getName());

Assert::equal([
    'type' => 'literal',
    'options' => [
        'route' => '/',
        'defaults' => [
            'handlers' => ['ExampleHandler'],
        ],
    ],
    'chain_routes' => [
        [
            'type' => 'literal',
            'options' => [
                'route' => '/part-one',
                'defaults' => [],
            ],
        ],
        [
            'type' => 'literal',
            'options' => [
                'route' => '/part-two',
                'defaults' => [],
            ],
        ],
    ],
], $route->toArray());
