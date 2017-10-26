<?php
/**
 * Debugger Timer
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Adding the Tracy
 * debugger bar.
 */
$debugger = Webino::debugger(Webino::debuggerOptions()->setDevMode()->setBar());

$app = Webino::application(null, $debugger)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Measuring
     * execution time.
     */
    $event->getApp()->debug()->timer();
    sleep(1);
    $elapsed = $event->getApp()->debug()->timer();

    $event->setResponseContent([
        'Hello Webino!',
        new Html\Text('Elapsed time: ' . $elapsed),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
