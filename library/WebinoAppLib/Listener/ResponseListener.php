<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\SendResponseEvent;
use WebinoAppLib\Response\OnResponseInterface;
use WebinoEventLib\AbstractListener;
use Zend\Mvc\ResponseSender;

/**
 * Class ResponseListener
 */
final class ResponseListener extends AbstractListener
{
    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(AppEvent::DISPATCH, [$this, 'sendResponse'], AppEvent::FINISH * 999);
        $this->listen(SendResponseEvent::class, [$this, 'onResponse'], SendResponseEvent::BEGIN * 999);

        $this->listen(SendResponseEvent::class, new ResponseSender\SimpleStreamResponseSender);
        $this->listen(SendResponseEvent::class, new ResponseSender\HttpResponseSender);
        $this->listen(SendResponseEvent::class, new ResponseSender\ConsoleResponseSender);
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
