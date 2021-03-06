<?php
/**
 * Logger PSR-3
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\FieldSetScrollBox;
use WebinoConfigLib\Feature\Log;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Example logs
 */
abstract class MyLogs
{
    const APP = 'app.log';
}

$config = Webino::config([
    /**
     * Configuring app
     * log file.
     */
    new Log(MyLogs::APP),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Writing log message
 * PSR-3 style.
 */
$app->log()->emergency('Test emergency log message!');

/**
 * Writing log message PSR-3
 * style with arguments.
 */
$app->log()->info('Test info log message {0} {1}', ['paramOne', 'paramTwo']);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining log
     * file contents.
     */
    $log = $event->getApp()->file()->read(MyLogs::APP);

    $event->setResponse([
        new FieldSetScrollBox('Application log', $log),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
