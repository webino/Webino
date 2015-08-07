<?php

namespace WebinoAppLib\Event;

/**
 * Class RouteEvent
 */
class RouteEvent extends DispatchEvent implements
    RouteEventInterface
{
    /**
     * Route match param name
     */
    const ROUTE_MATCH = 'routeMatch';

    /**
     * Route event prefix
     */
    const PREFIX = 'route.';

    /**
     * @param DispatchEvent $event
     */
    public function __construct(DispatchEvent $event)
    {
        parent::__construct($event->getApp());

        $this->setName($this::MATCH);
        $this->setParam($this::REQUEST, $event->getRequest());
        $this->setResponse($event->getResponse());
    }

    /**
     * @return \Zend\Mvc\Router\Http\RouteMatch
     */
    public function getRouteMatch()
    {
        return $this->getParam($this::ROUTE_MATCH);
    }

    /**
     * Get a specific route parameter
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getRouteParam($name, $default = null)
    {
        return $this->getRouteMatch()->getParam($name, $default);
    }
}
