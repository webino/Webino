<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\DispatchEvent;
use Zend\Http\PhpEnvironment\Request;

/**
 * Class HttpRequestListener
 */
final class HttpRequestListener extends AbstractRequestListener
{
    /**
     * @param DispatchEvent $event
     */
    public function createRequest(DispatchEvent $event)
    {
        $event->setRequest(new Request);
    }
}
