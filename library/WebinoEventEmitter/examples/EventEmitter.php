<?php

//:
use Webino\EventEmitter;

$emitter = new EventEmitter;

// registering closure event handler
$emitter->on('example', function () {
    return 'Hello';
});

// emitting custom event
$event = $emitter->emit('example');

/** @var \Webino\EventResults $results */
$results = $event->getResults();
//!
