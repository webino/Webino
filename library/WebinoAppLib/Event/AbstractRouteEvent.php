<?php

namespace WebinoAppLib\Event;

use Zend\Mvc\Router\RouteMatch;
use Zend\Stdlib\ResponseInterface;

/**
 * Class AbstractRouteEvent
 */
abstract class AbstractRouteEvent extends DispatchEvent implements
    RouteEventInterface
{
    /**
     * Route match param name
     */
    const ROUTE_MATCH = 'routeMatch';

    /**
     * @var DispatchEvent
     */
    private $parentEvent;

    /**
     * @param DispatchEvent $event
     */
    public function __construct(DispatchEvent $event)
    {
        $this->parentEvent = $event;
        parent::__construct($event->getApp());
        $this->setName($this::MATCH);
        $this->setRequest($event->getRequest());
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
     * Get a specific parameter
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function getParam($name, $default = null)
    {
        return $this->getRouteMatch()->getParam($name, $default);
    }

    /**
     * Set value to a parameter
     *
     * @param  string|int $name
     * @param  mixed $value
     * @return $this
     */
    public function setParam($name, $value)
    {
        $this->getRouteMatch()->setParam($name, $value);
        return $this;
    }

    /**
     * Get all parameters
     *
     * @return array|object|\ArrayAccess
     */
    public function getParams()
    {
        return $this->getRouteMatch()->getParams();
    }

    /**
     * Set parameters
     *
     * Overwrites parameters
     *
     * @param  array|\ArrayAccess|object $params
     * @return $this
     * @throws \Zend\EventManager\Exception\InvalidArgumentException
     */
    public function setParams($params)
    {
        foreach ($params as $name => $value) {
            $this->setParam($name, $value);
        };
        return $this;
    }

    /**
     * @return \Zend\Mvc\Router\Http\RouteMatch
     */
    public function getRouteMatch()
    {
        $routeMatch = $this->getEventParam($this::ROUTE_MATCH);
        if (null === $routeMatch) {
            // null object by default
            $routeMatch = new RouteMatch([]);
            $this->setEventParam($this::ROUTE_MATCH, $routeMatch);
        }
        return $routeMatch;
    }
}
