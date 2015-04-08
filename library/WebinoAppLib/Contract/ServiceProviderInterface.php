<?php

namespace WebinoAppLib\Contract;

/**
 * Interface ServiceProviderInterface
 */
interface ServiceProviderInterface
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
     * @param string|object|\Zend\ServiceManager\FactoryInterface|callable|null $factory Adds invokable
     *                          when null factory, adds service when object
     * @return self
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
