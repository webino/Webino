<?php

namespace WebinoAppLib\Module;

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Service\Modules;

/**
 * Class AbstractModule
 */
abstract class AbstractModule
{
    /**
     * @param AbstractApplication $app
     */
    public function __invoke(AbstractApplication $app)
    {
        /** @var Modules $modules */
        $modules = $app->get(Modules::class);
        $modules->loadModules($this->getDependencies());

        $app->onConfig(function () {
            return $this->getConfig();
        });

        $this->init($app);
    }

    /**
     * Initialize your module
     *
     * @param AbstractApplication $app
     */
    protected function init(AbstractApplication $app)
    {

    }

    /**
     * Return array of your module dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [];
    }

    /**
     * Return your module config array
     *
     * This function will be called only when the application
     * configuration is not loaded from a cache.
     *
     * @return array
     */
    public function getConfig()
    {
        return [];
    }
}
