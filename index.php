<?php

use Webino\App;
use Webino\Event;
use Webino\Response\HtmlResponse;

require 'vendor/autoload.php';


$app = App::create();

$app->on(Event\BootstrapEvent::class, function () {
//    throw new \RuntimeException('TODO1');
});

$app->on(Event\ResponseEvent::class, function () {

});

$app->on(Event\HttpResponseEvent::class, function () {
//    throw new \RuntimeException('TODO2');
//    throw new \Webino\Exception\ServiceUnavailableStatusException('Requested page not found');
    throw new \Webino\Exception\NotFoundStatusException('Requested page not found');
//    throw new \Webino\Exception\ForbiddenStatusException('Requested page not found');
//    throw new \Webino\Exception\InternalServerErrorStatusException('Requested page not found');
//    return 'Http';
    return new HtmlResponse('<html><body><strong>pokus</strong></body></html>');
//    return new TextResponse('<html><body><strong>pokus</strong></body></html>');
//    return 'pokus';
});

$app->on(Event\JsonResponseEvent::class, function () {
    return ['foo' => 'bar'];
});

$app->on(Event\TextResponseEvent::class, function () {
    return '<html><body><strong>pokus</strong></body></html>';
});

$app->on(Event\XmlResponseEvent::class, function () {
    return '<root>content</root>';
});

$app->on(Event\HtmlResponseEvent::class, function () {
    return '<html><body><strong>pokus</strong></body></html>';
});

$app->on(Event\ConsoleResponseEvent::class, function () {
//    throw new \RuntimeException('TODO3');
    return 'Console';
});

//$app->bootstrap();

$app->dispatch();
