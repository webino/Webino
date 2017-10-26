<?php
/**
 * Logger Message
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBox;
use WebinoHtmlLib\Html;
use WebinoConfigLib\Feature\Log;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring app
     * log file.
     */
    new Log('app.log'),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Writing log
 * message.
 */
$app->log($app::INFO, 'Test info log message!');

/**
 * Writing log message
 * with arguments.
 */
$app->log($app::DEBUG, 'Test debug log message {0} {1}', ['paramOne', 'paramTwo']);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining log
     * file contents.
     */
    $log = $event->getApp()->file()->read('app.log');

    $event->setResponseContent([
        'Application log:',
        new ScrollBox(nl2br(new Html\Text($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
