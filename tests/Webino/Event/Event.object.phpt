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
use Webino\Event\Event;
use Webino\Event\EventEmitter;

require __DIR__ . '/../../bootstrap.php';


$emitter = new EventEmitter;
$event = new Event('test.event');

$emitCount = 0;
$callback = function (Event $event) use (&$emitCount) {
    $emitCount++;
};

$emitter->on($event, $callback);

$emitter->emit($event);

$emitter->off($callback);

$emitter->emit($event);


Assert::equal(1, $emitCount);
