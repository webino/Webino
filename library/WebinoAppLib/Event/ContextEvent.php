<?php

namespace WebinoAppLib\Event;

use WebinoAppLib\Application\AbstractApplication;
use Zend\Config\Config;

/**
 * Class ContextEvent
 */
class ContextEvent extends AppEvent
{
    /**
     * @var string
     */
    private $context;

    /**
     * @var Config
     */
    private $contextConfig;

    /**
     * @param string $context
     * @param Config $contextConfig
     * @param AbstractApplication $app
     */
    public function __construct($context, Config $contextConfig, AbstractApplication $app)
    {
        parent::__construct(self::class);
        $this->setApp($app);
        $this->context = (string) $context;
        $this->contextConfig = $contextConfig;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @return Config
     */
    public function getContextConfig()
    {
        return $this->contextConfig;
    }
}
