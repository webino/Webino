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
use Webino\Event\EventInterface;
use Webino\Event\EventEmitter;

require __DIR__ . '/../../bootstrap.php';


$events = new EventEmitter;
$event = 'event';
$params = ['paramOne', 'paramTwo'];

$emitCount = 0;
$callback = function (
    /** @noinspection PhpUnusedParameterInspection */
    EventInterface $event,
    string $argOne,
    string $argTwo
) use (&$emitCount) {
    $emitCount++;
};


$events->on($event, $callback);

$events->emit($event, $params);


Assert::equal(1, $emitCount);
