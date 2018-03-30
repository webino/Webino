<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\App\Application;

use Webino\App\Context;
use Webino\App\Factory;
use Webino\App\Feature;
use Webino\App\Listener;
use Webino\App\Service;
use Webino\Log\Factory as LoggerFactory;

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
            new Feature\DefaultRouting,
            new Feature\DefaultView,

            new Feature\CoreService(Application::BOOTSTRAP, Factory\BootstrapFactory::class),
            new Feature\CoreService(Application::SERVICE, Factory\ApplicationFactory::class),
            new Feature\CoreService(Application::EVENTS, Factory\EventsFactory::class),
            new Feature\CoreService(Application::LOGGER, Factory\LoggerFactory::class),
            new Feature\CoreService(Application::FILESYSTEMS, Factory\FilesystemsFactory::class),
            new Feature\CoreService(Application::MAILER, Factory\MailerFactory::class),

            new Feature\CoreService(LoggerFactory::class),

            new Feature\ServiceInitializer(Service\Initializer\RoutingAwareInitializer::class),

            new Context\HttpContext,
            new Context\ConsoleContext,

            new Feature\Listener(Listener\ContextListener::class),

            new Feature\HttpListener(Listener\Http\HttpRequestListener::class),
            new Feature\HttpListener(Listener\Http\HttpResponseListener::class),

            new Feature\ConsoleListener(Listener\Console\ConsoleRequestListener::class),
            new Feature\ConsoleListener(Listener\Console\ConsoleResponseListener::class),

            new Feature\Service(Service\Credits::class)
        ]);

        parent::__construct($config);
    }
}
