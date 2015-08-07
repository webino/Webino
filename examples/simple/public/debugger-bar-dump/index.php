<?php
/**
 * Debugger Bar Dump
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\TitleHtml;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Adding the Tracy
 * debugger bar.
 */
$debugger = Webino::debugger(Webino::debuggerOptions()->setBar(true));

$app = Webino::application(null, $debugger)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Debugger bar
     * variable dump.
     */
    // TODO $event->getApp()->debug()->barDump($event);
    $event->getApp()->getDebugger()->barDump($event);

    $event->setResponseContent([
        'Check out right bottom corner > dumps!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
