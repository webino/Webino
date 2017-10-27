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
 * Interface ServiceProviderInterface
 */
interface ServicesInterface
{
    /**
     * Return registered service
     *
     * @param string $service Service name
     * @return mixed
     * @throws \WebinoAppLib\Exception\UnknownServiceException
     */
    public function get($service);

    /**
     * Register new service via factory
     *
     * @param string|array $service Service name, or use array [name => class] to set the invokable
     * @param string|\Zend\ServiceManager\FactoryInterface|callable|object|null $factory Adds invokable
     *                          when null factory, adds service when object
     * @return $this
     */
    public function set($service, $factory = null);

    /**
     * Determine if a service exists
     *
     * @param  string $service Service name
     * @return bool
     */
    public function has($service);
}
