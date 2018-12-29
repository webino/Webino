<?php

namespace Webino;

use Psr\Log\LoggerInterface;

/**
 * Interface AppInterface
 * @package webino-app
 */
interface AppInterface extends
    LoggerInterface,
    EventEmitterInterface,
    InstanceContainerInterface,
    FilesystemInterface
{
    /**
     * @return void
     */
    function bootstrap();

    /**
     * @return void
     */
    function dispatch();
}
