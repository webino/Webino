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

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class Service
 */
class Service extends AbstractFeature
{
    /**
     * Configure an application service
     *
     * @param string|array $service Service name or array like [ServiceAlias => ServiceInvokableClass]
     * @param string $factoryClass Optional service factory class
     */
    public function __construct($service, $factoryClass = null)
    {
        $service = (null === $factoryClass)
                 ? [Config::INVOKABLES => is_array($service) ? $service : [$service => $service]]
                 : [Config::FACTORIES => [$service => $factoryClass]];

        parent::__construct([[Config::SERVICES => $service]]);
    }
}
