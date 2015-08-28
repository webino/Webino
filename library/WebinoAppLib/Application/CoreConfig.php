<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Application;
use WebinoAppLib\Context;
use WebinoAppLib\Factory;
use WebinoAppLib\Feature;
use WebinoAppLib\Listener;
use WebinoAppLib\Listener\ContextListener;
use WebinoLogLib\Factory as LoggerFactory;

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

            new Feature\CoreService(Application::BOOTSTRAP, Factory\BootstrapFactory::class),
            new Feature\CoreService(Application::SERVICE, Factory\ApplicationFactory::class),
            new Feature\CoreService(Application::EVENTS, Factory\EventsFactory::class),
            new Feature\CoreService(Application::LOGGER, Factory\LoggerFactory::class),
            new Feature\CoreService(Application::FILESYSTEMS, Factory\FilesystemsFactory::class),

            new Feature\CoreService(LoggerFactory::class),

            new Context\HttpContext,
            new Context\ConsoleContext,

            new Feature\Listener(ContextListener::class),

            new Feature\HttpListener(Listener\HttpRequestListener::class),
            new Feature\HttpListener(Listener\HttpResponseListener::class),

            new Feature\ConsoleListener(Listener\ConsoleRequestListener::class),
            new Feature\ConsoleListener(Listener\ConsoleResponseListener::class),
        ]);

        parent::__construct($config);
    }
}
