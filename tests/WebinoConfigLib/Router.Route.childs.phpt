<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = (new Route(['home', '/'], 'ExampleHandler'))
    ->setChild(new Route(['about', '/about'], 'ExampleAboutHandler'))
    ->setChilds([
        new Route('/page-two'),
        (new Route('/page-three'))
            ->setChild(new Route('/sub-page-one')),
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
    'child_routes' => [
        'about' => [
            'type' => 'literal',
            'options' => [
                'route' => '/about',
                'defaults' => [
                    'handlers' => ['ExampleAboutHandler'],
                ],
            ],
        ],
        [
            'type' => 'literal',
            'options' => [
                'route' => '/page-two',
                'defaults' => [],
            ],
        ],
        [
            'type' => 'literal',
            'options' => [
                'route' => '/page-three',
                'defaults' => [],
            ],
            'child_routes' => [
                [
                    'type' => 'literal',
                    'options' => [
                        'route' => '/sub-page-one',
                        'defaults' => [],
                    ],
                ],
            ],
        ],
    ],
], $route->toArray());
