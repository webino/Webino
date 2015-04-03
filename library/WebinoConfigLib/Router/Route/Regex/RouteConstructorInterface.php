<?php

namespace WebinoConfigLib\Router\Route\Regex;

use WebinoConfigLib\Router\RouteConstructorInterface as BaseRouteConstructorInterface;

/**
 * Interface RouteConstructorInterface
 */
interface RouteConstructorInterface extends BaseRouteConstructorInterface
{
    /**
     * {@inheritdoc}
     * @param string|null $spec Regex route spec
     */
    public function __construct($route, $spec = null, $handlers = null);
}
