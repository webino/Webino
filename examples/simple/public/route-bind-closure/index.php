<?php
/**
 * Route Bind Closure
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

$app = Webino::application()->bootstrap();

/**
 * Handling default
 * route via closure.
 */
$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent(['Hello Webino!', new SourcePreview(__FILE__)]);
});

$app->dispatch();
