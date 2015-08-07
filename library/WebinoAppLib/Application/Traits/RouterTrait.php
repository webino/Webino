<?php

namespace WebinoAppLib\Application\Traits;

use ArrayObject;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Event\RouteEventNameResolver;
use WebinoAppLib\Router\Url;
use WebinoAppLib\Service\Router;
use WebinoConfigLib\Feature\Route;
use Zend\Mvc\Router\RouteStackInterface;

/**
 * Trait Router
 */
trait RouterTrait
{
    /**
     * @var RouteStackInterface
     */
    private $router;

    /**
     * @var ArrayObject<Routes>
     */
    private $routes;

    /**
     * {@inheritdoc}
     */
    abstract public function bind($event, $callback = null, $priority = 1);

    /**
     * @see \WebinoAppLib\Contract\RouterInterface::getRouter()
     * @return RouteStackInterface
     */
    public function getRouter()
    {
        return $this->router;
    }

    /**
     * @param RouteStackInterface $router
     */
    protected function setRouter(RouteStackInterface $router)
    {
        $this->routes = new ArrayObject;
        $this->router = new Router($router, $this->routes);
    }

    /**
     * @see \WebinoAppLib\Contract\RouterInterface::url()
     * @param string $name
     * @param array $params
     * @return \WebinoAppLib\Router\UrlInterface
     */
    public function url($name, array $params = [])
    {
        return new Url($this->router, $params, ['name' => $name]);
    }

    /**
     * @see \WebinoAppLib\Contract\RouterInterface::route()
     * @param string $name
     * @return Route
     */
    public function route($name)
    {
        if (empty($this->routes[$name])) {
            $this->routes[$name] = new Route($name);
        }
        return $this->routes[$name];
    }

    /**
     * @see \WebinoAppLib\Contract\RouterInterface::bindRoute()
     * @param string $name
     * @param string|callable|int $callback
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed
     */
    public function bindRoute($name, $callback = null, $priority = 1)
    {
        return $this->bind((new RouteEventNameResolver)->__invoke($name), $callback, $priority);
    }
}
