<?php
/**
 * Logger FirePHP
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\FirePhpLog;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring FirePHP
     * logging.
     */
    new FirePhpLog,
]);

$app = Webino::application($config)->bootstrap();

/**
 * Writing log
 * message.
 */
$app->log()->debug('Test log message!');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        'Use FirePHP extension to view a log!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
