<?php

namespace WebinoAppLib\Application\Traits;

use ArrayObject;
use WebinoAppLib\Application;
use WebinoAppLib\Router\Url;
use WebinoAppLib\Service\Router;
use WebinoAppLib\Util\RouteEventNameResolver;
use WebinoConfigLib\Feature\Route;
use Zend\Console\Console;
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
     * @return bool
     */
    abstract public function isHttp();

    /**
     * {@inheritdoc}
     */
    abstract public function bind($event, $callback = null, $priority = 1);

    /**
     * Require service from services into application
     *
     * @param string $service Service name
     * @throws DomainException Unable to get service
     */
    abstract protected function requireService($service);

    /**
     * @see \WebinoAppLib\Contract\RouterInterface::getRouter()
     * @return RouteStackInterface
     */
    public function getRouter()
    {
        if (null === $this->router) {
            $this->requireService(Application::ROUTER);
        }
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
        return $this->isHttp()
            ? $this->bind(call_user_func(RouteEventNameResolver::getInstance(), $name), $callback, $priority)
            : null;
    }
}
