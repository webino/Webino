<?php

namespace Webino;

/**
 * Class RouteDispatchEvent
 * @package webino-router
 */
class RouteDispatchEvent extends AppEvent
{
    use HttpRequestEventTrait;

    /**
     * @var object
     */
    private $route;

    /**
     * @return object
     */
    function getRoute()
    {
        return $this->route;
    }

    /**
     * @param object $route
     */
    function setRoute($route): void
    {
        $this->route = $route;
    }
}
