<?php
/**
 * Logger Filters
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
    const ERROR = 'app.log';
}

$config = Webino::config([
    /**
     * Configuring app log
     * with priority filters.
     */
    (new Log(MyLogs::APP))->filterPriority(Log::INFO),

    (new Log(MyLogs::ERROR))->setName('error')->filterPriority(Log::ERROR),
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

    $errLog = $event->getApp()->file()->read(MyLogs::ERROR);

    $event->setResponseContent([
        'Error log:',
        new ScrollBox(nl2br(new Html\Text($errLog))),
        'Application log:',
        new ScrollBox(nl2br(new Html\Text($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
