<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Service\Modules;

/**
 * Class ModulesFactory
 */
class ModulesFactory extends AbstractFactory
{
    /**
     * @return Modules
     */
    public function create()
    {
        return new Modules($this->getApp());
    }
}
