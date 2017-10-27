<?php
/**
 * Service Factory Object Invokable
 * Webino Example
 */

use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Event\RouteEvent;
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

$app = Webino::application()->bootstrap();

/**
 * Registering a service via
 * invokable factory instance.
 */
$app->set(MyService::class, new MyServiceFactory);

$app->bind(DefaultRoute::class, function (RouteEvent $event) {
    /**
     * Obtaining a
     * service instance.
     */
    $myService = $event->getApp()->get(MyService::class);

    $event->setResponse([
        $myService->doSomething(),
        new SourcePreview(__FILE__),
    ]);
});

$app->dispatch();
