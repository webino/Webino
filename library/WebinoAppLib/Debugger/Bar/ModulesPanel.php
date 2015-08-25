<?php

namespace WebinoAppLib\Debugger\Bar;

use WebinoAppLib\Application\AbstractApplication;
use WebinoAppLib\Service\Modules;

/**
 * Class ModulesPanel
 */
class ModulesPanel extends AbstractPanel
{
    /**
     * Modules panel name
     */
    const NAME = 'Webino:modules';

    /**
     * @return string
     */
    protected function getTitle()
    {
        return 'Loaded modules';
    }

    /**
     * @param AbstractApplication $app
     */
    public function __construct(AbstractApplication $app)
    {
        $this->app = $app;
    }

    /**
     * @return array
     */
    public function getModules()
    {
        /** @var Modules $modules */
        $modules = $this->app->get(Modules::class);

        $loadedModules = [];
        foreach ($modules->getLoadedModules() as $name => $module) {
            $loadedModules[$name] = defined(get_class($module) . '::VERSION') ? $module::VERSION : '-';
        }

        return $loadedModules;
    }

    /**
     * {@inheritdoc}
     */
    public function getTab()
    {
        return $this->createIcon('modules', ['top' => '2px']) . parent::getTab();
    }

    /**
     * {@inheritdoc}
     */
    public function getPanel()
    {
        return $this->renderTemplate('modules');
    }
}
