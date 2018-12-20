<?php

use Tester\Assert;
use Webino\App;
use Webino\BootstrapEvent;
use Webino\DispatchEvent;

$app = new App;
$bootstrapped = false;
$dispatched = false;


$app->on(
    BootstrapEvent::class,
    function () use (&$bootstrapped) {
        $bootstrapped = true;
    }
);

$app->on(DispatchEvent::class, function () use (&$dispatched) {
    $dispatched = true;
});


$app->bootstrap();
$app->dispatch();


Assert::true($bootstrapped);
Assert::true($dispatched);
