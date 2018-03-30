<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = (new Route('/'))
    ->setName('home')
    ->setChild([
        (new Route('/about'))
            ->setName('about'),

        new Route('/page-two'),

        (new Route('/page-three'))
            ->setChild([
                new Route('/sub-page-one'),
            ]),
    ]);


Assert::same('home', $route->getName());

Assert::equal([
    'type' => 'literal',
    'options' => [
        'route' => '/',
    ],
    'child_routes' => [
        'about' => [
            'type' => 'literal',
            'options' => [
                'route' => '/about',
            ],
        ],
        [
            'type' => 'literal',
            'options' => [
                'route' => '/page-two',
            ],
        ],
        [
            'type' => 'literal',
            'options' => [
                'route' => '/page-three',
            ],
            'child_routes' => [
                [
                    'type' => 'literal',
                    'options' => [
                        'route' => '/sub-page-one',
                    ],
                ],
            ],
        ],
    ],
], $route->toArray());
