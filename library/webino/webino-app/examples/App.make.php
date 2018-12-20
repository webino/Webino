<?php

//:
use Webino\App;
use Webino\HttpResponseEvent;

// Application object creation
$app = App::make();

// Application initialization
$app->bootstrap();

// Handling HTTP response
$app->on(HttpResponseEvent::class, function () {
    return 'Hello';
});

// Request responding
$app->dispatch();
//!
