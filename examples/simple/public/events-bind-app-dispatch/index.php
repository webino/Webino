<?php
/**
 * Events Bind App Dispatch
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
 * app dispatch.
 */
$app->bind(AppEvent::DISPATCH, function (AppEvent $event) {
    $event->setResponse([
        'Hello Webino!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
