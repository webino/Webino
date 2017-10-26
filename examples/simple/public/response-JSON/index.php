<?php
/**
 * Response JSON
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Response\JsonResponse;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\Route;

require __DIR__ . '/../../vendor/autoload.php';

$config = Webino::config([
    /**
     * Configuring JSON
     * response route.
     */
    (new Route('jsonTest'))->setLiteral('/json-test'),
]);

$app = Webino::application($config)->bootstrap();

$app->bindRoute('jsonTest', function (RouteEvent $event) {
    /**
     * Responding
     * using JSON.
     */
    $event->setResponse(new JsonResponse(['my' => ['data' => 'value']]));
});

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    $event->setResponseContent([
        $event->getApp()->url('jsonTest')->html('View JSON!'),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
