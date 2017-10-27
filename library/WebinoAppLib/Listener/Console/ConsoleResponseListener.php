<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
