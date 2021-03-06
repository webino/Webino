<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Debugger\Bar\Factory;

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
