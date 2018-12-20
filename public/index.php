<?php

namespace Webino;

require __DIR__ . '/../vendor/autoload.php';
chdir(__DIR__);


$app = App::make();

// view response
$app->on(ViewResponseHandler::class);
// router handler
$app->on(HttpRouterHandler::class);

// TODO
// Modules
$app->on(SystemModule::class);
$app->on(DefaultModule::class);


// console dispatch
// TODO handler class
$app->on(ConsoleResponseEvent::class, function () {

    return 'Hello Console!';

});


$app->dispatch();
