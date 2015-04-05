<?php

namespace WebinoAppLib\Application;

/**
 * Interface BaseApplicationInterface
 */
interface BaseApplicationInterface
{
    /**
     * Bootstrap the application
     *
     * Returns configured application ready to dispatch.
     *
     * @return AbstractConfiguredApplication
     */
    public function bootstrap();
}
