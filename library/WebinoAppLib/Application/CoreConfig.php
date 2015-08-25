<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature;
use WebinoAppLib\Listener;
use WebinoEventLib\EventManager;
use WebinoLogLib\Factory as LogLibFactory;

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
            new Feature\DefaultDebugger,
            new Feature\DefaultConsole,
            new Feature\DefaultFilesystem,
            new Feature\DefaultRouter,
            new Feature\CoreService([Factory\EventsFactory::ENGINE => EventManager::class]),
            new Feature\CoreService(Application::SERVICE, Factory\ApplicationFactory::class),
            new Feature\CoreService(Application::EVENTS, Factory\EventsFactory::class),
            new Feature\CoreService(Application::BOOTSTRAP, Factory\BootstrapFactory::class),
            new Feature\CoreService(Application::LOGGER, Factory\LoggerFactory::class),
            new Feature\CoreService(Application::FILESYSTEMS, Factory\FilesystemFactory::class),

            new Feature\CoreService(LogLibFactory::class),
            new Feature\CoreService(Factory\ResponseFactory::class, Factory\ResponseFactory::class),

            new Feature\Listener(Listener\RequestListener::class),
            new Feature\Listener(Listener\ResponseListener::class),
            new Feature\Listener(Listener\ViewListener::class),
        ]);

        parent::__construct($config);
    }
}
