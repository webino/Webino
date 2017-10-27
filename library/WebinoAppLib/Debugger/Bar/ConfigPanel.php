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

use WebinoAppLib\Service\DebuggerInterface;
use Zend\Config\Config;

/**
 * Class ConfigPanel
 */
class ConfigPanel extends AbstractPanel
{
    /**
     * Config panel name
     */
    const NAME = 'Webino:config';

    /**
     * @var Config
     */
    private $config;

    /**
     * @var DebuggerInterface
     */
    private $debugger;

    /**
     * @return string
     */
    protected function getTitle()
    {
        return 'Application config';
    }

    /**
     * @param object|Config $config
     * @param object|DebuggerInterface $debugger
     */
    public function __construct(Config $config, DebuggerInterface $debugger)
    {
        $this->config   = $config;
        $this->debugger = $debugger;
    }

    /**
     * {@inheritdoc}
     */
    public function getTab()
    {
        return $this->createIcon('config',[ 'margin-top' => '5px']) . parent::getTab();
    }

    /**
     * {@inheritdoc}
     */
    public function getPanel()
    {
        $this->setContent($this->debugger->dump($this->config->toArray(), true));
        return $this->renderTemplate('config');
    }
}
