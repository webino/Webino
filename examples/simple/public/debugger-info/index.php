<?php
/**
 * Debugger Info
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\DebugBarInfo;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Adding the Tracy
 * debugger bar.
 */
$debugger = Webino::debugger(Webino::debuggerOptions()->setBar(true));

$config = Webino::config([
    /**
     * Adding the Tracy
     * debugger bar info.
     */
    new DebugBarInfo([
        'Custom Info 01' => 'Custom Info Value 01',
        'Custom Info 02' => 'Custom Info Value 02',
    ]),
]);

$app = Webino::application($config, $debugger)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Check out right bottom corner > System info!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
