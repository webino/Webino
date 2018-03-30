<?php

use Tester\Assert;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../bootstrap.php';


$route[0] = (new Route\ConsoleRoute)
    ->setPath('example command');


Assert::equal([
    'console' => [
        'router' => [
            'routes' => [
                [
                    'type' => 'simple',
                    'options' => [
                        'route' => 'example command',
                    ],
                ]
            ],
        ],
    ],
], $route[0]->toArray());
