<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Exception\UnknownServiceException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Trait ServiceProviderTrait
 */
trait ServiceProviderTrait
{
    /**
     * @return ServiceManager
     */
    abstract public function getServices();

    /**
     * {@inheritdoc}
     */
    public function get($service)
    {
        try {
            return $this->getServices()->get($service);
        } catch (ServiceNotFoundException $exc) {
            throw (new UnknownServiceException('Unable to get an instance for %s', null, $exc))
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
            || $factory instanceof \Closure
            || is_string($factory)
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
        is_array($service)
            and $services->setInvokableClass(key($service), current($service))
            or  $services->setInvokableClass($service, $service);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has($service)
    {
        return $this->getServices()->has((string) $service);
    }
}
