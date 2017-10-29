<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\SendResponseEvent;
use WebinoAppLib\Response\OnResponseInterface;
use WebinoEventLib\AbstractListener;
use Zend\Mvc\ResponseSender;

/**
 * Class AbstractResponseListener
 */
abstract class AbstractResponseListener extends AbstractListener
{
    /**
     * @param DispatchEvent $event
     * @return void
     */
    abstract public function createResponse(DispatchEvent $event);

    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(DispatchEvent::DISPATCH, [$this, 'createResponse'], DispatchEvent::BEGIN * 999);
        $this->listen(DispatchEvent::DISPATCH, [$this, 'onResponse'], DispatchEvent::AFTER);
        $this->listen(DispatchEvent::DISPATCH, [$this, 'sendResponse'], DispatchEvent::FINISH * 999);
        $this->listen(SendResponseEvent::class, new ResponseSender\SimpleStreamResponseSender);
    }

    /**
     * @param DispatchEvent $event
     */
    public function sendResponse(DispatchEvent $event)
    {
        $response = $event->getResponse();
        $responseEvent = new SendResponseEvent($event);
        $responseEvent->setResponse($response);
        $event->getApp()->emit($responseEvent);
    }

    /**
     * @param DispatchEvent $event
     */
    public function onResponse(DispatchEvent $event)
    {
        $response = $event->getResponse();
        $response instanceof OnResponseInterface and $response->onResponse($event);
    }
}
