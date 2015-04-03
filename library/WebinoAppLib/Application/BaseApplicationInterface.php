<?php

namespace WebinoAppLib\Application;

/**
 * Interface BaseApplicationInterface
 */
interface BaseApplicationInterface extends ApplicationInterface
{
    /**
     * Bootstrap the application
     *
     * Returns configured application ready to dispatch.
     *
     * @return ConfiguredApplicationInterface
     */
    public function bootstrap();
}
