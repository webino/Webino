<?php

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
    protected function getLabel()
    {
        return 'Config';
    }

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
        return $this->createIcon('config', 'top: -3px;') . parent::getTab();
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
