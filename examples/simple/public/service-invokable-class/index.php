<?php
/**
 * Invokable Service Class
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use WebinoEventLib\AbstractListener;

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
 * service class.
 */
$app->set(MyService::class);

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
