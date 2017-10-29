<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
