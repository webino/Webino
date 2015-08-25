<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Contract;
use WebinoAppLib\Service\Bootstrap;
use Zend\ServiceManager\ServiceManager;

/**
 * Class AbstractApplication
 */
abstract class AbstractApplication implements
    AbstractApplicationInterface,
    Contract\ConsoleInterface,
    Contract\DebuggerInterface,
    Contract\ServiceProviderInterface,
    Contract\ConfigInterface,
    Contract\EventEmitterInterface,
    Contract\LoggerInterface,
    Contract\CacheInterface,
    Contract\FilesystemInterface,
    Contract\RouterInterface
{
    use Traits\ConsoleTrait;
    use Traits\DebuggerTrait;
    use Traits\ServiceProviderTrait;
    use Traits\ConfigTrait;
    use Traits\EventEmitterTrait;
    use Traits\LoggerTrait;
    use Traits\CacheTrait;
    use Traits\FilesystemTrait;
    use Traits\RouterTrait;

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
        self::FILESYSTEMS,
        self::ROUTER,
    ];

    /**
     * @var Bootstrap
     */
    private $bootstrap;

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
}
