<?php

namespace Webino;

/**
 * Interface AppInterface
 */
interface AppInterface extends
    EventEmitterInterface,
    ServiceContainerInterface
{
    /**
     * @return void
     */
    public function bootstrap();

    /**
     * @return void
     */
    public function dispatch();
}
