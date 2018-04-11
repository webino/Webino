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
use Webino\Events\AbstractEventHandler;
use Webino\Events\Event;
use Webino\Events\EventEmitter;

require __DIR__ . '/../../bootstrap.php';


class TestEvent extends Event
{

}


class TestEventHandler extends AbstractEventHandler
{
    public $invoked = 0;

    public function initEvents() : void
    {
        $this->on('event', 'onEvent');
        $this->on(TestEvent::class, 'onTestEvent');
    }

    public function onEvent(
        Event $event,
        string $paramOne,
        string $paramTwo
    ) : void {
        $this->invoked++;
    }

    public function onTestEvent(
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


$emitter->on($handler);

$emitter->emit('event', $args);
$emitter->emit($event, $args);

$emitter->off($handler);

$emitter->emit('event', $args);
$emitter->emit($event, $args);


Assert::equal(2, $handler->invoked);
