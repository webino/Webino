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
use Webino\Events\Exceptions\InvalidArgumentException;

require __DIR__ . '/../../bootstrap.php';


$emitter = new EventEmitter;
$event = new stdClass;
$handler = function () {};


Assert::exception(
    function () use ($emitter, $handler) {
        $emitter->on($handler);
    },
    InvalidArgumentException::class,
    'Expected event as `string|EventInterface|null` but got `Closure`'
);

Assert::exception(
    function () use ($emitter, $event, $handler) {
        $emitter->on($event, $handler);
    },
    InvalidArgumentException::class,
    'Expected event as `string|EventInterface|null` but got `stdClass`'
);

Assert::exception(
    function () use ($emitter, $event, $handler) {
        $emitter->off($handler, $event);
    },
    InvalidArgumentException::class,
    'Expected event as `string|EventInterface|null` but got `stdClass`'
);

Assert::exception(
    function () use ($emitter, $event) {
        $emitter->emit($event);
    },
    InvalidArgumentException::class,
    'Expected event as `string|EventInterface|null` but got `stdClass`'
);
