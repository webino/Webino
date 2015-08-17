<?php
/**
 * Events Bind App Configure
 * Webino example
 */

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

$appCore = Webino::application();

/**
 * Binding to
 * app configure.
 */
$appCore->bind(AppEvent::CONFIGURE, function (AppEvent $event) {
    $event->getApp()->getConfig()->responseText = 'Hello Webino!';
});

$app = $appCore->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->getConfig('responseText'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
