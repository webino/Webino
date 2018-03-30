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
use Webino\Event\EventEmitter;
use Webino\Event\EventInterface;

require __DIR__ . '/../../bootstrap.php';


$emitter = new EventEmitter;
$event = 'test.event';

$emitTest = [];
$callbackA = function (EventInterface $event) use (&$emitTest) {
    $emitTest[] = 'A';
};

$callbackB = function (EventInterface $event) use (&$emitTest) {
    $emitTest[] = 'B';
};

$callbackC = function (EventInterface $event) use (&$emitTest) {
    $emitTest[] = 'C';
};

$callbackD = function (EventInterface $event) use (&$emitTest) {
    $emitTest[] = 'D';
};

$emitter->on($event, $callbackA, EventInterface::BEGIN);
$emitter->on($event, $callbackB, EventInterface::BEFORE);
$emitter->on($event, $callbackC, EventInterface::AFTER);
$emitter->on($event, $callbackD, EventInterface::FINISH);

$emitter->emit($event);


Assert::same(['A', 'B', 'C', 'D'], $emitTest);
