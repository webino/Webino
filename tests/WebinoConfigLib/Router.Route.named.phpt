<?php

use Tester\Assert;
use WebinoConfigLib\Router\Route;

require __DIR__ . '/../bootstrap.php';


$route[0] = (new Route('/'))
    ->setName('home');


Assert::same('home', $route[0]->getName());

Assert::equal([
    'type' => 'literal',
    'options' => [
        'route' => '/',
    ],
], $route[0]->toArray());
