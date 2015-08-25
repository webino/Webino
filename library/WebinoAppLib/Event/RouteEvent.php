<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Util\RouteEventNameResolver;

/**
 * Class RouteEvent
 */
class RouteEvent extends AbstractRouteEvent
{
    /**
     * Route event prefix
     */
    const PREFIX = 'route.';

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = call_user_func(RouteEventNameResolver::getInstance(), $name);
        return $this;
    }
}
