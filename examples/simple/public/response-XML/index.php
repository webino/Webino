<?php
/**
 * Response XML
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\XmlResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;
use WebinoHtmlLib\Html;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Example routes
 */
abstract class MyRoutes
{
    const XML_TEST = 'xmlTest';
}

$config = Webino::config([
    /**
     * Configuring XML
     * response route.
     */
    (new Route(MyRoutes::XML_TEST))->setLiteral('/xml-test'),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute(MyRoutes::XML_TEST, function (RouteEvent $event) {
    /**
     * Responding
     * using XML.
     */
    $event->setResponse(new XmlResponse(new Html\Tag('root', 'Hello Webino!')));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url(MyRoutes::XML_TEST)->html('View XML!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
