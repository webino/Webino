<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\DispatchEvent;
use WebinoEventLib\AbstractListener;

/**
 * Class AbstractRequestListener
 */
abstract class AbstractRequestListener extends AbstractListener
{
    /**
     * @param DispatchEvent $event
     * @return void
     */
    abstract public function createRequest(DispatchEvent $event);

    /**
     * Initialize listener
     */
    public function init()
    {
        $this->listen(DispatchEvent::DISPATCH, [$this, 'createRequest'], DispatchEvent::BEGIN * 999);
    }
}
