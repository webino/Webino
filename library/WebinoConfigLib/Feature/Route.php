<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Router\Route as RouteConfig;
use WebinoConfigLib\Router\RouteInterface;

/**
 * Class Route
 */
class Route extends AbstractFeature implements
    RouteInterface
{
    /**
     * Router config key
     */
    const ROUTER = 'router';

    /**
     * Routes config key
     */
    const ROUTES = 'routes';

    /**
     * @var RouteConfig
     */
    private $route;

    /**
     * {@inheritdoc}
     */
    public function __construct($name = null)
    {
        $this->route = (new RouteConfig)
            ->setName($name);
    }

    /**
     * @param string $type Route type.
     * @return self
     */
    public function setType($type = RouteInterface::LITERAL)
    {
        $this->getRoute()->setType($type);
        return $this;
    }

    /**
     * @param string $name Route name.
     * @return self
     */
    public function setName($name)
    {
        $this->getRoute()->setName($name);
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
     * @param self[] $routes
     * @return self
     */
    public function setChild(array $routes)
    {
        foreach ($routes as $route) {
            if ($route instanceof self) {
                $this->getRoute()->setChild([$route->getRoute()]);
            }
        }
        return $this;
    }

    /**
     * @param RouteInterface[] $routes
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
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route Route path
     * @return self
     */
    public function setRoute($route)
    {
        $this->route->setRoute($route);
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
     * @param RouteInterface[] $routes
     * @return array
     */
    protected function resolveRoutes(array $routes)
    {
        $resolved = [];
        foreach ($routes as $route) {
            if ($route instanceof self) {
                $resolved[] = $route->getRoute();
            }
        }
        return $resolved;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $this->mergeArray([self::ROUTER => [self::ROUTES => $this->createRoutes()]]);
        return parent::toArray();
    }
}
