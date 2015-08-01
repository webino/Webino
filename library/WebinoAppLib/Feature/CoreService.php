<?php

namespace WebinoAppLib\Feature;

/**
 * Class CoreService
 */
class CoreService extends Service
{
    /**
     * Configure an application core service
     * {@inheritDoc}
     */
    public function __construct($service, $factoryClass = null)
    {
        parent::__construct($service, $factoryClass);
        $this->getData()->exchangeArray([Config::CORE => parent::toArray()]);
    }
}
