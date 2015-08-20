<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\AppEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoEventLib\AbstractListener;
use Zend\Mvc\ResponseSender;
use Zend\Stdlib\ResponseInterface;

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
    }

    /**
     * @param DispatchEvent $event
     */
    public function sendResponse(DispatchEvent $event)
    {
        $response = $event->getResponse();
        empty($response) or $this->respond($response);
    }

    /**
     * @param ResponseInterface $response
     */
    private function respond(ResponseInterface $response)
    {
        $event = new ResponseSender\SendResponseEvent;
        $event->setResponse($response);

        foreach ($this->getResponders() as $responder) {
            $responder($event);
        }
    }

    /**
     * @return \Zend\Mvc\ResponseSender\ResponseSenderInterface[]
     */
    private function getResponders()
    {
        return [
            new ResponseSender\PhpEnvironmentResponseSender,
            new ResponseSender\ConsoleResponseSender,
            new ResponseSender\SimpleStreamResponseSender,
            new ResponseSender\HttpResponseSender,
        ];
    }
}
