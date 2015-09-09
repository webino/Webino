<?php

namespace WebinoAppLib\Listener\Console;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\SendResponseEvent;
use WebinoAppLib\Listener\AbstractResponseListener;
use Zend\Console\Response;
use Zend\Mvc\ResponseSender\ConsoleResponseSender;

/**
 * Class ConsoleResponseListener
 */
final class ConsoleResponseListener extends AbstractResponseListener
{
    /**
     * @param DispatchEvent $event
     */
    public function createResponse(DispatchEvent $event)
    {
        $event->setResponse(new Response);
    }

    /**
     * Initialize listener
     */
    public function init()
    {
        parent::init();
        $this->listen(SendResponseEvent::class, new ConsoleResponseSender);
    }
}
