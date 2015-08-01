<?php

use Tester\Assert;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../bootstrap.php';


$route = (new Route('/', 'ExampleHandler'))
    ->setType('segment')
    ->setMayTerminate()
    ->setDefaults(['exampleKey' => 'exampleValue'])
    ->setChild(new Route('/child-one', 'ExampleChildOneHandler'))
    ->setChildren([
        new Route('/child-two', 'ExampleChildTwoHandler'),
        new Route('/child-three', 'ExampleChildThreeHandler'),
    ])
    ->chain([
        new Route('/part-one', 'ExamplePartOneHandler'),
        new Route('/part-two', 'ExamplePartTwoHandler'),
    ]);


Assert::equal(require __DIR__ . '/files/feature.route.expectedConfig.php', $route->toArray());
