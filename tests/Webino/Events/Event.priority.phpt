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

$emitTest = [];
$callbackA = function (EventInterface $event) use (&$emitTest) {
    return $emitTest[] = 'A';
};

$callbackB = function (EventInterface $event) use (&$emitTest) {
    return $emitTest[] = 'B';
};

$callbackC = function (EventInterface $event) use (&$emitTest) {
    return $emitTest[] = 'C';
};

$callbackD = function (EventInterface $event) use (&$emitTest) {
    return $emitTest[] = 'D';
};


$emitter->on($event, $callbackA, EventInterface::BEGIN);
$emitter->on($event, $callbackB, EventInterface::BEFORE);
$emitter->on($event, $callbackC, EventInterface::AFTER);
$emitter->on($event, $callbackD, EventInterface::FINISH);

$event = $emitter->emit($event);


Assert::same(['A', 'B', 'C', 'D'], $emitTest);
Assert::same(['D', 'C', 'B', 'A'], $event->getResponses()->toArray());
