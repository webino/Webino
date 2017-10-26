<?php
/**
 * Logger Custom
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBox;
use WebinoHtmlLib\Html;
use WebinoConfigLib\Feature\FirePhpLog;
use WebinoConfigLib\Feature\Log;
use WebinoConfigLib\Feature\Logger;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring
     * app logger.
     */
    new Log('app.log'),

    new FirePhpLog,

    /**
     * Configuring
     * custom logger.
     */
    new Logger('myLogger', [

        new Log('my.log'),

        new FirePhpLog,
    ]),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Obtaining custom logger service
 * and logging a message.
 */
$app->getLogger('myLogger')->log()->info('My logger info message!');

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining custom
     * log file contents.
     */
    $myLog = $event->getApp()->file()->read('my.log');

    /**
     * Obtaining app
     * log file contents.
     */
    $log = $event->getApp()->file()->read('app.log');

    $event->setResponseContent([
        'My log:',
        new ScrollBox(nl2br(new Html\Text($myLog))),
        'Application log:',
        new ScrollBox(nl2br(new Html\Text($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
