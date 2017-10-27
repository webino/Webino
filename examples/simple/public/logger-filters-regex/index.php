<?php
/**
 * Logger Filters Regex
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
    const EVENTS = 'event.log';
}

$config = Webino::config([
    /**
     * Configuring app logs
     * with priority filters.
     */
    (new Log(MyLogs::APP))->filterRegex('~^Attach~'),
    (new Log(MyLogs::EVENTS))->filterRegex('~^Event~'),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Writing log
 * messages.
 */
$app->log()->error('Test error log message!');
$app->log()->critical('Test critical log message!');
$app->log()->alert('Test alert log message!');
$app->log()->emergency('Test emergency log message!');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining log
     * files contents.
     */
    $log = $event->getApp()->file()->read(MyLogs::APP);
    $eventLog = $event->getApp()->file()->read(MyLogs::EVENTS);

    $event->setResponse([
        new FieldSetScrollBox('Event log', $eventLog),
        new FieldSetScrollBox('Application log', $log),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
