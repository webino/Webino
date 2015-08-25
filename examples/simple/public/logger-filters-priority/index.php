<?php
/**
 * Logger Filters
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBoxHtml;
use WebinoHtmlLib\TextHtml;
use WebinoConfigLib\Feature\FirePhpLog;
use WebinoConfigLib\Feature\Log;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring app log
     * with priority filters.
     */
    (new Log('app.log'))->filterPriority(Log::INFO),

    (new Log('error.log'))->setName('error')->filterPriority(Log::ERROR),
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
    $log = $event->getApp()->file()->read('app.log');

    $errLog = $event->getApp()->file()->read('error.log');

    $event->setResponseContent([
        'Error log:',
        new ScrollBoxHtml(nl2br(new TextHtml($errLog))),
        'Application log:',
        new ScrollBoxHtml(nl2br(new TextHtml($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
