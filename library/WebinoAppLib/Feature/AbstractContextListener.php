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

use WebinoAppLib\Context\AbstractContext;

/**
 * Class AbstractContextListener
 */
abstract class AbstractContextListener extends Listener
{
    /**
     * @return string
     */
    abstract protected function getKey();

    /**
     * @return array
     */
    public function toArray()
    {
        $cfg = parent::toArray();
        return array_merge(
            [Config::SERVICES => $cfg[Config::SERVICES]],
            [AbstractContext::CONTEXT => [$this->getKey() => [Config::LISTENERS => $cfg[Config::LISTENERS]]]]
        );
    }
}
