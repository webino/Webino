<?php
/**
 * Logger Custom
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\FieldSetScrollBox;
use WebinoConfigLib\Feature\FirePhpLog;
use WebinoConfigLib\Feature\Log;
use WebinoConfigLib\Feature\Logger;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Example loggers
 */
class MyLogger extends Logger
{
    const NAME = 'myLogger';
}

/**
 * Example logs
 */
abstract class MyLogs
{
    const APP = 'app.log';
    const MY = 'my.log';
}


$config = Webino::config([
    /**
     * Configuring
     * app logger.
     */
    new Log(MyLogs::APP),
    new FirePhpLog,

    /**
     * Configuring
     * custom logger.
     */
    new MyLogger([
        new Log(MyLogs::MY),
        new FirePhpLog,
    ]),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Obtaining custom logger service
 * and logging a message.
 */
$app->getLogger(MyLogger::NAME)->log()->info('My logger info message!');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining custom
     * log file contents.
     */
    $myLog = $event->getApp()->file()->read(MyLogs::MY);

    /**
     * Obtaining app
     * log file contents.
     */
    $log = $event->getApp()->file()->read(MyLogs::APP);

    $event->setResponse([
        new FieldSetScrollBox('My log', $myLog),
        new FieldSetScrollBox('Application log', $log),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
