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
     * @param string $route Literal route.
     * @return $this
     */
    public function setLiteral($route)
    {
        $this->setRoute($route)->setType($this::LITERAL);
        return $this;
    }

    /**
     * @param string $route Segment route.
     * @return $this
     */
    public function setSegment($route)
    {
        $this->setRoute($route)->setType($this::SEGMENT);
        return $this;
    }

    /**
     * @param string $type Route type.
     * @return $this
     */
    public function setType($type = RouteInterface::LITERAL)
    {
        $this->getRoute()->setType($type);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getRoute()->getName();
    }

    /**
     * @param string $name Route name.
     * @return $this
     */
    public function setName($name)
    {
        $this->getRoute()->setName($name);
        return $this;
    }

    /**
     * @param bool $mayTerminate
     * @return $this
     */
    public function setMayTerminate($mayTerminate = true)
    {
        $this->getRoute()->setMayTerminate($mayTerminate);
        return $this;
    }

    /**
     * @param array $defaults
     * @return $this
     */
    public function setDefaults(array $defaults)
    {
        $this->getRoute()->setDefaults($defaults);
        return $this;
    }

    /**
     * @param self[] $routes
     * @return $this
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
     * @return $this
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
     * @return $this
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
