<?php

namespace WebinoAppLib\Event;

/**
 * Interface RouteEventInterface
 */
interface RouteEventInterface
{
    /**
     * Route matched
     */
    const MATCH = 'routeMatch';

    /**
     * Can't match the route
     */
    const NO_MATCH = 'routeNoMatch';
}
