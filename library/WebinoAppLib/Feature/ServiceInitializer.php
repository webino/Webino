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
 * Class ServiceInitializer
 */
class ServiceInitializer extends AbstractFeature
{
    /**
     * Configure an application service initializer
     *
     * @param string $class Initializer class
     */
    public function __construct($class)
    {
        parent::__construct([Config::CORE => [Config::SERVICES => [Config::INITIALIZERS => [$class => $class]]]]);
    }
}
