<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Contract;
use WebinoAppLib\Exception\DomainException;
use WebinoAppLib\Service\DebuggerInterface;
use WebinoAppLib\Service\LoggerInterface;
use WebinoAppLib\Service\NullDebugger;
use WebinoAppLib\Service\Bootstrap;
use Zend\Cache\Storage\Adapter\BlackHole;
use Zend\Cache\Storage\StorageInterface;
use Zend\Config\Config;
use Zend\EventManager\EventManager;
use Zend\ServiceManager\ServiceManager;

/**
 * Class AbstractApplication
 */
abstract class AbstractApplication implements
    AbstractApplicationInterface,
    Contract\ServiceProviderInterface,
    Contract\EventEmitterInterface,
    Contract\LoggerInterface
{
    use Traits\ServiceProviderTrait;
    use Traits\EventEmitterTrait;
    use Traits\LoggerTrait;

    /**
     * Application bootstrap service name
     */
    const BOOTSTRAP = 'Bootstrap';

    /**
     * Required services
     *
     * @var array
     */
    private $requiredServices = [
        self::CONFIG,
        self::EVENTS,
    ];

    /**
     * Optional services
     *
     * @var array
     */
    private $optionalServices = [
        self::DEBUGGER,
        self::LOGGER,
        self::CACHE,
    ];

    /**
     * @var ServiceManager
     */
    private $services;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var EventManager
     */
    private $events;

    /**
     * @var Bootstrap
     */
    private $bootstrap;

    /**
     * @var DebuggerInterface
     */
    private $debugger;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var StorageInterface
     */
    private $cache;

    /**
     * @param ServiceManager $services
     */
    public function __construct(ServiceManager $services)
    {
        $this->services = $services;
        foreach ($this->requiredServices as $service) {
            $this->requireService($service);
        }

        foreach ($this->optionalServices as $service) {
            $this->optionalService($service);
        }
    }

    /**
     * Require service from services into application
     *
     * @param string $service Service name
     * @throws DomainException Unable to get service
     */
    protected function requireService($service)
    {
        if (!$this->getServices()->has($service)) {
            throw (new DomainException('Unable to get required application service %s'))->format($service);
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
        $this->getServices()->has($service)
            and $this->setService($service);
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
    private function setServicesService($name, $service)
    {
        $this->services
            ->setAllowOverride(true)
            ->setService($name, $service)
            ->setAllowOverride(false);
    }

    /**
     * @return ServiceManager
     */
    public function getServices()
    {
        return $this->services;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param object|Config $config
     * @param bool $setService
     * @throws DomainException Disallowed config modifications
     */
    protected function setConfig(Config $config, $setService = true)
    {
        if ($this->config && $this->config->isReadOnly()) {
            throw new DomainException(
                'Unable to set new application configuration; restricted to read only'
            );
        }

        $this->config = $config;
        $setService and $this->setServicesService($this::CONFIG, $config);
    }

    /**
     * @return EventManager
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * @param object|EventManager $events
     */
    protected function setEvents(EventManager $events)
    {
        $this->events = $events;
    }

    /**
     * @return Bootstrap
     */
    protected function getBootstrap()
    {
        return $this->bootstrap;
    }

    /**
     * @param Bootstrap $bootstrap
     */
    protected function setBootstrap(Bootstrap $bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    /**
     * @return object|DebuggerInterface
     */
    public function getDebugger()
    {
        if (null === $this->debugger) {
            $this->setDebugger(new NullDebugger);
        }
        return $this->debugger;
    }

    /**
     * @param object|DebuggerInterface $debugger
     * @param bool $setService
     */
    protected function setDebugger(DebuggerInterface $debugger, $setService = true)
    {
        $this->debugger = $debugger;
        $setService and $this->setServicesService($this::DEBUGGER, $debugger);
    }

    /**
     * @return object|LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param LoggerInterface $logger
     */
    protected function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return StorageInterface
     */
    public function getCache()
    {
        if (null === $this->cache) {
            $this->setCache(new BlackHole);
        }
        return $this->cache;
    }

    /**
     * @param object|StorageInterface $cache
     * @param bool $setService
     */
    protected function setCache(StorageInterface $cache, $setService = true)
    {
        $this->cache = $cache;
        $setService and $this->setServicesService($this::CACHE, $cache);
    }
}
