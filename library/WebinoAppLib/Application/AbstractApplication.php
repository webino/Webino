<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Contract;
use WebinoAppLib\Service\DebuggerInterface;
use WebinoAppLib\Service\NullDebugger;
use WebinoAppLib\Service\Bootstrap;
use Zend\ServiceManager\ServiceManager;

/**
 * Class AbstractApplication
 */
abstract class AbstractApplication implements
    AbstractApplicationInterface,
    Contract\ServiceProviderInterface,
    Contract\ConfigInterface,
    Contract\EventEmitterInterface,
    Contract\LoggerInterface,
    Contract\CacheInterface,
    Contract\FilesystemInterface
{
    use Traits\ServiceProviderTrait;
    use Traits\ConfigTrait;
    use Traits\EventEmitterTrait;
    use Traits\LoggerTrait;
    use Traits\CacheTrait;
    use Traits\FilesystemTrait;

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
        self::FILESYSTEM,
    ];

    /**
     * @var Bootstrap
     */
    private $bootstrap;

    /**
     * @var DebuggerInterface
     */
    private $debugger;

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
}
