<?php
/**
 * Service Factory Closure
 * Webino example
 */

use WebinoAppLib\Application\CoreConfig;
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

$app = Webino::application()->bootstrap();

/**
 * Registering service
 * via closure factory.
 */
$app->set(MyService::class, function (ServiceLocatorInterface $services) {
    $someDependency = 'example';
    return new MyService($someDependency);
});

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
