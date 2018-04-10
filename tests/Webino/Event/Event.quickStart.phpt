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
use Webino\Event\EventEmitter;
use Webino\Event\EventInterface;


require __DIR__ . '/../../bootstrap.php';


class MyEventHandler extends AbstractEventHandler
{
    public function initEvents() : void
    {
        $this->on('some.event', 'onSomeEvent');
    }

    public function onSomeEvent(EventInterface $event, string $argOne, string $argTwo)
    {
        // do something...
        Assert::true(true);
    }
}


$emitter = new EventEmitter;
$handler = new MyEventHandler;

$emitter->on($handler);

$emitter->emit('some.event', ['customArgOne', 'customArgTwo']);
