<?php
/**
 * Service Factory Config
 * Webino Example
 */

use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Factory\AbstractFactory;
use WebinoAppLib\Feature\Service;
use WebinoAppLib\Response\Content\SourcePreview;
use WebinoAppLib\Router\DefaultRoute;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Example service dependency
 */
class MySubService
{
    public function doSomething($msg)
    {
        return $msg;
    }
}

/**
 * Custom service
 */
class MyService
{
    /**
     * @var MySubService
     */
    private $someDependency;

    public function __construct(MySubService $someDependency)
    {
        $this->someDependency = $someDependency;
    }

    public function doSomething()
    {
        return $this->someDependency->doSomething('My service response!');
    }
}

/**
 * Custom service factory
 */
class MyServiceFactory extends AbstractFactory
{
    protected function create()
    {
        /** @var MySubService $someDependency */
        $someDependency = $this->getServices()->get(MySubService::class);
        return new MyService($someDependency);
    }
}

$config = Webino::config([
    /**
     * Registering service
     * factory via config.
     */
    new Service(MyService::class, MyServiceFactory::class),

    // registering example dependency
    new Service(MySubService::class),
]);

$app = Webino::application($config)->bootstrap();

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
