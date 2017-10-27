<?php
/**
 * Logger ChromePHP
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\ChromePhpLog;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring ChromePHP
     * logging.
     */
    new ChromePhpLog,
]);

$app = Webino::application($config)->bootstrap();

/**
 * Writing log
 * message.
 */
$app->log()->debug('Test log message!');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        'Use Chrome Logger extension to view a log!',
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
