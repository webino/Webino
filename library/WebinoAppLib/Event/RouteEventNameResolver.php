<?php

namespace WebinoAppLib\Event;

/**
 * Class RouteEventNameResolver
 */
class RouteEventNameResolver
{
    /**
     * @param string $name
     * @return string
     */
    public function __invoke($name)
    {
        return interface_exists($name) ? $name : RouteEvent::PREFIX . $name;
    }
}
