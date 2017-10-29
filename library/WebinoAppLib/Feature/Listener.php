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
 * Class Listener
 */
class Listener extends AbstractFeature
{
    /**
     * Configure an application listener
     *
     * @param string|array $listener Listener class name or an array like [ListenerAlias => ListenerClass]
     * @param string $factoryClass Listener factory class name
     */
    public function __construct($listener, $factoryClass = null)
    {
        is_array($listener)
            or $listener = [$listener => $listener];

        $key = current($listener);

        $service = is_null($factoryClass)
                 ? [Config::INVOKABLES => [$key => $key]]
                 : [Config::FACTORIES => [$key => $factoryClass]];

        parent::__construct([
            [
                Config::LISTENERS => $listener,
                Config::SERVICES  => $service,
            ]
        ]);
    }
}
