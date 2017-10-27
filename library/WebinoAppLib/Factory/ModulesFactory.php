<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
