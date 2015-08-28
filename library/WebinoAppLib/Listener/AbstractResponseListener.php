<?php

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
        $this->listen(DispatchEvent::DISPATCH, [$this, 'sendResponse'], DispatchEvent::FINISH * 999);
        $this->listen(SendResponseEvent::class, [$this, 'onResponse'], SendResponseEvent::BEGIN * 999);
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
     * @param SendResponseEvent $event
     */
    public function onResponse(SendResponseEvent $event)
    {
        $response = $event->getResponse();
        $response instanceof OnResponseInterface and $response->onResponse($event);
    }
}
