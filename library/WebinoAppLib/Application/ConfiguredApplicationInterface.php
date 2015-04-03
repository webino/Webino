<?php

namespace WebinoAppLib\Application;

/**
 * Interface ConfiguredApplicationInterface
 */
interface ConfiguredApplicationInterface extends ApplicationInterface
{
    /**
     * Dispatch an application
     *
     * @return void
     */
    public function dispatch();
}
