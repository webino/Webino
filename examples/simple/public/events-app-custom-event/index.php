<?php
/**
 * Events App Custom Event
 * Webino Example
 */

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

$app = Webino::application()->bootstrap();

/**
 * Binding to
 * custom event.
 */
$app->bind('myEvent', function (AppEvent $event) {
    $event->getApp()->set('responseText', 'Hello Webino!');
});

/**
 * Emitting
 * custom event.
 */
$app->emit('myEvent');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        $event->getApp()->get('responseText'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
