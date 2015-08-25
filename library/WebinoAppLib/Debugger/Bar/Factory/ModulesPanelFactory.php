<?php

namespace WebinoAppLib\Debugger\Bar\Factory;

use WebinoAppLib\Application;
use WebinoAppLib\Debugger\Bar\ModulesPanel;
use WebinoAppLib\Factory\AbstractFactory;

/**
 * Class ModulesPanelFactory
 */
class ModulesPanelFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new ModulesPanel($this->getApp());
    }
}
