<?php

use Tester\Assert;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Factory;

class MyTestEventListener
{
    public static $invoked = false;

    public function __invoke()
    {
        static::$invoked = true;
    }
}


require __DIR__ . '/../bootstrap.php';

$app = (new Factory)->create()->bootstrap();


$app->bind(AppEvent::DISPATCH, MyTestEventListener::class);

$app->dispatch();


Assert::true(MyTestEventListener::$invoked);
