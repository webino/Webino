<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route = new Route\Console('example command');


Assert::null($route->getName());

Assert::equal([
    'type' => 'simple',
    'options' => [
        'route' => 'example command',
    ],
], $route->toArray());
