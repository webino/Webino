<?php

namespace WebinoAppLib\Service;

use ArrayObject;
use WebinoConfigLib\Feature\Route;
use Zend\Mvc\Router\RouteMatch;
use Zend\Mvc\Router\RouteStackInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\RequestInterface;

/**
 * Class Router
 */
final class Router implements RouteStackInterface
{
    /**
     * @var RouteStackInterface
     */
    private $router;

    /**
     * @var ArrayObject<Route>
     */
    private $deferredRoutes;

    /**
     * @var array
     */
    private $supportedRouteTypes = [];

    /**
     * @param RouteStackInterface $router
     * @param ArrayObject $deferredRoutes
     */
    public function __construct(RouteStackInterface $router, ArrayObject $deferredRoutes)
    {
        $this->router = $router;
        $this->deferredRoutes = $deferredRoutes;
    }

    /**
     * @return RouteStackInterface
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * Won't implement
     *
     * @param  array|\Traversable $options
     * @return mixed
     */
    public static function factory($options = [])
    {
    }

    /**
     * Match a given request.
     *
     * @param  RequestInterface $request
     * @return RouteMatch|null
     */
    public function match(RequestInterface $request)
    {
        if (null !== $this->deferredRoutes) {
            foreach (array_keys($this->deferredRoutes->getArrayCopy()) as $route) {
                $this->addDeferredRoute($route);
            }
            $this->deferredRoutes = null;
        }

        return $this->router->match($request);
    }

    /**
     * Assemble the route.
     *
     * @param  array $params
     * @param  array $options
     * @return mixed
     */
    public function assemble(array $params = [], array $options = [])
    {
        isset($options['name']) and $this->addDeferredRoute($options['name']);
        return $this->router->assemble($params, $options);
    }

    /**
     * Add a route to the stack.
     *
     * @param  string $name
     * @param  mixed $route
     * @param  int $priority
     * @return RouteStackInterface
     */
    public function addRoute($name, $route, $priority = null)
    {
        $this->router->addRoute($name, $route, $priority);
        return $this;
    }

    /**
     * Add multiple routes to the stack.
     *
     * @param  array|\Traversable $routes
     * @return RouteStackInterface
     */
    public function addRoutes($routes)
    {
        $this->router->addRoutes($routes);
        return $this;
    }

    /**
     * Remove a route from the stack.
     *
     * @param  string $name
     * @return RouteStackInterface
     */
    public function removeRoute($name)
    {
        $this->router->removeRoute($name);
        return $this;
    }

    /**
     * Remove all routes from the stack and set new ones.
     *
     * @param  array|\Traversable $routes
     * @return RouteStackInterface
     */
    public function setRoutes($routes)
    {
        $this->router->setRoutes($routes);
        return $this;
    }

    /**
     * @param string $name Route name.
     */
    private function addDeferredRoute($name)
    {
        if (empty($this->deferredRoutes[$name])) {
            return;
        }

        /** @var Route $route */
        $route = $this->deferredRoutes[$name];

        if ($this->resolveIsSupportedRoute($route)) {
            $this->router->addRoute($route->getName(), $route->getRoute()->toArray());
            unset($this->deferredRoutes[$name]);
        }
    }

    /**
     * @return ServiceLocatorInterface|null
     */
    private function getRoutePlugins()
    {
        $routePlugins = null;
        if (method_exists($this->router, 'getRoutePluginManager')) {
            $routePlugins = $this->router->getRoutePluginManager();
        }

        if ($routePlugins instanceof ServiceLocatorInterface) {
            return $routePlugins;
        }

        return null;
    }

    /**
     * @param Route $route
     * @return bool
     */
    private function resolveIsSupportedRoute(Route $route)
    {
        $routePlugins = $this->getRoutePlugins();
        if (!$routePlugins) {
            return true;
        }

        $type = $route->getRoute()->getType();

        return isset($this->supportedRouteTypes[$type])
            ? $this->supportedRouteTypes[$type]
            : $this->supportedRouteTypes[$type] = $routePlugins->has($type);
    }
}
