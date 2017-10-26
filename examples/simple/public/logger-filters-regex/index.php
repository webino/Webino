<?php
/**
 * Logger Filters Regex
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBox;
use WebinoHtmlLib\Html;
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
     * Configuring app log
     * with priority filters.
     */
    (new Log(MyLogs::APP))->filterRegex('~^Attach~'),

    (new Log(MyLogs::EVENTS))->setName('error')->filterRegex('~^Event~'),
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
     * file contents.
     */
    $log = $event->getApp()->file()->read(MyLogs::APP);

    $eventLog = $event->getApp()->file()->read(MyLogs::EVENTS);

    $event->setResponseContent([
        'Event log:',
        new ScrollBox(nl2br(new Html\Text($eventLog))),
        'Application log:',
        new ScrollBox(nl2br(new Html\Text($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
