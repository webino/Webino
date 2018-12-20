<?php

namespace Webino;

/**
 * Class BackEndRoute
 */
class BackEndRoute
{
    const ROUTE = 'admin';

    /**
     * @param RouteConfigEvent $event
     */
    static function configure(RouteConfigEvent $event)
    {
        $router = $event->getRouter();
        $router->route('admin', static::class);
    }

    /**
     * @param RouteDispatchEvent $event
     * @return string
     */
    function dispatch(RouteDispatchEvent $event)
    {
        return 'BackEnd';
    }
}
