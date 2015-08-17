<?php
/**
 * Logger Message
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Log\AbstractWarningMessage;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoBaseLib\Html\ScrollBoxHtml;
use WebinoBaseLib\Html\TextHtml;
use WebinoConfigLib\Feature\Log;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom log message
 */
class MyLogMessage extends AbstractWarningMessage
{
    public function getMessage(...$args)
    {
        return 'Test log message!';
    }

}

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
$app->log(MyLogMessage::class);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining log
     * file contents.
     */
    $log = $event->getApp()->file()->read('app.log');

    $event->setResponseContent([
        'Application log:',
        (new ScrollBoxHtml(nl2br(new TextHtml($log)), false)),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
