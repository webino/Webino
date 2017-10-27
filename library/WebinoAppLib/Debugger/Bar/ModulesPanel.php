<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
     * @var AbstractApplication
     */
    private $app;

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
