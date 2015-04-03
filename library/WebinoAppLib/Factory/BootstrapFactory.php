<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Application;
use WebinoAppLib\Service\Bootstrap;

/**
 * Class BootstrapFactory
 */
class BootstrapFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    protected function create()
    {
        return new Bootstrap($this->requireService(Application::SERVICE));
    }
}
