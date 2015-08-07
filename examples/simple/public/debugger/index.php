<?php
/**
 * Debugger
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Adding the Tracy
 * debugger bar.
 */
$debugger = Webino::debugger(Webino::debuggerOptions()->setBar(true));

$app = Webino::application(null, $debugger)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Check out right bottom corner > TRACY!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
