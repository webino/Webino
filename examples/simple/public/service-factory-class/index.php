<?php
/**
 * Service Factory Class
 * Webino Example
 */

use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Custom service
 */
class MyService
{
    public function __construct($someDependency)
    {
    }

    public function doSomething()
    {
        return 'My Service Response Content!';
    }
}

/**
 * Custom service factory
 */
class MyServiceFactory extends AbstractFactory
{
    protected function create()
    {
        $someDependency = 'example';
        return new MyService($someDependency);
    }
}

$app = Webino::application()->bootstrap();

/**
 * Registering custom
 * service via factory class.
 */
$app->set(MyService::class, MyServiceFactory::class);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining service
     * instance.
     */
    $myService = $event->getApp()->get(MyService::class);

    $event->setResponse([
        $myService->doSomething(),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
