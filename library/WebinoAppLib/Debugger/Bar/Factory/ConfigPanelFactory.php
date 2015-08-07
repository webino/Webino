<?php

namespace WebinoAppLib\Debugger\Bar\Factory;

use WebinoAppLib\Application;
use WebinoAppLib\Debugger\Bar\ConfigPanel;
use WebinoAppLib\Factory\AbstractFactory;

/**
 * Class ConfigPanelFactory
 */
class ConfigPanelFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    public function create()
    {
        return new ConfigPanel(
            $this->getConfig(),
            $this->getApp()->getDebugger()
        );
    }
}
