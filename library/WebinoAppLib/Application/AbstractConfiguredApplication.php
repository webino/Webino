<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application;

use WebinoAppLib\Event\DispatchEvent;

/**
 * Class AbstractConfiguredApplication
 */
class AbstractConfiguredApplication extends AbstractApplication implements
    ConfiguredApplicationInterface
{
    /**
     * {@inheritdoc}
     */
    public function dispatch()
    {
        $this->emit(new DispatchEvent($this));
    }
}
