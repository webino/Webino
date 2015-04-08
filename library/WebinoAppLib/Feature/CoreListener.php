<?php

namespace WebinoAppLib\Feature;

/**
 * Class CoreListener
 */
class CoreListener extends Listener
{
    /**
     * Configure an application core listener
     * {@inheritdoc}
     */
    public function __construct($listener, $factoryClass = null)
    {
        parent::__construct($listener, $factoryClass);
        $this->getData()->exchangeArray([Config::CORE => parent::toArray()]);
    }
}
