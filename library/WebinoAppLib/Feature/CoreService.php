<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Feature;

/**
 * Class CoreService
 */
class CoreService extends Service
{
    /**
     * Configure an application core service
     *
     * {@inheritDoc}
     */
    public function __construct($service, $factoryClass = null)
    {
        parent::__construct($service, $factoryClass);
        $this->getData()->exchangeArray([Config::CORE => parent::toArray()]);
    }
}
