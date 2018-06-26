<?php

use Tester\Assert;
use Webino\EventEmitter;

$emitted = false;
$eventEmitter = new EventEmitter;


$eventEmitter->on('test', function () use (&$emitted) {
    $emitted = true;
});

$eventEmitter->emit('test');


Assert::true($emitted);
