<?php
/**
 * Debugger Info
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\DebugBarInfo;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

$debugger = Webino::debugger(Webino::debuggerOptions()->setDevMode()->setBar());

$app = Webino::application(null, $debugger)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Adding the Tracy
     * debugger bar info.
     */
    $event->getApp()->debug()->setBarInfo('Test Label 01', 'Test Value01');
    // or as array
    $event->getApp()->debug()->setBarInfo(['Test Label 02' => 'Test Value02']);

    $event->setResponse([
        'Check out right bottom corner > System info!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
