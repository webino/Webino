<?php

namespace WebinoAppLib\Listener\Http;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Listener\AbstractRequestListener;
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
