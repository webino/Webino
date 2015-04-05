<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Application;
use WebinoAppLib\Exception\DomainException;
use WebinoAppLib\Exception\InvalidArgumentException;
use Zend\Config\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;

/**
 * Class AbstractFactory
 */
abstract class AbstractFactory implements FactoryInterface
{
    /**
     * @var ServiceManager
     */
    private $services;

    /**
     * @var Config
     */
    private $config;

    /**
     * Create a service
     *
     * @return mixed
     */
    protected abstract function create();

    /**
     * Return service manager
     *
     * @return ServiceManager
     */
    protected function getServices()
    {
        return $this->services;
    }

    /**
     * Return application configuration
     *
     * @param string $key Configuration value key
     * @return Config
     */
    protected function getConfig($key = null)
    {
        if ($key) {
            return $this->config->get($key);
        }
        return $this->config;
    }

    /**
     * Return configuration section
     *
     * @param string $section
     * @return mixed
     */
    protected function requireConfig($section)
    {
        if ($this->config->offsetExists($section)) {
            return $this->config->$section;
        }

        throw (new DomainException('Unable require configuration section %s for %s'))
            ->format($section, static::class);
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
        if ($services->has($service)) {
            return $services->get($service);
        }

        throw (new DomainException('Unable require service %s for %s'))
            ->format($service, static::class);
    }

    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $services)
    {
        if (!($services instanceof ServiceManager)) {
            throw (new InvalidArgumentException('Expected services as %s but got %s'))
                ->format(ServiceManager::class, $services);
        }

        $config = $services->get(Application::CONFIG);
        if (!($config instanceof Config)) {
            throw (new InvalidArgumentException('Expected config as %s but got %s'))
                ->format(Config::class, $config);
        }

        $this->services = $services;
        $this->config = $config;
        return $this->create();
    }
}
