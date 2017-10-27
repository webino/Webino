<?php
/**
 * Invokable Service Config
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Invokable service
 */
class MyService
{
    public function doSomething()
    {
        return 'My service response!';
    }
}

$config = Webino::config([
    /**
     * Registering invokable
     * service via config.
     */
    new Service(MyService::class),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining invokable
     * service instance.
     */
    $myService = $event->getApp()->get(MyService::class);

    $event->setResponse([
        $myService->doSomething(),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
