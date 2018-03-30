<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = (new Route('/'))
    ->setName('home')
    ->chain([
        new Route('/part-one'),
        new Route('/part-two'),
    ]);


Assert::same('home', $route->getName());

Assert::equal([
    'type' => 'literal',
    'options' => [
        'route' => '/',
    ],
    'chain_routes' => [
        [
            'type' => 'literal',
            'options' => [
                'route' => '/part-one',
            ],
        ],
        [
            'type' => 'literal',
            'options' => [
                'route' => '/part-two',
            ],
        ],
    ],
], $route->toArray());
