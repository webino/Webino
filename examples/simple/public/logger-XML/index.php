<?php
/**
 * Logger Message
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\XmlResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoHtmlLib\TagHtml;
use WebinoHtmlLib\UrlHtml;
use WebinoConfigLib\Feature\Log;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring app
     * log file XML.
     */
    (new Log('app.log.xml'))->setXmlFormat(),

    // configuring xml log preview route
    (new Route('xmlLog'))->setLiteral('/app-xml-log'),
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

$app->bindRoute('xmlLog', function (RouteEvent $event) {
    /**
     * Obtaining log
     * file contents.
     */
    $log = $event->getApp()->file()->read('app.log.xml');

    $event->setResponse(new XmlResponse(new TagHtml('root', $log)));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url('xmlLog')->html('View XML log!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
