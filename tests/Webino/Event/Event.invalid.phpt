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
use Webino\Event\Exception\InvalidArgumentException;

require __DIR__ . '/../../bootstrap.php';


$emitter = new EventEmitter;
$event = new stdClass;


Assert::exception(function () use ($emitter, $event) {

    $emitter->on($event, function () {});

}, InvalidArgumentException::class);
