<?php

namespace WebinoConfigLib\Router;

/**
 * Interface RouteConstructorInterface
 */
interface RouteConstructorInterface
{
    /**
     * @param string|array $route String for unnamed routes.
     *      Two in array [name, route] for named routes.
     *      One in array [name] for overrides.
     *
     * @param string|array|null $handlers String for single handler.
     *      Array ['HandlerOne', 'HandlerTwo'] for multiple handlers.
     *      Array ['one' => 'HandlerOne'] for named handlers, required for overrides.
     *
     * @throws \WebinoConfigLib\Exception\InvalidArgumentException
     */
    public function __construct($route, $handlers = null);
}
