<?php
/**
 * Response Text
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\TextResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;
use WebinoHtmlLib\TagHtml;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring plain text
     * response route.
     */
    (new Route('textTest'))->setLiteral('/text-test'),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute('textTest', function (RouteEvent $event) {
    /**
     * Responding using
     * plain text.
     */
    $event->setResponse(new TextResponse('Hello Webino!'));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url('textTest')->html('View plain text!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
