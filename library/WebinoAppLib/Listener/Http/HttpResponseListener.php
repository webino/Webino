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
use WebinoAppLib\Event\SendResponseEvent;
use WebinoAppLib\Listener\AbstractResponseListener;
use WebinoAppLib\Response\HtmlResponse;
use Zend\Mvc\ResponseSender\HttpResponseSender;

/**
 * Class HttpResponseListener
 */
final class HttpResponseListener extends AbstractResponseListener
{
    /**
     * @param DispatchEvent $event
     */
    public function createResponse(DispatchEvent $event)
    {
        $event->setResponse(new HtmlResponse);
    }

    /**
     * Initialize listener
     */
    public function init()
    {
        parent::init();
        $this->listen(SendResponseEvent::class, new HttpResponseSender);
    }
}
