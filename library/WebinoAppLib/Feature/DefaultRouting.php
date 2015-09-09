<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application;
use WebinoAppLib\Factory\RouterFactory;
use WebinoAppLib\Listener\Console\ConsoleRoutingListener;
use WebinoAppLib\Listener\Http\HttpRoutingListener;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoConfigLib\Feature\Route;

/**
 * Class DefaultRouting
 */
class DefaultRouting extends Config implements
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
            new DefaultRoute,
            new HttpListener(HttpRoutingListener::class),
            new ConsoleListener(ConsoleRoutingListener::class),
            new Service(Application::ROUTER, RouterFactory::class),
        ]);
    }
}
