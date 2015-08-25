<?php
/**
 * Logger Filters Regex
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
    (new Log('app.log'))->filterRegex('~^Attach~'),

    (new Log('event.log'))->setName('error')->filterRegex('~^Event~'),
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

    $eventLog = $event->getApp()->file()->read('event.log');

    $event->setResponseContent([
        'Event log:',
        new ScrollBoxHtml(nl2br(new TextHtml($eventLog))),
        'Application log:',
        new ScrollBoxHtml(nl2br(new TextHtml($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
