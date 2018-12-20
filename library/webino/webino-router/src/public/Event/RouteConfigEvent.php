<?php

namespace Webino;

/**
 * Class RouteConfigEvent
 * @package webino-router
 */
class RouteConfigEvent extends AppEvent
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @return RouterInterface
     */
    function getRouter(): RouterInterface
    {
        return $this->router;
    }

    /**
     * @param RouterInterface $router
     */
    function setRouter(RouterInterface $router): void
    {
        $this->router = $router;
    }
}
