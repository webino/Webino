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
