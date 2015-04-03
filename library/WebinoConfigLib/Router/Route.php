<?php

namespace WebinoConfigLib\Router;

/**
 * Class Route
 */
class Route extends AbstractRoute implements RouteConstructorInterface
{
    use RouteConstructorTrait;

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        $this->hasRoute() and $this->setRouteOption($this->getRoute());
    }
}
