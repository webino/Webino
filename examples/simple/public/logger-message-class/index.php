<?php
/**
 * Logger Message Class
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBox;
use WebinoHtmlLib\Html;
use WebinoConfigLib\Feature\Log;
use WebinoLogLib\Message\AbstractWarningMessage;
use Zend\Stdlib\Parameters;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom log message
 */
class MyLogMessage extends AbstractWarningMessage
{
    public function getMessage(Parameters $args)
    {
        return count($args) ? 'Test warning log message {0} {1}!' : 'Test warning log message!';
    }
}

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
 * Writing log
 * message.
 */
$app->log(MyLogMessage::class);

/**
 * Writing log message
 * with arguments.
 */
$app->log(MyLogMessage::class, ['paramOne', 'paramTwo']);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining log
     * file contents.
     */
    $log = $event->getApp()->file()->read(MyLogs::APP);

    $event->setResponseContent([
        'Application log:',
        new ScrollBox(nl2br(new Html\Text($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
