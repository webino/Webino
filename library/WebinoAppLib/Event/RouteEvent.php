<?php

namespace WebinoAppLib\Event;

use Zend\Stdlib\ResponseInterface;

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
     * @var DispatchEvent
     */
    private $parentEvent;

    /**
     * @param DispatchEvent $event
     */
    public function __construct(DispatchEvent $event)
    {
        parent::__construct($event->getApp());
        $this->parentEvent = $event;

        $this->setName($this::MATCH);
        $this->setParam($this::REQUEST, $event->getRequest());
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        if ($this::MATCH === $name || interface_exists($name)) {
            $this->name = (string) $name;
            return $this;
        }

        $this->name = RouteEvent::PREFIX . $name;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getResponse()
    {
        $response = parent::getResponse();
        if (null === $response) {
            $response = $this->parentEvent->getResponse();
            parent::setResponse($response);
        }
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function setResponse(ResponseInterface $response)
    {
        $this->parentEvent->setResponse($response);
        return parent::setResponse($response);
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
