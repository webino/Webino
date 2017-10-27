<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Exception;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Trait ServiceProviderTrait
 */
trait ServicesTrait
{
    /**
     * @var ServiceManager
     */
    private $services;

    /**
     * @return ServiceManager
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * Return registered service
     *
     * @param string $service Service name
     * @return mixed
     * @throws Exception\UnknownServiceException
     */
    public function get($service)
    {
        try {
            return $this->getServices()->get($service);
        } catch (ServiceNotFoundException $exc) {
            throw (new Exception\UnknownServiceException('Unable to get an instance for %s', null, $exc))
                ->format($service);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set($service, $factory = null)
    {
        $services = $this->getServices();

        if ($factory instanceof FactoryInterface
            || is_callable($factory)
            || (is_string($factory) && class_exists($factory))
        ) {
            // factory
            $services->setFactory($service, $factory);
            return $this;
        }

        if (null !== $factory && is_string($service)) {
            // service object
            $services->setService($service, $factory);
            return $this;
        }

        // invokable
        if (is_array($service)) {
            $services->setInvokableClass(key($service), current($service));
        } elseif (is_string($service)) {
            $services->setInvokableClass($service, $service);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has($service)
    {
        return $this->getServices()->has((string) $service);
    }

    /**
     * Require service from services into application
     *
     * @param string $service Service name
     * @throws Exception\DomainException Unable to get service
     */
    protected function requireService($service)
    {
        if (!$this->services->has($service)) {
            throw (new Exception\DomainException('Unable to get required application service %s'))->format($service);
        }

        $this->setService($service);
    }

    /**
     * Set optional service from services into application
     *
     * @param string $service Service name
     */
    protected function optionalService($service)
    {
        $this->services->has($service) and $this->setService($service);
    }

    /**
     * @param $service
     */
    private function setService($service)
    {
        call_user_func([$this, 'set' . $service], $this->services->get($service), false);
    }

    /**
     * @param string $name
     * @param mixed $service
     */
    protected function setServicesService($name, $service)
    {
        $this->services
            ->setAllowOverride(true)
            ->setService($name, $service)
            ->setAllowOverride(false);
    }
}
