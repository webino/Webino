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
use WebinoHtmlLib\TagHtml;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring XML
     * response route.
     */
    (new Route('xmlTest'))->setLiteral('/xml-test'),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute('xmlTest', function (RouteEvent $event) {
    /**
     * Responding
     * using XML.
     */
    $event->setResponse(new XmlResponse(new TagHtml('root', 'Hello Webino!')));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url('xmlTest')->html('View XML!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
