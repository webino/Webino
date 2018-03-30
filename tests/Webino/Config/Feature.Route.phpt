<?php

use Tester\Assert;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../bootstrap.php';


$route[0] = (new Route)
    ->setType(Route::SEGMENT)
    ->setPath('/')
    ->setMayTerminate()
    ->setDefaults(['exampleKey' => 'exampleValue'])
    ->setChild([
        (new Route('child-one'))
            ->setPath('/child-one'),

        (new Route)
            ->setPath('/child-two'),

        (new Route)
            ->setPath('/child-three'),
    ])
    ->chain([
        (new Route)
            ->setPath('/part-one'),

        (new Route)
            ->setPath('/part-two'),
    ]);


Assert::equal(require __DIR__ . '/files/feature.route.expectedConfig.php', $route[0]->toArray());
