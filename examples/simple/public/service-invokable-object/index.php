<?php
/**
 * Invokable Service Object
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
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
        return 'My Service Response Content!';
    }
}

$app = Webino::application()->bootstrap();

/**
 * Registering invokable
 * service instance.
 */
$app->set(MyService::class, new MyService);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining invokable
     * service instance.
     */
    $myService = $event->getApp()->get(MyService::class);

    $event->setResponseContent([
        $myService->doSomething(),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
