<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Config\Feature;

use Webino\Config\Router\Route as RouteConfig;
use Webino\Config\Router\RouteInterface;

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
     * @param string|null $name
     */
    public function __construct(?string $name = null)
    {
        parent::__construct();
        $this->route = (new RouteConfig)->setName($name);
    }

    /**
     * @param string $route Literal route
     * @return $this
     */
    public function setLiteral(string $route) : self
    {
        $this->setPath($route)->setType($this::LITERAL);
        return $this;
    }

    /**
     * @param string $route Segment route
     * @return $this
     */
    public function setSegment(string $route) : self
    {
        $this->setPath($route)->setType($this::SEGMENT);
        return $this;
    }

    /**
     * @param string $type Route type
     * @return $this
     */
    public function setType(string $type = RouteInterface::LITERAL) : self
    {
        $this->getRoute()->setType($type);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() : string
    {
        return $this->getRoute()->getName();
    }

    /**
     * @param string $name Route name
     * @return $this
     */
    public function setName(string $name) : self
    {
        $this->getRoute()->setName($name);
        return $this;
    }

    /**
     * @param bool $mayTerminate
     * @return $this
     */
    public function setMayTerminate(bool $mayTerminate = true) : self
    {
        $this->getRoute()->setMayTerminate($mayTerminate);
        return $this;
    }

    /**
     * @param array $defaults
     * @return $this
     */
    public function setDefaults(array $defaults) : self
    {
        $this->getRoute()->setDefaults($defaults);
        return $this;
    }

    /**
     * @param self[] $routes
     * @return $this
     */
    public function setChild(array $routes) : self
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
    public function chain(array $routes) : self
    {
        $this->getRoute()->chain($this->resolveRoutes($routes));
        return $this;
    }

    /**
     * @return RouteConfig
     */
    public function getRoute() : RouteConfig
    {
        return $this->route;
    }

    /**
     * Set route path
     *
     * @param string|array $path Route path
     * @return $this
     */
    public function setPath(string $path) : self
    {
        $this->route->setPath($path);
        return $this;
    }

    /**
     * @return array
     */
    protected function createRoutes() : array
    {
        return $this->route->hasName()
            ? [$this->route->getName() => $this->route->toArray()]
            : [$this->route->toArray()];
    }

    /**
     * @param RouteInterface[] $routes
     * @return array
     */
    protected function resolveRoutes(array $routes) : array
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
    public function toArray() : array
    {
        $this->mergeArray([self::ROUTER => [self::ROUTES => $this->createRoutes()]]);
        return parent::toArray();
    }
}
