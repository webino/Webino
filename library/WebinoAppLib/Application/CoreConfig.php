<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature;
use WebinoEventLib\EventManager;

/**
 * Class CoreConfig
 */
class CoreConfig extends Feature\Config
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->addFeatures([
            new Feature\Debugger,
            new Feature\DefaultFilesystem,
            new Feature\DefaultRouter,
            new Feature\CoreService([Factory\EventsFactory::ENGINE => EventManager::class]),
            new Feature\CoreService(Application::SERVICE, Factory\ApplicationFactory::class),
            new Feature\CoreService(Application::EVENTS, Factory\EventsFactory::class),
            new Feature\CoreService(Application::BOOTSTRAP, Factory\BootstrapFactory::class),
            new Feature\CoreService(Application::LOGGER, Factory\LoggerFactory::class),
            new Feature\CoreService(Application::FILESYSTEM, Factory\FilesystemFactory::class),
        ]);

        parent::__construct($config);
    }
}
