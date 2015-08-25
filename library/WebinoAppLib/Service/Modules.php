<?php

namespace WebinoAppLib\Service;

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Exception;

/**
 * Class Modules
 */
class Modules
{
    private $app;

    /**
     * @var callable[]
     */
    private $loadedModules = [];

    /**
     * @param AbstractApplication $app
     */
    public function __construct(AbstractApplication $app)
    {
        $this->app = $app;
    }

    /**
     * @return \callable[]
     */
    public function getLoadedModules()
    {
        return $this->loadedModules;
    }
    /**
     * @param array $modules
     * @return $this
     */
    public function loadModules(array $modules)
    {
        foreach ($modules as $module) {
            $this->loadModule($module);
        }
        return $this;
    }

    /**
     * @param string $module
     * @return callable
     */
    public function loadModule($module)
    {
        if (isset($this->loadedModules[$module])) {
            return $this->loadedModules[$module];
        }

        if (!class_exists($module)) {
            throw (new Exception\DomainException('Can\'t find module `%s`'))
                ->format($module);
        }

        $obj = new $module;
        if (!is_callable($obj)) {
            throw (new Exception\InvalidArgumentException('Expected callable module but got %s'))
                ->format($obj);
        }

        call_user_func($obj, $this->app);
        $this->loadedModules[$module] = $obj;

        return $obj;
    }
}
