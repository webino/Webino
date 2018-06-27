<?php

//example
use Webino\EventEmitter;

$emitter = new EventEmitter;

$handler = function () {
    return 'Hello';
};

$emitter->on('example', $handler);

// remove handler for all events
$emitter->off($handler);

// remove all handlers for an event
$emitter->off(null, 'example');

// remove all handlers for all events
$emitter->off();
///example
