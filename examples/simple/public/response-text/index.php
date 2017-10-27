<?php
/**
 * Response Text
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\TextResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Example routes
 */
abstract class MyRoutes
{
    const TEXT_TEST = 'textTest';
}

$config = Webino::config([
    /**
     * Configuring plain text
     * response route.
     */
    (new Route(MyRoutes::TEXT_TEST))->setLiteral('/text-test'),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute(MyRoutes::TEXT_TEST, function (RouteEvent $event) {
    /**
     * Responding using
     * plain text.
     */
    $event->setResponse(new TextResponse('Hello Webino!'));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        $event->getApp()->url(MyRoutes::TEXT_TEST)->html('View plain text!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
