<?php
/**
 * Service Factory Config Invokable
 * Webino example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;
use Zend\ServiceManager\ServiceLocatorInterface;

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
 * Custom service factory invokable
 */
class MyServiceFactory
{
    public function __invoke(ServiceLocatorInterface $services)
    {
        $someDependency = 'example';
        return new MyService($someDependency);
    }
}

$config = Webino::config([
    /**
     * Registering service
     * factory via config.
     */
    new Service(MyService::class, MyServiceFactory::class),
]);

$app = Webino::application($config)->bootstrap();

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining service
     * instance.
     */
    $myService = $event->getApp()->get(MyService::class);

    $event->setResponseContent([
        $myService->doSomething(),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
