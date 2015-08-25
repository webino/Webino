<?php
/**
 * Logger Message Class
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoExamplesLib\Html\ScrollBoxHtml;
use WebinoHtmlLib\TextHtml;
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
    $log = $event->getApp()->file()->read('app.log');

    $event->setResponseContent([
        'Application log:',
        new ScrollBoxHtml(nl2br(new TextHtml($log))),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
