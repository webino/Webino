<?php

namespace Webino;

/**
 * Class RouteConfigEvent
 * @package webino-router
 */
class RouteConfigEvent extends AppEvent
{
    /**
     * @return RouterInterface
     */
    function getRouter(): RouterInterface
    {
        return $this['router'];
    }

    /**
     * @param RouterInterface $router
     */
    function setRouter(RouterInterface $router): void
    {
        $this['router'] = $router;
    }

    /**
     * @return RouteInterface
     */
    function getRoute(): RouteInterface
    {
        return $this['route'];
    }

    /**
     * @param RouteInterface $route
     */
    function setRoute(RouteInterface $route): void
    {
        $this['route'] = $route;
    }
}
