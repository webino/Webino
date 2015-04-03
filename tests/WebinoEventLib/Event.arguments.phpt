<?php

use Tester\Assert;
use WebinoEventLib\AbstractListener;
use WebinoEventLib\EventManager;
use WebinoEventLib\Event;

require __DIR__ . '/../bootstrap.php';


class CustomArgumentOne
{

}

class CustomArgumentTwo
{

}

class CustomEventListener extends AbstractListener
{
    /**
     * @var bool
     */
    public $isTriggered;

    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen('testEvent', 'onEvent');
    }


    public function onEvent(
        /** @noinspection PhpUnusedParameterInspection */
        Event $event,
        CustomArgumentOne $argOne,
        CustomArgumentTwo $argTwo
    ) {
        $this->isTriggered = true;
    }
}


$events = new EventManager;


// Test argument unpacking support
$isTriggered = false;
/** @noinspection PhpUnusedParameterInspection */
$events->attach('testEvent', function (
    Event $event,
    CustomArgumentOne $argOne,
    CustomArgumentTwo $argTwo
) use (&$isTriggered) {
    $isTriggered = true;
});

$listener = new CustomEventListener;
$events->attach($listener);

$events->trigger('testEvent', null, [new CustomArgumentOne, new CustomArgumentTwo]);


Assert::true($isTriggered);
Assert::true($listener->isTriggered);
