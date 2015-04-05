<?php

namespace WebinoAppLib\Application;

/**
 * Interface ConfiguredApplicationInterface
 */
interface ConfiguredApplicationInterface
{
    /**
     * Dispatch the application
     *
     * @triggers dispatch
     * @return void
     */
    public function dispatch();
}
