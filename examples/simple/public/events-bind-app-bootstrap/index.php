<?php
/**
 * Events Bind App Bootstrap
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
 * core bootstrap.
 */
$appCore->bind(AppEvent::BOOTSTRAP, function (AppEvent $event) {
    /**
     * Binding to
     * app bootstrap.
     */
    $event->getApp()->bind(AppEvent::BOOTSTRAP, function (AppEvent $event) {
        $event->getApp()->set('responseText', 'Hello Webino!');
    });
});

$app = $appCore->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->get('responseText'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();