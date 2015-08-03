<?php

use Tester\Assert;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../bootstrap.php';


$route[0] = (new Route)
    ->setType(Route::SEGMENT)
    ->setRoute('/')
    ->setMayTerminate()
    ->setDefaults(['exampleKey' => 'exampleValue'])
    ->setChild([
        (new Route('child-one'))
            ->setRoute('/child-one'),

        (new Route)
            ->setRoute('/child-two'),

        (new Route)
            ->setRoute('/child-three'),
    ])
    ->chain([
        (new Route)
            ->setRoute('/part-one'),

        (new Route)
            ->setRoute('/part-two'),
    ]);


Assert::equal(require __DIR__ . '/files/feature.route.expectedConfig.php', $route[0]->toArray());
