<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Router\Route as RouteConfig;
use WebinoConfigLib\Router\RouteInterface;
use WebinoConfigLib\Router\RouteConstructorInterface;

/**
 * Class Route
 */
class Route extends AbstractFeature implements
    RouteInterface,
    RouteConstructorInterface
{
    /**
     * @var RouteConfig
     */
    private $route;

    /**
     * {@inheritdoc}
     */
    public function __construct($route, $handlers = null)
    {
        $this->setRoute(new RouteConfig($route, $handlers));
    }

    /**
     * @param string $type
     * @return self
     */
    public function setType($type)
    {
        $this->getRoute()->setType($type);
        return $this;
    }

    /**
     * @param bool $mayTerminate
     * @return self
     */
    public function setMayTerminate($mayTerminate = true)
    {
        $this->getRoute()->setMayTerminate($mayTerminate);
        return $this;
    }

    /**
     * @param array $defaults
     * @return self
     */
    public function setDefaults(array $defaults)
    {
        $this->getRoute()->setDefaults($defaults);
        return $this;
    }

    /**
     * @param RouteInterface $route
     * @return self
     */
    public function setChild(RouteInterface $route)
    {
        $this->getRoute()->setChild($route->getRoute());
        return $this;
    }

    /**
     * @param self[] $routes
     * @return self
     */
    public function setChilds(array $routes)
    {
        foreach ($routes as $route) {
            $this->setChild($route);
        }
        return $this;
    }

    /**
     * @param self[] $routes
     * @return self
     */
    public function chain(array $routes)
    {
        $this->getRoute()->chain($this->resolveRoutes($routes));
        return $this;
    }

    /**
     * @return RouteConfig
     */
    protected function getRoute()
    {
        return $this->route;
    }

    /**
     * @param RouteConfig $route
     * @return self
     */
    protected function setRoute(RouteConfig $route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return array
     */
    protected function createRoutes()
    {
        return $this->route->hasName()
            ? [$this->route->getName() => $this->route->toArray()]
            : [$this->route->toArray()];
    }

    /**
     * @param array $routes
     * @return array
     */
    protected function resolveRoutes(array $routes)
    {
        $resolved = [];
        foreach ($routes as $route) {
            $resolved[] = $route->getRoute();
        }
        return $resolved;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->getData()->router['routes'] = $this->createRoutes();
        return parent::toArray();
    }
}
