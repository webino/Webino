<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Contract;

/**
 * Interface RouterInterface
 */
interface RouterInterface
{
    /**
     * Accessing a router service
     *
     * @return \Zend\Mvc\Router\RouteStackInterface
     */
    public function getRouter();

    /**
     * Adding routes runtime
     *
     * @see \WebinoAppLib\Contract\RouterInterface::route()
     * @param string $name Route name
     * @return \WebinoConfigLib\Feature\Route
     */
    public function route($name);

    /**
     * Binding listener to a route
     *
     * @param string $name Route name
     * @param string|callable|int $callback If string $event provided, expects PHP callback;
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed CallbackHandler if attaching callable;
     *          mixed if attaching aggregate
     */
    public function bindRoute($name, $callback = null, $priority = 1);

    /**
     * Generating route URL
     *
     * @param string $name Route name
     * @param array $params
     * @return \WebinoAppLib\Router\UrlInterface
     */
    public function url($name, array $params = []);
}
