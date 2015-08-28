<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\SendResponseEvent;
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
