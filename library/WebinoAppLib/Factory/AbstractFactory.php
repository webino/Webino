<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
     * @var Application\AbstractApplication
     */
    private $app;

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
     * @return Application\AbstractApplication
     */
    protected function getApp()
    {
        if (null === $this->app) {
            $this->app = $this->services->get(Application::SERVICE);

            if (!($this->app instanceof Application\AbstractApplication)) {
                throw (new InvalidArgumentException('Expected app as %s but got %s'))
                    ->format(Application\AbstractApplication::class, $this->app);
            }
        }

        return $this->app;
    }

    /**
     * Return application configuration
     *
     * @param string $key Configuration value key
     * @return Config
     */
    protected function getConfig($key = null)
    {
        return $key ? $this->config->get($key) : $this->config;
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
        if ($this->services->has($service)) {
            return $this->services->get($service);
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
        $this->config   = $config;

        return $this->create();
    }
}
