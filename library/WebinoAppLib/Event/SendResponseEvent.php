<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Event;

use WebinoEventLib\EventInterface;
use Zend\Mvc\ResponseSender\SendResponseEvent as BaseSendResponseEvent;

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
}
