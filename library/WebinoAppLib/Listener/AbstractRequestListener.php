<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\DispatchEvent;
use WebinoEventLib\AbstractListener;

/**
 * Class AbstractRequestListener
 */
abstract class AbstractRequestListener extends AbstractListener
{
    /**
     * @param DispatchEvent $event
     * @return void
     */
    abstract public function createRequest(DispatchEvent $event);

    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(DispatchEvent::DISPATCH, [$this, 'createRequest'], DispatchEvent::BEGIN * 999);
    }
}
