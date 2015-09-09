<?php

namespace WebinoAppLib\Listener\Console;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Listener\AbstractRequestListener;
use Zend\Console\Request;

/**
 * Class ConsoleRequestListener
 */
final class ConsoleRequestListener extends AbstractRequestListener
{
    /**
     * @param DispatchEvent $event
     */
    public function createRequest(DispatchEvent $event)
    {
        $event->setRequest(new Request);
    }
}
