<?php

use Tester\Assert;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../bootstrap.php';


$route = (new Route\Console('example command', 'ExampleConsoleHandler'));


Assert::equal([
    'console' => [
        'router' => [
            'routes' => [
                [
                    'type' => 'simple',
                    'options' => [
                        'route' => 'example command',
                        'defaults' => [
                            'handlers' => ['ExampleConsoleHandler'],
                        ],
                    ],
                ]
            ],
        ],
    ],
], $route->toArray());
