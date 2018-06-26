<?php

use Tester\Assert;
use Webino\Event;
use Webino\EventEmitter;

$eventEmitter = new EventEmitter;
$event = new Event('test');


$eventEmitter->on($event, function (Event $event) {
    $event['emitted'] = true;
});

$eventEmitter->emit($event);


Assert::false(empty($event['emitted']));
