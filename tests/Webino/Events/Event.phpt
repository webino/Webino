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
use Webino\Events\EventEmitter;
use Webino\Events\EventInterface;

require __DIR__ . '/../../bootstrap.php';


$emitter = new EventEmitter;
$event = 'test.event';

$callback = function (EventInterface $event) use (&$emitCount) {
    $event['test'] = true;
};


$emitter->on($event, $callback);

$event = $emitter->emit($event);

$emitter->off($callback, $event);

$emitter->emit($event);


Assert::true($event['test']);
Assert::type(EventInterface::class, $event);
Assert::same('test', $event->getValue('unknown', 'test'));
