<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


// Basic

$route = new Route('/', 'ExampleHandler');

Assert::same('', $route->getName());

Assert::equal([
    'type' => 'literal',
    'options' => [
        'route' => '/',
        'defaults' => [
            'handlers' => ['ExampleHandler'],
        ],
    ],
], $route->toArray());


// Advanced

$route = (new Route('/', 'ExampleHandler'))
    ->setType('segment')
    ->setMayTerminate()
    ->setDefaults(['testParam' => 'testParamValue']);

Assert::same('', $route->getName());

Assert::equal([
    'type' => 'segment',
    'options' => [
        'route' => '/',
        'defaults' => [
            'testParam' => 'testParamValue',
            'handlers' => ['ExampleHandler'],
        ],
    ],
    'may_terminate' => true,
], $route->toArray());
