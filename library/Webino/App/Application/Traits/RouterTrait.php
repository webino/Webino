<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\App\Application\Traits;

use Webino\App\Application;
use Webino\App\Router\Url;
use Webino\App\Service\Router;
use Webino\App\Util\RouteEventNameResolver;
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
     * @throws \Webino\App\Exception\UnknownServiceException
     */
    abstract public function get($service);

    /**
     * {@inheritdoc}
     */
    abstract public function bind($event, $callback = null, $priority = 1);

    /**
     * @see \Webino\App\Contract\RouterInterface::getRouter()
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
     * @see \Webino\App\Contract\RouterInterface::url()
     * @param string $name
     * @param array $params
     * @return \Webino\App\Router\UrlInterface
     */
    public function url($name = null, array $params = [])
    {
        return new Url($this->getRouter(), $params, ['name' => $name]);
    }

    /**
     * @TODO remove?, find usages, cause seems unused
     * @see \Webino\App\Contract\RouterInterface::route()
     * @param string $name
     * @return Route
     */
    public function route($name)
    {
        // TODO interface
        return $this->getRouter()->deferRoute($name);
    }

    /**
     * @see \Webino\App\Contract\RouterInterface::bindRoute()
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
