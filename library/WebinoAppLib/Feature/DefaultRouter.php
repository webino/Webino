<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application;
use WebinoAppLib\Application\ConfigInterface;
use WebinoAppLib\Factory\RouterFactory;
use WebinoAppLib\Listener\RoutingListener;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoConfigLib\Feature\Route;

/**
 * Class DefaultRouter
 */
class DefaultRouter extends Config implements
    FeatureInterface
{
    /**
     * Route plugin manager service name
     */
    const ROUTE_PLUGIN_MANAGER = 'RoutePluginManager';

    /**
     * Configure an application default router
     */
    public function __construct()
    {
        parent::__construct([
            new Listener(RoutingListener::class),
            (new Route(DefaultRoute::class))->setLiteral('/'),
        ]);

        $this->mergeArray([
            ConfigInterface::SERVICES => [
                ConfigInterface::SERVICES_FACTORIES => [
                    Application::ROUTER => RouterFactory::class,
                ],
            ],
        ]);
    }
}
