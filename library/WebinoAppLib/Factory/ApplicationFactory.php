<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Application;

/**
 * Class ApplicationFactory
 */
class ApplicationFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    protected function create()
    {
        return new Application($this->getServices());
    }
}
