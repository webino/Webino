<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Listener\Http;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Listener\AbstractRequestListener;
use Zend\Http\PhpEnvironment\Request;

/**
 * Class HttpRequestListener
 */
final class HttpRequestListener extends AbstractRequestListener
{
    /**
     * @param DispatchEvent $event
     */
    public function createRequest(DispatchEvent $event)
    {
        $event->setRequest(new Request);
    }
}
