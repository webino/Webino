<?php

namespace WebinoConfigLib\Router;

/**
 * Interface RouteConstructorInterface
 */
interface RouteConstructorInterface
{
    /**
     * @param string $route Route path.
     * @throws \WebinoConfigLib\Exception\InvalidArgumentException
     */
    public function __construct($route);
}
