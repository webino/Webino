<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoAppLib\Router\Url;
use WebinoAppLib\Service\Router;
use WebinoAppLib\Util\RouteEventNameResolver;
use Zend\Mvc\Router\RouteStackInterface;

/**
 * Trait Router
 */
trait RouterTrait
{
    /**
     * @return bool
     */
    abstract public function isHttp();

    /**
     * Return registered service
     *
     * @param string $service Service name
     * @return mixed
     * @throws \WebinoAppLib\Exception\UnknownServiceException
     */
    abstract public function get($service);

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
        if ($this->has(Router::class)) {
            return $this->get(Router::class);
        }

        $router = new Router($this->get(Application::ROUTER));
        $this->set(Router::class, $router);

        return $router;
    }

    /**
     * @see \WebinoAppLib\Contract\RouterInterface::url()
     * @param string $name
     * @param array $params
     * @return \WebinoAppLib\Router\UrlInterface
     */
    public function url($name = null, array $params = [])
    {
        return new Url($this->getRouter(), $params, ['name' => $name]);
    }

    /**
     * @TODO remove?, find usages, cause seems unused
     * @see \WebinoAppLib\Contract\RouterInterface::route()
     * @param string $name
     * @return Route
     */
    public function route($name)
    {
        // TODO interface
        return $this->getRouter()->deferRoute($name);
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
            ? $this->bind(RouteEventNameResolver::getEventName($name), $callback, $priority)
            : null;
    }
}
