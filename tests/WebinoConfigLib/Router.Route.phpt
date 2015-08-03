<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route[0] = new Route('/');

$route[1] = (new Route('/example-route'))
    ->setName('example-route')
    ->setType(Route::SEGMENT)
    ->setMayTerminate()
    ->setDefaults(['testParam' => 'testParamValue']);


Assert::null($route[0]->getName());

Assert::same('example-route', $route[1]->getName());

Assert::equal([
    'type' => 'literal',
    'options' => [
        'route' => '/',
    ],
], $route[0]->toArray());

Assert::equal([
    'type' => 'segment',
    'options' => [
        'route' => '/example-route',
        'defaults' => [
            'testParam' => 'testParamValue',
        ],
    ],
    'may_terminate' => true,
], $route[1]->toArray());
