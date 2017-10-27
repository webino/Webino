<?php
/**
 * Response JSON
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\JsonResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Example routes
 */
abstract class MyRoutes
{
    const JSON_TEST = 'jsonTest';
}

$config = Webino::config([
    /**
     * Configuring JSON
     * response route.
     */
    (new Route(MyRoutes::JSON_TEST))->setLiteral('/json-test'),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute(MyRoutes::JSON_TEST, function (RouteEvent $event) {
    /**
     * Responding
     * using JSON.
     */
    $event->setResponse(new JsonResponse(['my' => ['data' => 'value']]));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponse([
        $event->getApp()->url(MyRoutes::JSON_TEST)->html('View JSON!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
