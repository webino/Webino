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
use Webino\Event\EventEmitter;

require __DIR__ . '/../../bootstrap.php';


/** @noinspection PhpUndefinedClassInspection */
class TestEvent extends Event
{

}


/** @noinspection PhpUndefinedClassInspection */
class TestEventHandler extends AbstractEventHandler
{
    /**
     * @var int
     */
    public $invoked = 0;

    public function initEvents() : void
    {
        $this->on('event', 'onEvent');
        $this->on(TestEvent::class, 'onTestEvent');
    }

    public function onEvent(
        /** @noinspection PhpUnusedParameterInspection */
        Event $event,
        string $paramOne,
        string $paramTwo
    ) : void {
        $this->invoked++;
    }

    public function onTestEvent(
        /** @noinspection PhpUnusedParameterInspection */
        TestEvent $event,
        string $paramOne,
        string $paramTwo
    ) : void {
        $this->invoked++;
    }
}


$emitter = new EventEmitter;
$handler = new TestEventHandler;
$event = new TestEvent;
$args = ['argOne', 'argTwo'];

$handler->attachEventEmitter($emitter);

$emitter->emit('event', $args);
$emitter->emit($event, $args);

$handler->detachEventEmitter($emitter);

$emitter->emit('event', $args);
$emitter->emit($event, $args);


Assert::equal(2, $handler->invoked);
