<?php

namespace Webino;

/**
 * Interface AppInterface
 * @package webino-app
 */
interface AppInterface extends
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
