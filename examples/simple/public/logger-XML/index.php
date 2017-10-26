<?php
/**
 * Logger Message
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\XmlResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\Html;
use WebinoConfigLib\Feature\Log;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';


/**
 * Example routes
 */
abstract class MyRoutes
{
    const XML_LOG = 'xmlLog';
}

/**
 * Example logs
 */
abstract class MyLogs
{
    const APP = 'app.log.xml';
}

$config = Webino::config([
    /**
     * Configuring app
     * log file XML.
     */
    (new Log(MyLogs::APP))->setXmlFormat(),

    // configuring xml log preview route
    (new Route(MyRoutes::XML_LOG))->setLiteral('/app-xml-log'),
]);

$app = Webino::application($config)->bootstrap();

/**
 * Writing log
 * message.
 */
$app->log()->info('Test info log message!');

/**
 * Writing log message
 * with arguments.
 */
$app->log()->debug('Test debug log message {0} {1}', ['paramOne', 'paramTwo']);

$app->bindRoute(MyRoutes::XML_LOG, function (RouteEvent $event) {
    /**
     * Obtaining log
     * file contents.
     */
    $log = $event->getApp()->file()->read(MyLogs::APP);

    $event->setResponse(new XmlResponse(new Html\Tag('root', $log)));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url(MyRoutes::XML_LOG)->html('View XML log!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
