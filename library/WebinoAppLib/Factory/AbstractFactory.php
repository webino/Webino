<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Exception\DomainException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AbstractFactory
 */
abstract class AbstractFactory implements FactoryInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    private $services;

    /**
     * Create a service
     *
     * @return mixed
     */
    protected abstract function create();

    /**
     * Return service manager
     *
     * @return ServiceLocatorInterface
     */
    protected function getServices()
    {
        return $this->services;
    }

    /**
     * Return service or throw an exception
     *
     * @param string $service
     * @return mixed
     * @throws DomainException Unable to require a service
     */
    protected function requireService($service)
    {
        $services = $this->getServices();
        if (!$services->has($service)) {
            throw (new DomainException('Unable require service %s for %s'))
                ->format($service, static::class);
        }

        return $services->get($service);
    }

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $this->services = $services;
        return $this->create();
    }
}
