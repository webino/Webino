<?php

use Tester\Assert;
use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Factory;

require __DIR__ . '/../bootstrap.php';


class MyTestEventListener
{
    public static $invoked = false;

    public function __invoke()
    {
        static::$invoked = true;
    }
}

class MyTestCustomEventListener extends MyTestEventListener
{
    public static $invoked = false;
}


$app = (new Factory)->create()->bootstrap();


$app->bind(AppEvent::DISPATCH, MyTestEventListener::class);

$app->bind('myEvent', MyTestCustomEventListener::class);

$app->emit('myEvent');

$app->dispatch();


Assert::true(MyTestEventListener::$invoked);

Assert::true(MyTestCustomEventListener::$invoked);
