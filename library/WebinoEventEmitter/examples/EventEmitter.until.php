<?php

//:
use Webino\EventEmitter;

$emitter = new EventEmitter;

$emitter->on('example', function () {
    return 'Special';
});

$event = $emitter->emit('example', function ($result) {
    // when result meets required condition
    if ('Special' === $result) {
        // stop propagation
        return false;
    }
    // or continue
    return true;
});
//!
