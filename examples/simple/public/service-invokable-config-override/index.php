<?php
/**
 * Invokable Service Config Override
 * Webino example
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
        return 'My Service Response Content!';
    }
}

$config = Webino::config([
    /**
     * Registering example
     * service via config.
     */
    new Service(ArrayObject::class),
    /**
     * Overriding example
     * service via config.
     */
    new Service([ArrayObject::class => MyService::class]),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining example
     * service instance.
     */
    $myService = $event->getApp()->get(ArrayObject::class);

    $event->setResponseContent([
        $myService->doSomething(),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
