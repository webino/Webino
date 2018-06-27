<?php

//example
use Webino\App;
use Webino\Event\HttpResponseEvent;

// Application object creation
$app = App::create();

// Application initialization
$app->bootstrap();

// Handling HTTP response
$app->on(HttpResponseEvent::class, function () {
    return 'Hello';
});

// Request responding
$app->dispatch();
///example
