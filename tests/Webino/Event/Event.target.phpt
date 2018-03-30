<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Tester\Assert;
use Webino\Event\AbstractEventHandler;
use Webino\Event\Event;
use Webino\Event\EventEmitterAwareTrait;
use Webino\Event\EventTargetInterface;
use Webino\Event\EventTargetTrait;

require __DIR__ . '/../../bootstrap.php';


/** @noinspection PhpUndefinedClassInspection */
class TestEvent extends Event
{

}

/** @noinspection PhpUndefinedClassInspection */
class TestEventTarget implements EventTargetInterface
{
    use EventEmitterAwareTrait;
    use EventTargetTrait;

    public function doA() : void
    {
        $this->emit('event', ['argOne', 'argTwo']);
    }

    public function doB() : void
    {
        $event = new TestEvent;
        $event->setTarget($this);
        $this->emit($event, ['argOne', 'argTwo']);
    }
}

/** @noinspection PhpUndefinedClassInspection */
class TestEventHandler extends AbstractEventHandler
{
    /**
     * @var int
     */
    public $invoked = 0;

    /**
     * @var EventTargetInterface[]
     */
    public $eventTargets = [];

    public function initEvents() : void
    {
        $this->on('event', 'onEvent');
        $this->on(TestEvent::class, 'onTestEvent');
    }

    public function onEvent(
        /** @noinspection PhpUnusedParameterInspection */
        Event $event,
        string $argOne,
        string $argTwo
    ) : void {
        $this->invoked++;
        $this->eventTargets[] = $event->getTarget();
    }

    public function onTestEvent(
        /** @noinspection PhpUnusedParameterInspection */
        TestEvent $event,
        string $argOne,
        string $argTwo
    ) : void {
        $this->invoked++;
        $this->eventTargets[] = $event->getTarget();
    }
}


$target = new TestEventTarget;

$invoked = 0;
$callbackA = function (
    /** @noinspection PhpUnusedParameterInspection */
    Event $event,
    string $argOne,
    string $argTwo
) use (&$invoked) {
    $invoked++;
};

$callbackB = function (
    /** @noinspection PhpUnusedParameterInspection */
    TestEvent $event,
    string $argOne,
    string $argTwo
) use (&$invoked) {
    $invoked++;
};

$handler = new TestEventHandler;

$target->on('event', $callbackA);
$target->on(TestEvent::class, $callbackB);
$target->on($handler);

$target->doA();
$target->doB();

$target->off($callbackA);
$target->off($callbackB);
$target->off($handler);

$target->doA();
$target->doB();


Assert::equal(2, $invoked);
Assert::equal(2, $handler->invoked);
Assert::type(EventTargetInterface::class, $handler->eventTargets[0]);
Assert::type(EventTargetInterface::class, $handler->eventTargets[1]);
