<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application;
use WebinoAppLib\Factory\RouterFactory;
use WebinoAppLib\Listener\Console\ConsoleRoutingListener;
use WebinoAppLib\Listener\Http\HttpRoutingListener;
use WebinoAppLib\Router\DefaultRoute;
use WebinoConfigLib\Feature\FeatureInterface;

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
