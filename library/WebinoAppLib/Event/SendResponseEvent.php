<?php

namespace WebinoAppLib\Event;

use WebinoEventLib\EventInterface;
use Zend\Mvc\ResponseSender\SendResponseEvent as BaseSendResponseEvent;
use Zend\Stdlib\RequestInterface;

/**
 * Class SendResponseEvent
 */
class SendResponseEvent extends BaseSendResponseEvent implements
    EventInterface,
    DispatchEventInterface
{
    use AppEventTrait;

    /**
     * @param DispatchEvent $event
     */
    public function __construct(DispatchEvent $event)
    {
        parent::__construct(self::class, $event->getApp(), $event->getParams());
        $this->setResponse($event->getResponse());
    }

    /**
     * @return RequestInterface
     * @TODO implement
     */
    public function getRequest()
    {
        return $this->getParam($this::REQUEST);
    }
}
